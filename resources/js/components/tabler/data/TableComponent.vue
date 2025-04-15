<template>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-striped">
            <thead>
                <tr>
                    <th v-for="column in columns" :key="column.key">
                        {{ column.label }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in data" :key="item.id">
                    <td v-for="column in columns" :key="column.key">
                        <slot :name="column.key" :item="item">
                            {{ item[column.key] }}
                        </slot>
                    </td>
                </tr>
                <tr v-if="data.length === 0">
                    <td :colspan="columns.length" class="text-center py-4">
                        <div class="empty">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                                    <path d="M9 10l.01 0"/>
                                    <path d="M15 10l.01 0"/>
                                    <path d="M9.5 15.25a3.5 3.5 0 0 1 5 0"/>
                                </svg>
                            </div>
                            <p class="empty-title">{{ emptyTitle }}</p>
                            <p class="empty-subtitle text-secondary">
                                {{ emptySubtitle }}
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: 'TableComponent',
    props: {
        columns: {
            type: Array,
            required: true
        },
        data: {
            type: Array,
            required: true
        },
        emptyTitle: {
            type: String,
            default: 'No data found'
        },
        emptySubtitle: {
            type: String,
            default: 'Try adjusting your search or filter to find what you\'re looking for.'
        }
    }
}
</script>

<style scoped>
.empty {
    padding: 3rem 0;
}

.empty-icon {
    font-size: 2.5rem;
    color: #a0aec0;
    margin-bottom: 1rem;
}

.empty-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.empty-subtitle {
    color: #718096;
    margin-bottom: 0;
}
</style> 