<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/ButtonSecondary.vue';
import SuccessButton from '@/Components/ButtonSuccess.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Card from '@/Components/Card.vue';
import ButtonIcon from '@/Components/ButtonIcon.vue';
import Table from '@/Components/Table.vue';
import Pagination from '@/Components/Pagination.vue';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import { countries } from '@/Hooks/countries.json';

const props = defineProps({
    providersPagination: {
        type: Object,
    }
});
//pagination
const currentPage = ref(props.providersPagination.current_page);
const providers = ref(props.providersPagination.data);
const perPage = ref(props.providersPagination.per_page);
const totalProviders = ref(props.providersPagination.total);
//console.log(props.providersPagination)


const totalPages = (total, per_page) => {
    return Math.ceil(total / per_page);
}

const handlePageChange = (page) => {
    currentPage.value = page;
    updateProviders();
}

const form = useForm({
    id: 0,
    name: '',
    cuit: '',
    address: '',
    country: '',
    province: '',
    postal_code: '',
    phone: '',
    email: '',
    fax: '',
    web_site: '',
    color: '',
});

const updateProviders = () => {
    form.get(route('providers', { page: currentPage.value }), {
        onSuccess: (resp) => {
            //console.log(resp)
            providers.value = resp.data;
        },
        onError: (error) => {
            console.error(error)
        },
    });
}


console.log(form);

const handleCreateProvider = () => {
    form.post(route('providers.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('¡Proveedor Creado!')
            form.reset()
            isShowModal.value = false
            props.updateProviders()
        },
        onError: (error) => {
            //console.error(error)
            const formErrors = form.errors;

            for (let field in formErrors) {
                if (formErrors.hasOwnProperty(field)) {
                    toast.warning(formErrors[field]);
                    break; // Detener el bucle después de mostrar el primer mensaje de error
                }
            }

            if (error.message) {
                toast.warning(error.message);
            }
        },
    });
}
//MODAL
const isShowModal = ref(false)

const modalTitle = ref('')

const editProvider = (provider) => {
    modalTitle.value = 'Editar Proveedor'
    Object.assign(form, provider);
    showModal()
}
const createProvider = () => {
    modalTitle.value = 'Crear Proveedor'
    form.reset()
    showModal()
}
const showModal = () => {
  isShowModal.value = true
}
const closeModal = () => {
  isShowModal.value = false
}
const headers =['Nombre', 'CUIT', 'Dirección', 'Teléfono', 'Email']
</script>

<template>
    <Head title="Proveedores" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Proveedores</h2>
        </template>


        <Table
            :headers="headers"
        >
            <template #topHeader>
                <ButtonIcon
                    name="Crear proveedor"
                    icon="icon-[fa-solid--plus]"
                    @click="createProvider"
                >
                </ButtonIcon>
            </template>
            <template v-if="providers.length">
                <tr
                    v-for="item in providers"
                    :key="item.id"
                    class="odd:bg-gray-50 odd:dark:bg-[#222222] even:bg-gray-100 even:dark:bg-background-semidark border dark:border-[#333]"
                >
                    <td class="py-3 flex items-center justify-center">
                        <button
                            :id="'dropdown-'+item.id"
                            :data-dropdown-toggle="'edit-'+item.id"
                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 dark:text-gray-200 hover:text-gray-800 rounded-lg focus:outline-none dark:hover:text-white"
                            type="button"
                        >
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                        <div :id="'edit-'+item.id" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow border border-gray-100 dark:border-gray-700 dark:bg-background-dark dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-white" :aria-labelledby="'dropdown-'+item.id">
                                <li>
                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">Show</a>
                                </li>
                                <li>
                                    <button @click="editProvider(item)" class="block py-2 px-4 w-full text-left hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">Editar</button>
                                </li>
                            </ul>
                            <div class="py-1">
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-white dark:hover:text-white">Delete</a>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">{{ item.name }}</td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ item.cuit }}</td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ item.address }}</td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ item.phone }}</td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ item.email }}</td>
                </tr>
            </template>
            <template v-else>
                <tr class="border-b dark:border-gray-700">
                    <td class="whitespace-nowrap">No hay proveedores cargados</td>
                </tr>
            </template>
        </Table>
        <!-- Crear Editar Proveedor -->
        <Modal :show="isShowModal" @close="closeModal" size="3xl" persistent >
            <template #header>
                <div class="flex items-center text-lg text-black dark:text-white">
                    {{ modalTitle }}
                </div>
            </template>
            <template #body>
                <form >
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <Card colorHeader="primary">
                            <template #header>
                                <h3 class="font-semibold text-md text-white">Información importante</h3>
                            </template>
                            <div class="mb-3">
                                <label for="name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nombre</label>
                                <input
                                    type="text"
                                    name="name"
                                    v-model="form.name"
                                    placeholder="Nombre"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="color" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Color</label>
                                <input
                                    type="text"
                                    name="color"
                                    v-model="form.color"
                                    placeholder="Color"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                        </Card>
                        <Card colorHeader="primary">
                            <template #header>
                                <h3 class="font-semibold text-md text-white">Información fiscal</h3>
                            </template>
                            <div class="mb-3">
                                <label for="cuit" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">CUIT</label>
                                <input
                                    type="text"
                                    name="cuit"
                                    v-model="form.cuit"
                                    placeholder="CUIT"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                        </Card>
                    </div>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <Card colorHeader="primary">
                            <template #header>
                                <h3 class="font-semibold text-md text-white">Información de contacto</h3>
                            </template>
                            <div class="mb-3">
                                <label for="phone" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Teléfono</label>
                                <input
                                    type="text"
                                    name="phone"
                                    v-model="form.phone"
                                    placeholder="Teléfono"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">E-mail</label>
                                <input
                                    type="email"
                                    name="email"
                                    v-model="form.email"
                                    placeholder="E-mail"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="fax" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Fax</label>
                                <input
                                    type="text"
                                    name="fax"
                                    v-model="form.fax"
                                    placeholder="Fax"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="web_site" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Sitio web</label>
                                <input
                                    type="text"
                                    name="web_site"
                                    v-model="form.web_site"
                                    placeholder="Sitio web"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                        </Card>
                        <Card colorHeader="primary">
                            <template #header>
                                <h3 class="font-semibold text-md text-white">Ubicación</h3>
                            </template>
                            <div class="mb-3">
                                <label for="countries" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">País</label>
                                <select v-model="form.country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="country in countries" :key="country" :value="country" >{{ country }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="province" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Provincia</label>
                                <input
                                    type="text"
                                    name="province"
                                    v-model="form.province"
                                    placeholder="Provincia"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="address" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Dirección</label>
                                <input
                                    type="text"
                                    name="address"
                                    v-model="form.address"
                                    placeholder="Address"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="postal_code" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Código postal</label>
                                <input
                                    type="text"
                                    name="postal_code"
                                    v-model="form.postal_code"
                                    placeholder="Código postal"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                            </div>
                        </Card>
                    </div>
                </form>
            </template>
            <template #footer>
                <div class="flex justify-between">
                    <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                    <SuccessButton @click="handleCreateProvider" :disabled="form.processing">
                        {{ modalTitle }}
                    </SuccessButton>
                </div>
            </template>
        </Modal>

    </AuthenticatedLayout>
</template>
