<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ translationsState.translate('Permissions') }}</h3>
                <div class="card-actions">
                    <button class="btn btn-primary" @click="showCreateModal = true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14"/>
                            <path d="M5 12l14 0"/>
                        </svg>
                        {{ translationsState.translate('Add Permission') }}
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"/>
                                <path d="M21 21l-6 -6"/>
                            </svg>
                        </span>
                        <input type="text" class="form-control" v-model="search" :placeholder="translationsState.translate('Search permissions...')">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>{{ translationsState.translate('Name') }}</th>
                                <th>{{ translationsState.translate('Guard Name') }}</th>
                                <th>{{ translationsState.translate('Created At') }}</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="permission in permissions.data" :key="permission.id">
                                <td>{{ permission.name }}</td>
                                <td>{{ permission.guard_name }}</td>
                                <td>{{ formatDate(permission.created_at) }}</td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <button class="btn btn-icon btn-sm btn-ghost-secondary" @click="editPermission(permission)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                                <path d="M16 5l3 3"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <pagination :data="permissions" @pagination-change-page="getPermissions"></pagination>
                </div>
            </div>
        </div>

        <!-- Create/Edit Modal -->
        <div class="modal modal-blur fade" :class="{ 'show': showCreateModal || showEditModal }" tabindex="-1" role="dialog" v-if="showCreateModal || showEditModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ showEditModal ? translationsState.translate('Edit Permission') : translationsState.translate('Create Permission') }}</h5>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </div>
                    <form @submit.prevent="submitForm">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">{{ translationsState.translate('Name') }}</label>
                                <input type="text" class="form-control" v-model="form.name" :class="{ 'is-invalid': errors.name }">
                                <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ translationsState.translate('Guard Name') }}</label>
                                <select class="form-select" v-model="form.guard_name" :class="{ 'is-invalid': errors.guard_name }">
                                    <option value="web">Web</option>
                                    <option value="api">API</option>
                                    <option value="sanctum">Sanctum</option>
                                </select>
                                <div class="invalid-feedback" v-if="errors.guard_name">{{ errors.guard_name[0] }}</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" @click="closeModal">{{ translationsState.translate('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary" :disabled="loading">
                                <span v-if="loading" class="spinner-border spinner-border-sm me-1"></span>
                                {{ showEditModal ? translationsState.translate('Update') : translationsState.translate('Create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue'
import axios from 'axios'
import { useTranslationsState } from '@/states/TranslationState'

export default {
    components: {
        Pagination: () => import('@/components/common/PaginationComponent.vue')
    },
    setup() {
        const translationsState = useTranslationsState()
        const permissions = ref({ data: [] })
        const search = ref('')
        const showCreateModal = ref(false)
        const showEditModal = ref(false)
        const loading = ref(false)
        const form = ref({
            name: '',
            guard_name: 'web'
        })
        const errors = ref({})
        const editingId = ref(null)

        const getPermissions = async (page = 1) => {
            try {
                const response = await axios.get(`/admin/permissions?page=${page}&search=${search.value}`)
                permissions.value = response.data
            } catch (error) {
                console.error('Error fetching permissions:', error)
            }
        }

        const submitForm = async () => {
            loading.value = true
            errors.value = {}

            try {
                if (showEditModal.value) {
                    await axios.put(`/admin/permissions/${editingId.value}`, form.value)
                } else {
                    await axios.post('/admin/permissions', form.value)
                }

                closeModal()
                getPermissions()
            } catch (error) {
                if (error.response?.data?.errors) {
                    errors.value = error.response.data.errors
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

        watch(search, () => {
            getPermissions(1)
        })

        onMounted(() => {
            getPermissions()
        })

        return {
            permissions,
            search,
            showCreateModal,
            showEditModal,
            loading,
            form,
            errors,
            getPermissions,
            submitForm,
            editPermission,
            closeModal,
            formatDate,
            translationsState
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