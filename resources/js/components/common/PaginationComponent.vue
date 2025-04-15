<template>
    <div v-if="data.last_page > 1" class="pagination">
        <ul class="pagination">
            <li class="page-item" :class="{ disabled: data.current_page === 1 }">
                <a class="page-link" href="#" @click.prevent="changePage(data.current_page - 1)">
                    {{ translationsState.translate('Previous') }}
                </a>
            </li>
            <li v-for="page in pages" :key="page" class="page-item" :class="{ active: page === data.current_page }">
                <a 
                    class="page-link" 
                    href="#" 
                    @click.prevent="changePage(page)"
                    @mouseenter="$emit('pagination-hover-page', page)"
                >
                    {{ page }}
                </a>
            </li>
            <li class="page-item" :class="{ disabled: data.current_page === data.last_page }">
                <a class="page-link" href="#" @click.prevent="changePage(data.current_page + 1)">
                    {{ translationsState.translate('Next') }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
import { computed } from 'vue'
import { useTranslationsState } from '@/states/TranslationState'

export default {
    props: {
        data: {
            type: Object,
            required: true,
            validator: (value) => {
                return value.current_page !== undefined && 
                       value.last_page !== undefined && 
                       value.data !== undefined;
            }
        }
    },
    emits: ['pagination-change-page', 'pagination-hover-page'],
    setup(props, { emit }) {
        const translationsState = useTranslationsState()
        
        const pages = computed(() => {
            const pages = []
            const maxVisiblePages = 5
            let startPage = Math.max(1, props.data.current_page - Math.floor(maxVisiblePages / 2))
            let endPage = Math.min(props.data.last_page, startPage + maxVisiblePages - 1)
            
            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1)
            }
            
            for (let i = startPage; i <= endPage; i++) {
                pages.push(i)
            }
            return pages
        })

        const changePage = (page) => {
            if (page < 1 || page > props.data.last_page) return
            emit('pagination-change-page', page)
        }

        return {
            pages,
            changePage,
            translationsState
        }
    }
}
</script>

<style scoped>
.pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
    margin: 0;
}

.page-item {
    margin: 0 2px;
}

.page-link {
    padding: 0.5rem 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    color: #0d6efd;
    text-decoration: none;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #fff;
    border-color: #dee2e6;
}
</style> 