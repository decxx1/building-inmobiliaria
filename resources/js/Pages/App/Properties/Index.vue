<script setup>
import { Head, useForm, usePage } from '@inertiajs/vue3';
import LeafletMap from '@/Components/LeafletMap.vue';
import SecondaryButton from '@/Components/ButtonSecondary.vue';
import SuccessButton from '@/Components/ButtonSuccess.vue';
import DangerButton from '@/Components/ButtonDanger.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Card from '@/Components/Card.vue';
import ButtonIcon from '@/Components/ButtonIcon.vue';
import TableHeader from '@/Components/TableHeader.vue';
import Pagination from '@/Components/Pagination.vue';
import Inmueble from '@/Components/Web/Property.vue';
import { ref, computed, watch } from 'vue';
import { toast } from 'vue-sonner'
import Modal from '@/Components/Modal.vue';
import Filters from '@/Components/Filters.vue';
import FiltersPrice from '@/Components/FiltersPrice.vue';
import DropdownCurrency from '@/Components/DropdownCurrency.vue';
import { debounce } from 'lodash';


const page = usePage();
const props = defineProps({
    currentPage: {
        type: Number,
        required: true
    },
    properties: {
        type: Array,
        required: true
    },
    perPage: {
        type: Number,
        required: true
    },
    totalProperties: {
        type: Number,
        required: true
    },
    provinces: {
        type: Array,
        required: true
    },
    types: {
        type: Array,
        required: true
    },
    statuses: {
        type: Array,
        required: true
    },
    antiquities: {
        type: Array,
        required: true
    },
    users: {
        type: Array,
        required: true
    },
});

//console.log(props.properties);
//pagination
const create = ref(true);

//showing items
const startShowing = computed(() => {
    return (props.currentPage - 1) * props.perPage + 1;
})
const endShowing = computed(() => {
    return Math.min(props.currentPage * props.perPage, props.totalProperties);
})

//selects locations
const cities = ref([]);
const zones = ref([]);


const totalPages = (total, per_page) => {
    return Math.ceil(total / per_page);
}

const handlePageChange = (page) => {
    updatePropertiesList(page);
}

const form = useForm({
    id: 0,
    'province_id': 0,
    'city_id': 0,
    'zone_id': 0,
    'neighborhood': '',
    'address': '',
    'lat': -32.875051,
    'lng': -68.834564,
    'type_id': 0,
    'status_id': 0,
    'is_price_dollar': true,
    'price_property': 0,
    'price_hidden': false,
    'description': '',
    'active': true,
    'seller_id': page.props.auth.user.id,
    'price_usd_m2': 0,
    'price_ars_m2': 0,
    'superficie_cubierta': 0,
    'superficie_total': 0,
    'aire_acondicionado': 'Indistinto',
    'dormitorios': 'Indistinto',
    'amoblado': 'Indistinto',
    'internet': 'Indistinto',
    'antiquity_id': 1,
    'piscina': 'Indistinto',
    'hipoteca': 'Indistinto',
    'plantas': 'Indistinto',
    'banos': 'Indistinto',
    'barrio_privado': 'Indistinto',
    'cable': 'Indistinto',
    'telefono': 'Indistinto',
    'calefaccion_central': 'Indistinto',
    'zona_escolar': 'Indistinto',
    'ambientes': 'Indistinto',
    'mascotas': 'Indistinto',
    'cochera': 'Indistinto',
    'expensas': 'Indistinto',
    'conservacion': 'Indistinto',
    'financiacion': 'Indistinto',
    'permuta': 'Indistinto',
    'agua': 'Indistinto',
    'gas': 'Indistinto',
    'luz': 'Indistinto',
    'cloacas': 'Indistinto',
    'imageCover': '',
    'currentImageCover': '',
    'imageExtra2': '',
    'currentImageExtra2': '',
    'imageExtra3': '',
    'currentImageExtra3': '',
    'imageExtra4': '',
    'currentImageExtra4': '',
    'imageExtra5': '',
    'currentImageExtra5': '',
    'imageExtra6': '',
    'currentImageExtra6': '',
});
//console.log($page.props.auth.user.id);
const updatePropertiesList = debounce((page) => {
    form.get(route('properties', {
            page: page,
            search: search.value,
            type: filterType.value,
            status: filterStatus.value,
            user: filterUser.value,
            province: filterProvince.value,
            price: filterPrice.value,
            priceMin: priceMin.value,
            priceMax: priceMax.value,
        }), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: (resp) => {
            //console.log(resp)
        },
        onError: (error) => {
            console.error(error)
        },
    });
}, 600); // 300ms debounce delay


//console.log(form);
const handleSubmitCRU = () => {
    create.value ? handleCreateProperty() : handleUpdateProperty();
}
const handleCreateProperty = () => {
    form.post(route('properties.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('¡Inmueble Creado!')
            form.reset()
            isShowModal.value = false
            updatePropertiesList(props.currentPage)
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
const handleUpdateProperty = () => {
    form.post(route('properties.update', { id: form.id }), {
        _method: 'put',
        preserveScroll: true,
        onSuccess: () => {
            toast.success('¡Inmueble Actualizado!')
            form.reset()
            isShowModal.value = false
            updatePropertiesList(props.currentPage)
        },
        onError: (error) => {
            const formErrors = form.errors;
            //console.error(error);
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
const handleDeleteProperty = () => {
    form.delete(route('properties.destroy', { id: form.id }), {
        _method: 'delete',
        preserveScroll: true,
        onSuccess: () => {
            toast.success('¡Inmueble Eliminado!')
            form.reset()
            isShowModalDelete.value = false
            updatePropertiesList(props.currentPage)
        },
        onError: (error) => {
            const formErrors = form.errors;
            //console.error(error);
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
const handleDeleteImage = (position,field) => {
    fetch(route('images.destroy', {id: form.id, position: position} ), {
        method: 'get',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Error en la solicitud');
        }
    })
    .then(data => {
        //console.log(data)
        toast.success(data.message)
        form[field] = '';
    })
    .catch(error => {
        if (error.message) {
            toast.warning(error.message);
        }
    });
}
const handleUpdateCities = () => {
    fetch(route('cities', { id: form.province_id }), {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Error en la solicitud');
        }
    })
    .then(data => {
        cities.value = data.cities;
    })
    .catch(error => {
        if (error.message) {
            toast.warning(error.message);
        }
    });
}
const handleUpdateZones = () => {
    fetch(route('zones', { id: form.city_id }), {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Error en la solicitud');
        }
    })
    .then(data => {
        zones.value = data.zones;
    })
    .catch(error => {
        if (error.message) {
            toast.warning(error.message);
        }
    });
}
const handleUpdateCords = (cords) => {
    form.lat = cords.lat;
    form.lng = cords.lng;
    //console.log('latitud: ' + cords.lat + ' longitud: ' + cords.lng)
}
//MODAL
const isShowModal = ref(false)
const isShowModalDelete = ref(false)

const modalTitle = ref('')


const resetInputsFile = () => {
    document.querySelector('input[name="imageCover"]').value = null;
    document.querySelector('input[name="imageExtra2"]').value = null;
    document.querySelector('input[name="imageExtra3"]').value = null;
    document.querySelector('input[name="imageExtra4"]').value = null;
    document.querySelector('input[name="imageExtra5"]').value = null;
    document.querySelector('input[name="imageExtra6"]').value = null;
}
const editProperty = (property) => {
    modalTitle.value = 'Editar Inmueble'
    form.reset()
    resetInputsFile()
    Object.assign(form, property)
    handleUpdateCities()
    handleUpdateZones()
    showModal()
    create.value = false
}
const createProperty = () => {
    modalTitle.value = 'Crear Inmueble'
    resetInputsFile()
    form.reset()
    showModal()
    create.value = true
}
const deleteProperty = (property) => {
    form.reset()
    Object.assign(form, property)
    showModalDelete()
}
const showModal = () => {
  isShowModal.value = true
}
const closeModal = () => {
  isShowModal.value = false
}
//Modal delete
const showModalDelete = () => {
  isShowModalDelete.value = true
}
const closeModalDelete = () => {
  isShowModalDelete.value = false
}

//servicios enum
const aire_acondicionado = ['Indistinto', 'Si', 'No'];
const dormitorios = ['Indistinto', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10 o más'];
const amoblado = ['Indistinto', 'Si', 'No'];
const internet = ['Indistinto', 'Si', 'No'];
const piscina = ['Indistinto', 'Si', 'No'];
const hipoteca = ['Indistinto', 'Si', 'No'];
const plantas = ['Indistinto', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10 o más'];
const banos = ['Indistinto', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10 o más'];
const barrio_privado = ['Indistinto', 'Si', 'No', 'Semi privado'];
const cable = ['Indistinto', 'Si', 'No'];
const telefono = ['Indistinto', 'Si', 'No'];
const calefaccion_central = ['Indistinto', 'Si', 'No'];
const zona_escolar = ['Indistinto', 'Si', 'No'];
const ambientes = ['Indistinto', 'Monoambiente', '2', '3', '4', '5', '6 o más'];
const mascotas = ['Indistinto', 'Si', 'No'];
const cochera = ['Indistinto', 'Garage', 'Garage/Cochera', 'Garage doble', 'Cochera pasante', 'Sin cochera'];
const expensas = ['Indistinto', 'Si', 'No'];
const conservacion = ['Indistinto', 'Excelente', 'Muy bueno', 'Bueno', 'Regular'];
const financiacion = ['Indistinto', 'Si', 'No'];
const permuta = ['Indistinto', 'Si', 'No'];
const agua = ['Indistinto', 'Si', 'No'];
const gas = ['Indistinto', 'Si', 'No'];
const luz = ['Indistinto', 'Si', 'No'];
const cloacas = ['Indistinto', 'Si', 'No'];

//image preview
const readURL = (event) => {
    const input = event.target;
    const inputName = input.getAttribute('name');
    const previewCurrent = input.getAttribute('data-preview');
    //const index = input.getAttribute('data-index');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const file = input.files[0];
        form[inputName] = file;
        reader.onload = (e) => {
            form[previewCurrent] = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
//FILTERS
const filterType = ref(0)
const filterStatus = ref(0)
const filterUser = ref(0)
const filterProvince = ref(0)
const filterPrice = ref('all')
const handleTypesChange = (value) => {
    filterType.value = value;
    updatePropertiesList(props.currentPage);
}
const handleStatusesChange = (value) => {
    filterStatus.value = value;
    updatePropertiesList(props.currentPage);
}
const handleUsersChange = (value) => {
    filterUser.value = value;
    updatePropertiesList(props.currentPage);
}
const handleProvincesChange = (value) => {
    filterProvince.value = value;
    updatePropertiesList(props.currentPage);
}
const handlePricesChange = (value) => {
    filterPrice.value = value;
    updatePropertiesList(props.currentPage);
}
const handleSelectCurrency = (value) => {
    //console.log(value)
    form.is_price_dollar = value;
}
//search bar
const search = ref('');
const priceMin = ref(0);
const priceMax = ref(0);
watch(
  () => [search.value, priceMin.value, priceMax.value],
  () => {
    updatePropertiesList(props.currentPage);
  },
)
//componentes
const resetFilters = () => {
    filterType.value = 0
    filterStatus.value = 0
    filterProvince.value = 0
    filterPrice.value = 'all'
    search.value = ''
    priceMin.value = 0
    priceMax.value = 0
    updatePropertiesList(props.currentPage);
}
</script>

<template>
    <Head title="Inmuebles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Inmuebles</h2>
        </template>

        <section class="bg-white dark:bg-surface-dark relative shadow-md sm:rounded-lg overflow-hidden">
            <TableHeader>
                <template #topHeader>
                    <ButtonIcon
                        name="Crear inmueble"
                        icon="icon-[fa-solid--plus]"
                        @click="createProperty"
                    >
                    </ButtonIcon>
                </template>
                <template #searchBar>
                        <label for="simple-search" class="sr-only">Buscar</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="icon-[mdi--search] w-5 h-5 text-gray-500 dark:text-white"></i>
                            </div>
                            <input
                                v-model="search"
                                type="text"
                                id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Buscar"
                            />
                        </div>
                </template>
                <template #filters>
                    <div class="inline-flex items-center justify-center p-4">
                        <Filters
                            title="Inmueble"
                            :current="filterType"
                            :items="types"
                            :onChange="handleTypesChange"
                        />
                    </div>
                    <div class="inline-flex items-center justify-center p-4">
                        <Filters
                            title="Condición"
                            :items="statuses"
                            :current="filterStatus"
                            :onChange="handleStatusesChange"
                        />
                    </div>
                    <div class="inline-flex items-center justify-center p-4">
                        <Filters
                            title="Usuario"
                            :items="users"
                            :current="filterUser"
                            :onChange="handleUsersChange"
                        />
                    </div>
                    <div class="inline-flex items-center justify-center p-4">
                        <Filters
                            title="Provincia"
                            :items="provinces"
                            :current="filterProvince"
                            :onChange="handleProvincesChange"
                        />
                    </div>
                    <div class="inline-flex items-center justify-center p-4">
                        <FiltersPrice
                            title="Precio"
                            :current="filterPrice"
                            :onChange="handlePricesChange"
                        />
                    </div>
                    <section>
                        <div class="inline-flex items-center justify-center p-4">
                            <div class="w-24 mr-4">
                                <label for="input-desde" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Precio desde:</label>
                                <input
                                    type="number"
                                    v-model="priceMin"
                                    id="input-desde"
                                    aria-describedby="helper-text-explanation"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="0"
                                />
                            </div>
                            <div class="w-24">
                                <label for="input-hasta" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Precio hasta:</label>
                                <input
                                    type="number"
                                    v-model="priceMax"
                                    id="input-hasta"
                                    aria-describedby="helper-text-explanation"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="0"
                                />
                            </div>

                        </div>
                    </section>
                    <div class="inline-flex items-center justify-center p-4">
                        <button type="button" @click="resetFilters()" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                            <svg class="w-4 h-4 text-black dark:text-gray-400 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                            </svg>
                            Reiniciar filtros
                        </button>
                    </div>
                </template>
            </TableHeader>

                <template v-if="props.properties && props.properties.length">

                        <div class="auto-rows-max col-span-12 min-[1023px]:col-span-8 min-[1279px]:col-span-9 min-[1610px]:col-span-10 mx-auto grid min-[1610px]:grid-cols-4 min-[1279px]:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-y-2 gap-x-2 md:gap-x-4 justify-items-center">
                            <Inmueble
                                v-for="item in props.properties"
                                :key="item.id"
                                :id="item.id"
                                :imageCover="item.currentImageCover"
                                :status="item.status"
                                :type="item.type"
                                :isPriceDollar="item.is_price_dollar"
                                :price="item.price_property"
                                :priceHidden="item.price_hidden"
                                :address="item.address"
                                :description="item.description"
                                :superficieCubierta="item.superficie_cubierta"
                                :superficieTotal="item.superficie_total"
                                :banos="item.banos"
                                :dormitorios="item.dormitorios"
                                :cochera="item.cochera"
                                :admin="true"
                                @edit="editProperty(item)"
                                @delete="deleteProperty(item)"
                            />
                        </div>
                </template>
                <template v-else>
                    <div class="ml-4 border-b dark:border-gray-700 h-72">
                        <p class="whitespace-nowrap">No hay inmuebles cargados</p>
                    </div>
                </template>

                <span class="pl-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                    Mostrando
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ startShowing }} - {{ endShowing }}
                    </span>
                    de
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{totalProperties}}
                    </span>
                    datos
                </span>

                <Pagination
                    :total="totalPages(totalProperties, perPage)"
                    :current="currentPage"
                    :onPageChange="handlePageChange"
                    :extraClass="'mt-2'"
                />
        </section>
        <!-- eliminar inmueble -->
        <Modal keyId="1" :show="isShowModalDelete" @close="closeModalDelete" size="2xl" persistent >
            <template #header>
                <div class="flex items-center text-lg text-black dark:text-white">
                    Eliminar Inmueble
                </div>
            </template>
            <template #body>
                <div class="text-center">
                    <h4 class="text-xl font-bold text-black dark:text-gray-400">¿Desea eliminar este inmueble?</h4>
                    <p class="text-lg font-bold text-red-600 dark:text-gray-400">{{ form.address }}</p>
                    <p class="text-md text-black dark:text-gray-400">Se eliminara de forma permanente</p>
                </div>
            </template>
            <template #footer>
                <div class="flex justify-between">
                    <SecondaryButton @click="closeModalDelete">Cancelar </SecondaryButton>

                    <DangerButton @click="handleDeleteProperty()" :disabled="form.processing">
                        Eliminar Inmueble
                    </DangerButton>
                </div>
            </template>
        </Modal>
        <!-- Crear Editar Inmueble -->
        <Modal keyId="2" :show="isShowModal" @close="closeModal" size="3xl" persistent :onSubmit="handleSubmitCRU">
            <template #header>
                <div class="flex items-center text-lg text-black dark:text-white">
                    {{ modalTitle }}
                </div>
            </template>
            <template #body>
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <Card colorHeader="primary">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="flex items-center">
                                <input v-model="form.active" type="checkbox" class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Publicar en la web</label>
                            </div>
                        </div>
                    </Card>
                    <Card colorHeader="primary">
                        <template #header>
                            <h3 class="font-semibold text-md text-white">Ubicación</h3>
                        </template>
                        <div class="grid gap-4 mb-3 sm:grid-cols-2">
                            <div class="mb-3">
                                <label for="province" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Provincia *</label>
                                <select
                                    v-model="form.province_id"
                                    @change="handleUpdateCities()"
                                    name="province_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required
                                >
                                    <option value="0" disabled>Elegir provincia</option>
                                    <option v-for="province in props.provinces" :key="province.id" :value="province.id" @click="handleUpdateCords({'lat':province.lat, 'lng':province.lng})" >{{ province.name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Departamento *</label>
                                <select
                                    v-model="form.city_id"
                                    @change="handleUpdateZones()"
                                    name="city_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required
                                >
                                    <option v-for="city in cities" :key="city.id" :value="city.id" @click="handleUpdateCords({'lat':city.lat, 'lng':city.lng})" >{{ city.name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="zone_id" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Zona o localidad</label>
                                <select
                                    v-model="form.zone_id"
                                    name="zone_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="zone in zones" :key="zone.id" :value="zone.id" >{{ zone.name }}</option>
                                </select>
                            </div>
                            <div >
                                <label for="neighborhood" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Barrio</label>
                                <input
                                    type="text"
                                    name="neighborhood"
                                    v-model="form.neighborhood"
                                    placeholder="Barrio"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Domicilio</label>
                            <input
                                type="text"
                                name="address"
                                v-model="form.address"
                                placeholder="Domicilio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required
                            />
                        </div>
                        <label for="marcar" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Marcar en el mapa</label>

                        <LeafletMap
                            :onClickMap="handleUpdateCords"
                            :render="isShowModal"
                            :latLng="{'lat':form.lat, 'lng':form.lng}"
                        />

                    </Card>
                    <Card colorHeader="primary">
                        <template #header>
                            <h3 class="font-semibold text-md text-white">Datos de la propiedad</h3>
                        </template>
                        <div class="grid gap-4 mb-3 sm:grid-cols-2">
                            <div class="mb-3">
                                <label for="type_id" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Tipo *</label>
                                <select
                                    v-model="form.type_id"
                                    name="type_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required
                                >
                                    <option value="0" disabled>Elegir tipo</option>
                                    <option v-for="propertyType in props.types" :key="propertyType.id" :value="propertyType.id" >{{ propertyType.name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status_id" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Condición *</label>
                                <select
                                    v-model="form.status_id"
                                    name="status_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required
                                >
                                    <option value="0" disabled>Elegir condición</option>
                                    <option v-for="status in props.statuses" :key="status.id" :value="status.id" >{{ status.name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="superficie_total" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Superficie total m2</label>
                                <input
                                    type="number"
                                    name="superficie_total"
                                    v-model="form.superficie_total"
                                    placeholder="Superficie total en M2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="superficie_cubierta" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Superficie cubierta m2</label>
                                <input
                                    type="number"
                                    name="superficie_cubierta"
                                    v-model="form.superficie_cubierta"
                                    placeholder="Superficie cubierta en M2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                />
                            </div>

                            <div class="mb-3">
                                <label for="superficie_cubierta" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Precio del inmueble</label>
                                <div class="flex">
                                    <DropdownCurrency
                                        @select="handleSelectCurrency($event)"
                                        :currency="form.is_price_dollar"
                                    />
                                    <div class="relative w-full">
                                        <input
                                            type="number"
                                            name="price_property"
                                            v-model="form.price_property"
                                            placeholder="0.00"
                                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-primary-500"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="flex items-center">
                                    <input v-model="form.price_hidden" id="checked_price_hiden" type="checkbox" class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checked_price_hiden" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ocultar precio</label>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="description" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Descripción *</label>
                            <textarea
                                rows="4"
                                name="description"
                                v-model="form.description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required
                            ></textarea>
                        </div>
                    </Card>
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <Card colorHeader="primary">
                        <template #header>
                            <h3 class="font-semibold text-md text-white">Servicios</h3>
                        </template>
                        <div class="grid gap-4 mb-3 sm:grid-cols-2">


                            <div class="mb-3">
                                <label for="ambientes" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Ambientes</label>
                                <select
                                    v-model="form.ambientes"
                                    name="ambientes"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in ambientes" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="plantas" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Plantas</label>
                                <select
                                    v-model="form.plantas"
                                    name="plantas"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in plantas" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dormitorios" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Dormitorios</label>
                                <select
                                    v-model="form.dormitorios"
                                    name="dormitorios"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in dormitorios" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="banos" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Baños</label>
                                <select
                                    v-model="form.banos"
                                    name="banos"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in banos" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cochera" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Cochera</label>
                                <select
                                    v-model="form.cochera"
                                    name="cochera"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in cochera" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="expensas" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Tiene expensas</label>
                                <select
                                    v-model="form.expensas"
                                    name="expensas"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in expensas" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="antiquity_id" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Antigüedad</label>
                                <select
                                    v-model="form.antiquity_id"
                                    name="antiquity_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in antiquities" :key="value.id" :value="value.id" >{{ value.name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="conservacion" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Estado de conservación</label>
                                <select
                                    v-model="form.conservacion"
                                    name="conservacion"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in conservacion" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="financiacion" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Financiación</label>
                                <select
                                    v-model="form.financiacion"
                                    name="financiacion"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in financiacion" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="hipoteca" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Ápto crédito hipotecario</label>
                                <select
                                    v-model="form.hipoteca"
                                    name="hipoteca"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in hipoteca" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="permuta" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Permuta</label>
                                <select
                                    v-model="form.permuta"
                                    name="permuta"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in permuta" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="barrio_privado" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Barrio privado</label>
                                <select
                                    v-model="form.barrio_privado"
                                    name="barrio_privado"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in barrio_privado" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="amoblado" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Amoblado</label>
                                <select
                                    v-model="form.amoblado"
                                    name="aire_acondicionado"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in amoblado" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="internet" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Internet</label>
                                <select
                                    v-model="form.internet"
                                    name="internet"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in internet" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="piscina" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Piscina</label>
                                <select
                                    v-model="form.piscina"
                                    name="piscina"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in piscina" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cable" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Cable</label>
                                <select
                                    v-model="form.cable"
                                    name="cable"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in cable" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Teléfono</label>
                                <select
                                    v-model="form.telefono"
                                    name="telefono"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in telefono" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="aire_acondicionado" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Aire acondicionado</label>
                                <select
                                    v-model="form.aire_acondicionado"
                                    name="aire_acondicionado"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in aire_acondicionado" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="calefaccion_central" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Calefacción central</label>
                                <select
                                    v-model="form.calefaccion_central"
                                    name="calefaccion_central"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in calefaccion_central" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="mascotas" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Mascotas</label>
                                <select
                                    v-model="form.mascotas"
                                    name="mascotas"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in mascotas" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="zona_escolar" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Zona escolar</label>
                                <select
                                    v-model="form.zona_escolar"
                                    name="zona_escolar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in zona_escolar" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="agua" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Agua</label>
                                <select
                                    v-model="form.agua"
                                    name="agua"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in agua" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="gas" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Gas</label>
                                <select
                                    v-model="form.gas"
                                    name="gas"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in gas" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="luz" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Luz</label>
                                <select
                                    v-model="form.luz"
                                    name="luz"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in luz" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cloacas" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Cloacas</label>
                                <select
                                    v-model="form.cloacas"
                                    name="cloacas"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option v-for="value in cloacas" :key="value" :value="value" >{{ value }}</option>
                                </select>
                            </div>
                        </div>
                    </Card>
                    <Card colorHeader="primary">
                        <template #header>
                            <h3 class="font-semibold text-md text-white">Foto de portada</h3>
                        </template>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir imagen</label>
                            <input
                                type="file"
                                name="imageCover"
                                data-preview="currentImageCover"
                                @change="readURL"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                :required="create"
                            />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG, JPEG (MAX. 2mb).</p>


                            <div v-if="form.progress" class="absolute z-[9999] top-1/2 left-[calc(50%-96px)] sm:left-[calc(50%-144px)] bg-white p-4 rounded">
                                <div  class="flex justify-between mb-1">
                                    <span class="text-base font-medium text-primary-700 dark:text-white">Subiendo <span class="max-sm:hidden">imágenes</span></span>
                                    <span class="text-sm font-medium text-primary-700 dark:text-white">{{ form.progress.percentage }}%</span>
                                </div>
                                <progress :value="form.progress.percentage" max="100" class="h-2.5 w-48 sm:w-72 rounded-full">
                                    {{ form.progress.percentage }}%
                                </progress>
                            </div>


                            <div class="max-w-72 h-56 mt-3">
                                <img class="rounded-md w-full h-full object-cover border" :src="form.currentImageCover ? form.currentImageCover : '/images/properties/sin-propiedad.svg'" alt="preview" />
                            </div>
                        </div>
                    </Card>
                    <Card colorHeader="primary">
                        <template #header>
                            <h3 class="font-semibold text-md text-white">Fotos Extras</h3>
                        </template>
                        <div>

                            <div class="sm:flex sm:flex-row w-full">
                                <figure class="relative w-32 h-24">
                                    <img class="rounded-md w-full h-full object-cover border" :src="form.currentImageExtra2 ? form.currentImageExtra2 : '/images/properties/sin-propiedad.svg'" alt="preview" />
                                    <figcaption v-show="form.currentImageExtra2 && !form.currentImageExtra2.startsWith('data:image/')" @click="handleDeleteImage(2,'currentImageExtra2')" class="absolute px-1 rounded-full border border-red-400 text-lg bg-white dark:bg-gray-800 -top-2 -right-2 hover:bg-red-600 group cursor-pointer">
                                        <span class="icon-[tabler--trash] text-red-600 group-hover:text-white"></span>
                                    </figcaption>
                                </figure >
                                <div class="sm:px-4 w-full">
                                    <label class="block font-medium text-gray-900 dark:text-white">Imagen Extra 1</label>
                                    <input
                                        type="file"
                                        name="imageExtra2"
                                        data-preview="currentImageExtra2"
                                        @change="readURL"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG, JPEG (MAX. 2mb).</p>
                                </div>
                            </div>

                            <div class="sm:flex sm:flex-row w-full mt-4">
                                <figure class="relative w-32 h-24">
                                    <img class="rounded-md w-full h-full object-cover border" :src="form.currentImageExtra3 ? form.currentImageExtra3 : '/images/properties/sin-propiedad.svg'" alt="preview" />
                                    <figcaption v-show="form.currentImageExtra3 && !form.currentImageExtra3.startsWith('data:image/')" @click="handleDeleteImage(3,'currentImageExtra3')" class="absolute px-1 rounded-full border border-red-400 text-lg bg-white dark:bg-gray-800 -top-2 -right-2 hover:bg-red-600 group cursor-pointer">
                                        <span class="icon-[tabler--trash] text-red-600 group-hover:text-white"></span>
                                    </figcaption>
                                </figure >
                                <div class="sm:px-4 w-full">
                                    <label class="block font-medium text-gray-900 dark:text-white">Imagen Extra 2</label>
                                    <input
                                        type="file"
                                        name="imageExtra3"
                                        data-preview="currentImageExtra3"
                                        @change="readURL"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG, JPEG (MAX. 2mb).</p>
                                </div>
                            </div>

                            <div class="sm:flex sm:flex-row w-full mt-4">
                                <figure class="relative w-32 h-24">
                                    <img class="rounded-md w-full h-full object-cover border" :src="form.currentImageExtra4 ? form.currentImageExtra4 : '/images/properties/sin-propiedad.svg'" alt="preview" />
                                    <figcaption v-show="form.currentImageExtra4 && !form.currentImageExtra4.startsWith('data:image/')" @click="handleDeleteImage(4,'currentImageExtra4')" class="absolute px-1 rounded-full border border-red-400 text-lg bg-white dark:bg-gray-800 -top-2 -right-2 hover:bg-red-600 group cursor-pointer">
                                        <span class="icon-[tabler--trash] text-red-600 group-hover:text-white"></span>
                                    </figcaption>
                                </figure >
                                <div class="sm:px-4 w-full">
                                    <label class="block font-medium text-gray-900 dark:text-white">Imagen Extra 3</label>
                                    <input
                                        type="file"
                                        name="imageExtra4"
                                        data-preview="currentImageExtra4"
                                        @change="readURL"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG, JPEG (MAX. 2mb).</p>
                                </div>
                            </div>

                            <div class="sm:flex sm:flex-row w-full mt-4">
                                <figure class="relative w-32 h-24">
                                    <img class="rounded-md w-full h-full object-cover border" :src="form.currentImageExtra5 ? form.currentImageExtra5 : '/images/properties/sin-propiedad.svg'" alt="preview" />
                                    <figcaption v-show="form.currentImageExtra5 && !form.currentImageExtra5.startsWith('data:image/')" @click="handleDeleteImage(5,'currentImageExtra5')" class="absolute px-1 rounded-full border border-red-400 text-lg bg-white dark:bg-gray-800 -top-2 -right-2 hover:bg-red-600 group cursor-pointer">
                                        <span class="icon-[tabler--trash] text-red-600 group-hover:text-white"></span>
                                    </figcaption>
                                </figure >
                                <div class="sm:px-4 w-full">
                                    <label class="block font-medium text-gray-900 dark:text-white">Imagen Extra 4</label>
                                    <input
                                        type="file"
                                        name="imageExtra5"
                                        data-preview="currentImageExtra5"
                                        @change="readURL"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG, JPEG (MAX. 2mb).</p>
                                </div>
                            </div>

                            <div class="sm:flex sm:flex-row w-full mt-4">
                                <figure class="relative w-32 h-24">
                                    <img class="rounded-md w-full h-full object-cover border" :src="form.currentImageExtra6 ? form.currentImageExtra6 : '/images/properties/sin-propiedad.svg'" alt="preview" />
                                    <figcaption v-show="form.currentImageExtra6 && !form.currentImageExtra6.startsWith('data:image/')" @click="handleDeleteImage(6,'currentImageExtra6')" class="absolute px-1 rounded-full border border-red-400 text-lg bg-white dark:bg-gray-800 -top-2 -right-2 hover:bg-red-600 group cursor-pointer">
                                        <span class="icon-[tabler--trash] text-red-600 group-hover:text-white"></span>
                                    </figcaption>
                                </figure >
                                <div class="sm:px-4 w-full">
                                    <label class="block font-medium text-gray-900 dark:text-white">Imagen Extra 5</label>
                                    <input
                                        type="file"
                                        name="imageExtra6"
                                        data-preview="currentImageExtra6"
                                        @change="readURL"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG, JPEG (MAX. 2mb).</p>
                                </div>
                            </div>
                        </div>
                    </Card>
                </div>
            </template>
            <template #footer>
                <div class="flex justify-between">
                    <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                    <SuccessButton type="submit" :disabled="form.processing">
                        {{ modalTitle }}
                    </SuccessButton>
                </div>
            </template>
        </Modal>

    </AuthenticatedLayout>
</template>
