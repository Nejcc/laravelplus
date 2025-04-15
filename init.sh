#!/bin/bash

# Function to check if a command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Check if .env exists, if not copy from .env.example
if [ ! -f .env ]; then
    echo "Copying .env.example to .env..."
    cp .env.example .env
    echo ".env file created successfully!"
else
    echo ".env file already exists, skipping..."
fi

# Install Composer dependencies
echo "Installing Composer dependencies..."
if command_exists composer; then
    composer install
else
    echo "Error: Composer is not installed. Please install Composer first."
    exit 1
fi

# Install and build NPM dependencies
echo "Installing and building NPM dependencies..."
if command_exists npm; then
    npm install
    npm run build
else
    echo "Error: NPM is not installed. Please install Node.js and NPM first."
    exit 1
fi

# Generate application key
echo "Generating application key..."
php artisan key:generate

# Ask if user wants to run development watcher
read -p "Do you want to run the development watcher? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "Starting development watcher..."
    composer dev
else
    echo "Initialization complete! You can start the development server manually with 'composer dev'"
fi 