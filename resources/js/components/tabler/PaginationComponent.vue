<template>
    <div class="d-flex justify-content-between align-items-center">
        <div class="text-secondary">
            Showing {{ pagination.from || 0 }} to {{ pagination.to || 0 }} of {{ pagination.total || 0 }} entries
        </div>
        <nav>
            <ul class="pagination">
                <li v-for="(link, index) in pagination.links" 
                    :key="index"
                    class="page-item" 
                    :class="{ 
                        disabled: !link.url,
                        active: link.active
                    }">
                    <a class="page-link" 
                       href="#" 
                       @click.prevent="link.url ? changePage(parseInt(link.label)) : null"
                       v-html="link.label">
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    pagination: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['page-changed']);

const changePage = (page) => {
    if (page >= 1 && page <= props.pagination.last_page) {
        emit('page-changed', page);
    }
};
</script> 