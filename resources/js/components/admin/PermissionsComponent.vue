<template>
    <div class="container-xl">
        <CardComponent>
            <template #header>
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"/>
                        <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                        <path d="M12 12l0 2.5"/>
                    </svg>
                    {{ translationsState.translate('Permissions') }}
                </div>
                <div class="card-actions">
                    <ButtonComponent 
                        variant="primary"
                        :label="translationsState.translate('Add Permission')"
                        icon="fas fa-plus"
                        @click="showCreateModal = true"
                    />
                </div>
            </template>
            <template #default>
                <div class="row mb-3">
                    <div class="col-12 col-md-8">
                        <div class="d-flex">
                            <div class="btn-group">
                                <ButtonComponent 
                                    variant="secondary"
                                    :class="{ active: filterGuard === 'all' }"
                                    :label="translationsState.translate('All')"
                                    @click="filterGuard = 'all'"
                                />
                                <ButtonComponent 
                                    variant="secondary"
                                    :class="{ active: filterGuard === 'web' }"
                                    label="Web"
                                    @click="filterGuard = 'web'"
                                />
                                <ButtonComponent 
                                    variant="secondary"
                                    :class="{ active: filterGuard === 'api' }"
                                    label="API"
                                    @click="filterGuard = 'api'"
                                />
                                <ButtonComponent 
                                    variant="secondary"
                                    :class="{ active: filterGuard === 'sanctum' }"
                                    label="Sanctum"
                                    @click="filterGuard = 'sanctum'"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <SearchInputComponent 
                            v-model="search"
                            :placeholder="translationsState.translate('Search permissions...')"
                        />
                    </div>
                </div>

                <TableComponent 
                    :columns="tableColumns"
                    :data="filteredPermissions"
                    :empty-title="translationsState.translate('No permissions found')"
                    :empty-subtitle="translationsState.translate('Try adjusting your search or filter to find what you\'re looking for.')"
                >
                    <template #name="{ item }">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-sm me-2" :class="getGuardColor(item.guard_name)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"/>
                                </svg>
                            </span>
                            {{ item.name }}
                        </div>
                    </template>
                    <template #guard_name="{ item }">
                        <span class="badge" :class="getGuardBadgeClass(item.guard_name)">
                            {{ item.guard_name }}
                        </span>
                    </template>
                    <template #created_at="{ item }">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/>
                                <path d="M16 3v4"/>
                                <path d="M8 3v4"/>
                                <path d="M4 11h16"/>
                                <path d="M11 15h1"/>
                                <path d="M12 15v3"/>
                            </svg>
                            {{ formatDate(item.created_at) }}
                        </div>
                    </template>
                    <template #actions="{ item }">
                        <div class="btn-list flex-nowrap justify-content-end">
                            <ButtonComponent
                                variant="primary"
                                size="sm"
                                :label="translationsState.translate('Edit')"
                                @click="editPermission(item)"
                            />
                            <ButtonComponent
                                variant="danger"
                                size="sm"
                                :label="translationsState.translate('Delete')"
                                @click="confirmDelete(item)"
                            />
                        </div>
                    </template>
                </TableComponent>

                <div class="d-flex justify-content-center mt-3">
                    <Pagination 
                        :data="permissions" 
                        @pagination-change-page="getPermissions"
                        @pagination-hover-page="handlePaginationHover"
                    />
                </div>
            </template>
        </CardComponent>

        <!-- Create/Edit Modal -->
        <ModalDialogComponent
            :show="showCreateModal || showEditModal"
            :title="showEditModal ? translationsState.translate('Edit Permission') : translationsState.translate('Create Permission')"
            icon="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"
            :loading="loading"
            :cancel-label="translationsState.translate('Cancel')"
            :submit-label="showEditModal ? translationsState.translate('Update') : translationsState.translate('Create')"
            @close="closeModal"
            @submit="submitForm"
        >
            <InputComponent 
                v-model="form.name"
                :label="translationsState.translate('Name')"
                :placeholder="translationsState.translate('Enter permission name')"
                :error="errors.name"
            />
            <SelectComponent 
                v-model="form.guard_name"
                :label="translationsState.translate('Guard Name')"
                :options="[
                    { value: 'web', label: 'Web' },
                    { value: 'api', label: 'API' },
                    { value: 'sanctum', label: 'Sanctum' }
                ]"
                :error="errors.guard_name"
            />
        </ModalDialogComponent>

        <!-- Delete Confirmation Modal -->
        <ModalDialogComponent
            :show="showDeleteModal"
            :title="translationsState.translate('Are you sure?')"
            icon="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"
            size="sm"
            :loading="loading"
            :cancel-label="translationsState.translate('Cancel')"
            :submit-label="translationsState.translate('Delete')"
            submit-variant="danger"
            @close="showDeleteModal = false"
            @submit="deletePermission"
        >
            <div class="text-center">
                {{ translationsState.translate('Do you really want to delete this permission?') }}
            </div>
        </ModalDialogComponent>
    </div>
</template>

<script>
import { ref, onMounted, watch, computed } from 'vue'
import axios from 'axios'
import { useTranslationsState } from '@/states/TranslationState'
import PaginationComponent from '@/components/common/PaginationComponent.vue'
import CardComponent from '@/components/tabler/layout/CardComponent.vue'
import TableComponent from '@/components/tabler/data/TableComponent.vue'
import SearchInputComponent from '@/components/tabler/forms/SearchInputComponent.vue'
import ButtonComponent from '@/components/tabler/feedback/ButtonComponent.vue'
import InputComponent from '@/components/tabler/forms/InputComponent.vue'
import SelectComponent from '@/components/tabler/forms/SelectComponent.vue'
import ModalDialogComponent from '@/components/tabler/layout/ModalDialogComponent.vue'
import { useToastStore } from '@/stores/toast'

export default {
    components: {
        Pagination: PaginationComponent,
        CardComponent,
        TableComponent,
        SearchInputComponent,
        ButtonComponent,
        InputComponent,
        SelectComponent,
        ModalDialogComponent
    },
    setup() {
        const translationsState = useTranslationsState()
        const permissions = ref({
            data: [],
            current_page: 1,
            last_page: 1,
            per_page: 10,
            total: 0,
            from: 1,
            to: 10,
            links: []
        })
        const search = ref('')
        const filterGuard = ref('all')
        const showCreateModal = ref(false)
        const showEditModal = ref(false)
        const showDeleteModal = ref(false)
        const loading = ref(false)
        const form = ref({
            name: '',
            guard_name: 'web'
        })
        const errors = ref({})
        const editingId = ref(null)
        const deletingId = ref(null)
        
        // Add cache for paginated results
        const paginationCache = ref(new Map())
        const currentPage = ref(1)
        const isPrefetching = ref(false)
        const lastPrefetchedPage = ref(new Map()) // Track last prefetched page for each filter combination

        const tableColumns = [
            { key: 'name', label: translationsState.translate('Name') },
            { key: 'guard_name', label: translationsState.translate('Guard Name') },
            { key: 'created_at', label: translationsState.translate('Created At') },
            { key: 'actions', label: '', align: 'right' }
        ]

        const filteredPermissions = computed(() => {
            // If we have a search term or filter, filter the current page data
            if (search.value || filterGuard.value !== 'all') {
                return permissions.value.data.filter(permission => {
                    const matchesSearch = permission.name.toLowerCase().includes(search.value.toLowerCase())
                    const matchesGuard = filterGuard.value === 'all' || permission.guard_name === filterGuard.value
                    return matchesSearch && matchesGuard
                })
            }
            // Otherwise return all data from current page
            return permissions.value.data
        })

        const getCacheKey = (page, searchValue, guardValue) => {
            return `${page}-${searchValue}-${guardValue}`
        }

        const getPermissions = async (page = 1) => {
            const cacheKey = getCacheKey(page, search.value, filterGuard.value)
            
            // Check if we have cached data for this page with current filter
            if (paginationCache.value.has(cacheKey)) {
                permissions.value = paginationCache.value.get(cacheKey)
                currentPage.value = page
                return
            }

            loading.value = true
            try {
                const response = await axios.post(`/admin/permissions/list`, {
                    page,
                    search: search.value,
                    guard: filterGuard.value !== 'all' ? filterGuard.value : undefined
                })
                permissions.value = response.data
                currentPage.value = page
                
                // Cache the results
                paginationCache.value.set(cacheKey, response.data)
            } catch (error) {
                console.error('Error fetching permissions:', error)
                toastStore.error('An error occurred while fetching permissions')
            } finally {
                loading.value = false
            }
        }

        const handlePaginationHover = (page) => {
            if (!page || page < 1 || page > permissions.value.last_page) return
            
            const filterKey = `${search.value}-${filterGuard.value}`
            const lastPage = lastPrefetchedPage.value.get(filterKey)
            
            // Only prefetch if this is a different page than last time for this filter combination
            if (lastPage !== page) {
                prefetchPage(page)
                lastPrefetchedPage.value.set(filterKey, page)
            }
        }

        const prefetchPage = async (page) => {
            if (isPrefetching.value) return
            
            const cacheKey = getCacheKey(page, search.value, filterGuard.value)
            if (paginationCache.value.has(cacheKey)) return
            
            isPrefetching.value = true
            try {
                const response = await axios.post(`/admin/permissions/list`, {
                    page,
                    search: search.value,
                    guard: filterGuard.value !== 'all' ? filterGuard.value : undefined
                })
                paginationCache.value.set(cacheKey, response.data)
            } catch (error) {
                console.error('Error prefetching page:', error)
            } finally {
                isPrefetching.value = false
            }
        }

        // Clear cache and prefetch tracking when search or filter changes
        watch([search, filterGuard], () => {
            paginationCache.value.clear()
            lastPrefetchedPage.value.clear()
            getPermissions(1)
        })

        const toastStore = useToastStore()

        const submitForm = async () => {
            loading.value = true
            errors.value = {}

            try {
                if (showEditModal.value) {
                    await axios.put(`/admin/permissions/${editingId.value}`, form.value)
                    toastStore.success('Permission updated successfully')
                } else {
                    await axios.post('/admin/permissions', form.value)
                    toastStore.success('Permission created successfully')
                }

                closeModal()
                getPermissions()
            } catch (error) {
                if (error.response?.data?.errors) {
                    errors.value = error.response.data.errors
                } else {
                    toastStore.error('An error occurred while saving the permission')
                }
            } finally {
                loading.value = false
            }
        }

        const editPermission = (permission) => {
            form.value = { ...permission }
            editingId.value = permission.id
            showEditModal.value = true
        }

        const confirmDelete = (permission) => {
            deletingId.value = permission.id
            showDeleteModal.value = true
        }

        const deletePermission = async () => {
            loading.value = true
            try {
                await axios.delete(`/admin/permissions/${deletingId.value}`)
                showDeleteModal.value = false
                getPermissions()
                toastStore.success('Permission deleted successfully')
            } catch (error) {
                console.error('Error deleting permission:', error)
                toastStore.error('An error occurred while deleting the permission')
            } finally {
                loading.value = false
            }
        }

        const closeModal = () => {
            showCreateModal.value = false
            showEditModal.value = false
            form.value = {
                name: '',
                guard_name: 'web'
            }
            errors.value = {}
            editingId.value = null
        }

        const formatDate = (date) => {
            return new Date(date).toLocaleDateString()
        }

        const getGuardColor = (guard) => {
            switch (guard) {
                case 'web': return 'bg-blue-lt'
                case 'api': return 'bg-green-lt'
                case 'sanctum': return 'bg-purple-lt'
                default: return 'bg-secondary-lt'
            }
        }

        const getGuardBadgeClass = (guard) => {
            switch (guard) {
                case 'web': return 'bg-blue'
                case 'api': return 'bg-green'
                case 'sanctum': return 'bg-purple'
                default: return 'bg-secondary'
            }
        }

        onMounted(() => {
            // Clear all toasts when component is mounted
            toastStore.toasts = [];
            getPermissions(1)
        })

        return {
            permissions,
            filteredPermissions,
            search,
            filterGuard,
            showCreateModal,
            showEditModal,
            showDeleteModal,
            loading,
            form,
            errors,
            getPermissions,
            submitForm,
            editPermission,
            confirmDelete,
            deletePermission,
            closeModal,
            formatDate,
            getGuardColor,
            getGuardBadgeClass,
            translationsState,
            tableColumns,
            currentPage,
            handlePaginationHover,
            toastStore
        }
    }
}
</script>

<style scoped>
.modal.show {
    display: block;
    background-color: rgba(0, 0, 0, 0.5);
}

.avatar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
}

.bg-blue-lt {
    background-color: rgba(66, 153, 225, 0.1);
    color: #4299e1;
}

.bg-green-lt {
    background-color: rgba(72, 187, 120, 0.1);
    color: #48bb78;
}

.bg-purple-lt {
    background-color: rgba(159, 122, 234, 0.1);
    color: #9f7aea;
}

.bg-secondary-lt {
    background-color: rgba(160, 174, 192, 0.1);
    color: #a0aec0;
}

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