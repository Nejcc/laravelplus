<template>
    <ModalComponent
        :show="show"
        :title="title"
        :size="size"
        :centered="centered"
        :closable="closable"
        @close="$emit('close')"
    >
        <template #header>
            <div class="modal-title">
                <svg v-if="icon" xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path :d="icon"/>
                </svg>
                {{ title }}
            </div>
        </template>

        <form @submit.prevent="$emit('submit')">
            <slot></slot>
        </form>

        <template #footer>
            <ButtonComponent 
                variant="link"
                :label="cancelLabel"
                class="me-auto"
                @click="$emit('close')"
            />
            <ButtonComponent 
                variant="primary"
                :label="submitLabel"
                :loading="loading"
                type="submit"
                @click="$emit('submit')"
            />
        </template>
    </ModalComponent>
</template>

<script>
import ModalComponent from './ModalComponent.vue'
import ButtonComponent from '../feedback/ButtonComponent.vue'

export default {
    name: 'ModalDialogComponent',
    components: {
        ModalComponent,
        ButtonComponent
    },
    props: {
        show: {
            type: Boolean,
            required: true
        },
        title: {
            type: String,
            required: true
        },
        icon: {
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
            default: true
        },
        closable: {
            type: Boolean,
            default: true
        },
        loading: {
            type: Boolean,
            default: false
        },
        cancelLabel: {
            type: String,
            default: 'Cancel'
        },
        submitLabel: {
            type: String,
            default: 'Submit'
        }
    },
    emits: ['close', 'submit']
}
</script> 