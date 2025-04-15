import { defineStore } from 'pinia';

export const useToastStore = defineStore('toast', {
    state: () => ({
        toasts: []
    }),

    actions: {
        addToast(options) {
            const toast = {
                id: Date.now(),
                title: options.title || 'Notification',
                message: options.message,
                type: options.type || '',
                icon: options.icon || '',
                time: options.time || 'just now',
                duration: options.duration || 5000,
                shown: false,
                deleteAfter: options.deleteAfter || 60000, // Default 1 minute
                progress: 100,
                startTime: Date.now()
            };

            this.toasts.push(toast);

            // Mark as shown and remove after specified time
            setTimeout(() => {
                const toastIndex = this.toasts.findIndex(t => t.id === toast.id);
                if (toastIndex !== -1) {
                    this.toasts[toastIndex].shown = true;
                    // Remove from state after marking as shown
                    setTimeout(() => {
                        this.removeToast(toast.id);
                    }, 1000); // Remove 1 second after marking as shown
                }
            }, toast.deleteAfter);

            // Auto-dismiss after duration if set
            if (toast.duration > 0) {
                setTimeout(() => {
                    this.removeToast(toast.id);
                }, toast.duration);
            }
        },

        removeToast(id) {
            this.toasts = this.toasts.filter(toast => toast.id !== id);
        },

        success(message, options = {}) {
            this.addToast({
                ...options,
                message,
                type: 'success',
                icon: 'bg-green'
            });
        },

        error(message, options = {}) {
            this.addToast({
                ...options,
                message,
                type: 'danger',
                icon: 'bg-red'
            });
        },

        warning(message, options = {}) {
            this.addToast({
                ...options,
                message,
                type: 'warning',
                icon: 'bg-yellow'
            });
        },

        info(message, options = {}) {
            this.addToast({
                ...options,
                message,
                type: 'info',
                icon: 'bg-blue'
            });
        }
    }
}); 