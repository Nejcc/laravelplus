<template>
    <div class="modal modal-blur fade" :class="{ 'show': show }" tabindex="-1" role="dialog" v-if="show">
        <div class="modal-dialog" :class="[
            `modal-${size}`,
            { 'modal-dialog-centered': centered }
        ]" role="document">
            <div class="modal-content">
                <div class="modal-header" v-if="$slots.header || title">
                    <slot name="header">
                        <h5 class="modal-title">{{ title }}</h5>
                    </slot>
                    <button type="button" class="btn-close" @click="$emit('close')" v-if="closable"></button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer" v-if="$slots.footer">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ModalComponent',
    props: {
        show: {
            type: Boolean,
            required: true
        },
        title: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'md',
            validator: (value) => ['sm', 'md', 'lg', 'xl'].includes(value)
        },
        centered: {
            type: Boolean,
            default: false
        },
        closable: {
            type: Boolean,
            default: true
        }
    },
    emits: ['close'],
    watch: {
        show(newValue) {
            if (newValue) {
                document.body.classList.add('modal-open')
            } else {
                document.body.classList.remove('modal-open')
            }
        }
    }
}
</script>

<style scoped>
.modal.show {
    display: block;
    background-color: rgba(0, 0, 0, 0.5);
}
</style> 