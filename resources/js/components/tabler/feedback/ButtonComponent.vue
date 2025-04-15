<template>
    <button 
        class="btn"
        :class="[
            `btn-${variant}`,
            { 'btn-icon': icon && !label },
            { 'btn-loading': loading }
        ]"
        :disabled="disabled || loading"
        @click="$emit('click')"
    >
        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        <span v-if="icon" class="btn-icon-wrapper">
            <i :class="icon"></i>
        </span>
        <span v-if="label">{{ label }}</span>
    </button>
</template>

<script>
export default {
    name: 'ButtonComponent',
    props: {
        variant: {
            type: String,
            default: 'primary',
            validator: (value) => ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'].includes(value)
        },
        label: {
            type: String,
            default: ''
        },
        icon: {
            type: String,
            default: ''
        },
        loading: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    emits: ['click']
}
</script>

<style scoped>
.btn-icon {
    width: 2.5rem;
    height: 2.5rem;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-icon-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
</style> 