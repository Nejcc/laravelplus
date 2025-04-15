<template>
    <div class="fixed bottom-4 right-4 z-50">
        <div v-for="toast in toasts" :key="toast.id" 
             class="mb-4 p-4 rounded-lg shadow-lg transition-all duration-300"
             :class="[
                 toast.type === 'success' ? 'bg-green-100 text-green-800' : 
                 toast.type === 'danger' ? 'bg-red-100 text-red-800' :
                 toast.type === 'warning' ? 'bg-yellow-100 text-yellow-800' :
                 toast.type === 'info' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800',
                 toast.shown ? 'opacity-0 transform translate-x-full' : 'opacity-100 transform translate-x-0'
             ]">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-6 h-6 rounded-full" :class="toast.icon"></div>
                </div>
                <div class="ml-3 w-0 flex-1">
                    <p class="text-sm font-medium">{{ toast.title }}</p>
                    <p class="mt-1 text-sm">{{ toast.message }}</p>
                    <p class="mt-1 text-xs text-gray-500">{{ toast.time }}</p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="handleClose(toast.id)" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mt-2">
                <div class="progress progress-sm">
                    <div
                        class="progress-bar"
                        :style="{ width: `${toast.progress}%` }"
                        role="progressbar"
                        :aria-valuenow="toast.progress"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        :aria-label="`${toast.progress}% Complete`"
                    >
                        <span class="visually-hidden">{{ toast.progress }}% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useToastStore } from '@/stores/toast';
import { onMounted, onUnmounted } from 'vue';

const toastStore = useToastStore();
const { toasts } = storeToRefs(toastStore);

let progressInterval;

const updateProgress = () => {
    const now = Date.now();
    toasts.value.forEach(toast => {
        if (toast.progress > 0) {
            const elapsed = now - toast.startTime;
            const totalTime = toast.duration || 5000;
            toast.progress = Math.max(0, 100 - (elapsed / totalTime) * 100);
            
            if (toast.progress <= 0) {
                handleClose(toast.id);
            }
        }
    });
};

const handleClose = (id) => {
    const toastIndex = toastStore.toasts.findIndex(t => t.id === id);
    if (toastIndex !== -1) {
        toastStore.toasts[toastIndex].shown = true;
        setTimeout(() => {
            toastStore.removeToast(id);
        }, 300);
    }
};

onMounted(() => {
    // Clear all toasts when component is mounted
    toastStore.toasts = [];
    // Start progress bar updates
    progressInterval = setInterval(updateProgress, 50);
});

onUnmounted(() => {
    // Clean up interval when component is destroyed
    if (progressInterval) {
        clearInterval(progressInterval);
    }
});
</script> 