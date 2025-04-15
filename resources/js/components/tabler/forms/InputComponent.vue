<template>
    <div class="mb-3">
        <label v-if="label" class="form-label">{{ label }}</label>
        <input
            :type="type"
            class="form-control"
            :class="{ 'is-invalid': error }"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :placeholder="placeholder"
            :disabled="disabled"
        >
        <div v-if="error" class="invalid-feedback">{{ error }}</div>
        <div v-if="help" class="form-text">{{ help }}</div>
    </div>
</template>

<script>
export default {
    name: 'InputComponent',
    props: {
        modelValue: {
            type: [String, Number],
            default: ''
        },
        type: {
            type: String,
            default: 'text',
            validator: (value) => ['text', 'password', 'email', 'number', 'tel', 'url'].includes(value)
        },
        label: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        },
        error: {
            type: [String, Array],
            default: ''
        },
        help: {
            type: String,
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    emits: ['update:modelValue']
}
</script> 