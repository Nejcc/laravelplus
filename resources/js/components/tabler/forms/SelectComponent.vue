<template>
    <div class="mb-3">
        <label v-if="label" class="form-label">{{ label }}</label>
        <select
            class="form-select"
            :class="{ 'is-invalid': error }"
            :value="modelValue"
            @change="$emit('update:modelValue', $event.target.value)"
            :disabled="disabled"
        >
            <option v-if="placeholder" value="" disabled>{{ placeholder }}</option>
            <option 
                v-for="option in options" 
                :key="option.value" 
                :value="option.value"
                :disabled="option.disabled"
            >
                {{ option.label }}
            </option>
        </select>
        <div v-if="error" class="invalid-feedback">{{ error }}</div>
        <div v-if="help" class="form-text">{{ help }}</div>
    </div>
</template>

<script>
export default {
    name: 'SelectComponent',
    props: {
        modelValue: {
            type: [String, Number],
            default: ''
        },
        options: {
            type: Array,
            required: true,
            validator: (options) => {
                return options.every(option => {
                    return typeof option === 'object' && 
                           'value' in option && 
                           'label' in option
                })
            }
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