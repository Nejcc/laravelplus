<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LaravelPlus - The Ultimate Laravel Backend Framework</title>

    <!-- Tailwind CSS 2 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: '#ff2d20',
                    }
                }
            }
        }
    </script>

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #ff2d20 0%, #ff2d20 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        html, body {
            height: 100%;
            overflow: hidden;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 h-full">
    <div class="h-full">
        <div class="h-full flex flex-col">
            <!-- Navigation Bar -->
            <nav class="bg-white/80 backdrop-blur-sm shadow-sm">
                <div class="container mx-auto px-4">
                    <div class="flex justify-between items-center h-16">
                        <!-- Mobile Menu Button -->
                        <button class="md:hidden text-gray-600 hover:text-laravel focus:outline-none" id="mobile-menu-button">
                            <i class="ti ti-menu-2 text-2xl"></i>
                        </button>

                        <!-- Left Side - Brand and Links -->
                        <div class="flex items-center space-x-4 md:space-x-8">
                            <div class="hidden md:flex items-center space-x-6">
                                <a href="https://github.com/nejcc/laravelplus" 
                                   class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-laravel transition-colors duration-200"
                                   target="_blank">
                                    <i class="ti ti-brand-github mr-2"></i>GitHub
                                </a>
                                <a href="#" 
                                   class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-laravel transition-colors duration-200">
                                    <i class="ti ti-book mr-2"></i>Documentation
                                </a>
                            </div>
                        </div>

                        <!-- Right Side - Auth Links -->
                        <div class="hidden md:flex items-center space-x-4">
                            @auth
                                <a href="{{ route('home') }}" 
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-laravel transition-colors duration-200">
                                    <i class="ti ti-layout-dashboard mr-2"></i>Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-laravel transition-colors duration-200">
                                    <i class="ti ti-login mr-2"></i>Login
                                </a>
                                <a href="{{ route('register') }}" 
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-laravel rounded-lg hover:bg-red-600 transition-colors duration-200">
                                    <i class="ti ti-user-plus mr-2"></i>Register
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Mobile Menu -->
                    <div class="hidden md:hidden" id="mobile-menu">
                        <div class="px-2 pt-2 pb-3 space-y-1">
                            <a href="https://github.com/nejcc/laravelplus" 
                               class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-laravel hover:bg-gray-50 rounded-md"
                               target="_blank">
                                <i class="ti ti-brand-github mr-2"></i>GitHub
                            </a>
                            <a href="#" 
                               class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-laravel hover:bg-gray-50 rounded-md">
                                <i class="ti ti-book mr-2"></i>Documentation
                            </a>
                            @auth
                                <a href="{{ route('home') }}" 
                                   class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-laravel hover:bg-gray-50 rounded-md">
                                    <i class="ti ti-layout-dashboard mr-2"></i>Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-laravel hover:bg-gray-50 rounded-md">
                                    <i class="ti ti-login mr-2"></i>Login
                                </a>
                                <a href="{{ route('register') }}" 
                                   class="block px-3 py-2 text-base font-medium text-white bg-laravel rounded-md">
                                    <i class="ti ti-user-plus mr-2"></i>Register
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <div class="flex-grow flex items-center">
                <div class="container mx-auto px-4 py-4 md:py-0">
                    <!-- Main Content -->
                    <div class="flex flex-col items-center">
                        <!-- Text Content -->
                        <div class="w-full text-center md:-mt-40 lg:-mt-48 mb-24" data-aos="fade-up">
                            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4 md:mb-6">
                                <span class="hero-gradient">Laravel</span><span class="text-laravel">Plus</span>
                            </h1>
                            <p class="text-lg sm:text-xl text-gray-600 mb-6 md:mb-8 leading-relaxed max-w-4xl mx-auto">
                                A powerful Laravel starter kit <br>with a robust architecture, pre-built features, and best practices baked in. <br>Build enterprise-grade applications in minutes, not months.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="https://github.com/nejcc/laravelplus" 
                                   class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 border border-transparent text-sm sm:text-base font-medium rounded-lg text-white bg-laravel hover:bg-red-600 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl"
                                   target="_blank">
                                    <i class="ti ti-brand-github mr-2"></i>View on GitHub
                                </a>
                                <a href="{{ route('home') }}" 
                                   class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 border border-laravel text-sm sm:text-base font-medium rounded-lg text-laravel hover:bg-laravel hover:text-white transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <i class="ti ti-rocket mr-2"></i>Get Started
                                </a>
                            </div>
                        </div>

                        <!-- Feature Cards -->
                        <div class="w-full max-w-7xl mx-auto">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                    <div class="mb-3 sm:mb-4">
                                        <i class="ti ti-bolt text-laravel text-3xl sm:text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-semibold mb-2 sm:mb-3">Rapid Development</h3>
                                    <p class="text-sm sm:text-base text-gray-600">Skip the boilerplate and start building immediately.</p>
                                </div>
                                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                    <div class="mb-3 sm:mb-4">
                                        <i class="ti ti-shield text-laravel text-3xl sm:text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-semibold mb-2 sm:mb-3">Secure & Reliable</h3>
                                    <p class="text-sm sm:text-base text-gray-600">Built with security in mind, following best practices.</p>
                                </div>
                                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                    <div class="mb-3 sm:mb-4">
                                        <i class="ti ti-code text-laravel text-3xl sm:text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-semibold mb-2 sm:mb-3">Clean Code</h3>
                                    <p class="text-sm sm:text-base text-gray-600">Well-structured, maintainable codebase.</p>
                                </div>
                                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                    <div class="mb-3 sm:mb-4">
                                        <i class="ti ti-device-laptop text-laravel text-3xl sm:text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-semibold mb-2 sm:mb-3">Modern Stack</h3>
                                    <p class="text-sm sm:text-base text-gray-600">Built with the latest Laravel features and best practices.</p>
                                </div>
                                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                    <div class="mb-3 sm:mb-4">
                                        <i class="ti ti-puzzle text-laravel text-3xl sm:text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-semibold mb-2 sm:mb-3">Modular Design</h3>
                                    <p class="text-sm sm:text-base text-gray-600">Easily extendable and customizable architecture.</p>
                                </div>
                                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                    <div class="mb-3 sm:mb-4">
                                        <i class="ti ti-rocket text-laravel text-3xl sm:text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-semibold mb-2 sm:mb-3">Performance</h3>
                                    <p class="text-sm sm:text-base text-gray-600">Optimized for speed and efficiency.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="container mx-auto px-4 py-4">
                <div class="text-center text-gray-500 text-sm">
                    <small>Powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }}</small>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>