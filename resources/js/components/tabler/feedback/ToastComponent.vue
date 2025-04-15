<template>
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div v-for="toast in toasts" 
             :key="toast.id"
             class="toast show" 
             role="alert" 
             aria-live="assertive" 
             aria-atomic="true"
             :class="[toast.type ? `bg-${toast.type}` : '', 'text-white']">
            <div class="toast-header" :class="toast.type ? `bg-${toast.type}` : ''">
                <span v-if="toast.icon" class="avatar avatar-xs me-2" :class="toast.icon"></span>
                <strong class="me-auto text-white">{{ toast.title }}</strong>
                <small class="text-white">{{ toast.time }}</small>
                <button type="button" 
                        class="ms-2 btn-close btn-close-white" 
                        @click="removeToast(toast.id)"
                        aria-label="Close"></button>
            </div>
            <div class="toast-body" v-html="toast.message"></div>
        </div>
    </div>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useToastStore } from '@/stores/toast';
import { onMounted } from 'vue';

const toastStore = useToastStore();
const { toasts } = storeToRefs(toastStore);
const { removeToast } = toastStore;

// Initialize the toast store
onMounted(() => {
    // Test toast to verify component is working
    toastStore.success('Toast component initialized');
});
</script>

<style scoped>
.toast-container {
    z-index: 1050;
}

.toast {
    background-color: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(10px);
}

.bg-success {
    background-color: #2fb344 !important;
}

.bg-danger {
    background-color: #d63939 !important;
}

.bg-warning {
    background-color: #f76707 !important;
}

.bg-info {
    background-color: #467fcf !important;
}

.btn-close-white {
    filter: invert(1) grayscale(100%) brightness(200%);
}
</style> 