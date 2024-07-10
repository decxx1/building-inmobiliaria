<script setup>
import { toast } from 'vue-sonner'
import { useForm } from '@inertiajs/vue3';
import { watch, ref } from 'vue';
import SecondaryButton from '@/Components/ButtonSecondary.vue';
import SuccessButton from '@/Components/ButtonSuccess.vue';
import Card from '@/Components/Card.vue';
import Modal from '@/Components/Modal.vue';
import { countries } from '@/Data/countries.json';
const isShowModal = ref(false)
const props = defineProps ({
    show: {
        type: Boolean,
        required: true
    },
    closeModal: {
        type: Function,
        required: true
    },
    updateProviders: {
        type: Function,
        required: true
    },
    icon: {
        type: String,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    provider: {
        type: Object,
        required: false
    }
})

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

watch(
    () => props.show,
    () => {
        isShowModal.value = props.show
    },

);
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
</script>

<template>
    <!-- Crear Proveedor -->
    <Modal :show="isShowModal" @close="closeModal" size="3xl" persistent >
        <template #header>
            <div class="flex items-center text-lg text-black dark:text-white">
                {{ title }}
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

            <SuccessButton @click="handleCreateProvider">
                {{title}}
            </SuccessButton>
        </div>
    </template>
  </Modal>
</template>
