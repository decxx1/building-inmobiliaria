<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import Layout from '@/Layouts/Layout.vue';
import HeaderWeb from '@/Components/Web/HeaderWeb.vue';
import BreadCrums from '@/Components/Web/BreadCrumbsWeb.vue';
import Properties from '@/Components/Web/Properties.vue';
import Pagination from '@/Components/Pagination.vue';
import Filters from '@/Components/Filters.vue';
import FiltersPrice from '@/Components/FiltersPrice.vue';
import Sidebar from '@/Components/Web/Sidebar.vue';
import { ref, computed, watch } from 'vue';
import { debounce } from 'lodash';
import {
    initDrawers,
} from 'flowbite';
router.on('navigate', (event) => {
    initDrawers();
})

//leer parámetros de la url
const urlParams = new URLSearchParams(window.location.search)

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
});
const form = useForm({});

//showing items
const startShowing = computed(() => {
    return (props.currentPage - 1) * props.perPage + 1;
})
const endShowing = computed(() => {
    return Math.min(props.currentPage * props.perPage, props.totalProperties);
})
const totalPages = (total, per_page) => {
    return Math.ceil(total / per_page);
}

const handlePageChange = (page) => {
    updatePropertiesList(page);
}

const updatePropertiesList = debounce((page) => {
    form.get(route('inmuebles', {
            page: page,
            search: search.value,
            type: filterType.value,
            status: filterStatus.value,
            province: filterProvince.value,
            city: filterCity.value,
            price: filterPrice.value,
            priceMin: priceMin.value,
            priceMax: priceMax.value,
        }), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onSuccess: (resp) => {
            //console.log(resp)
        },
        onError: (error) => {
            console.error(error)
        },
    });
}, 1000);

//FILTERS
const filterType = ref(Number(urlParams.get('type')) || 0)
//console.log(filterType.value)
const filterStatus = ref(Number(urlParams.get('status')) || 0)
const filterProvince = ref(Number(urlParams.get('province')) || 0)
const filterCity = ref(0)
const filterPrice = ref('all')
const cities = ref([]);

const handleUpdateCities = () => {
    fetch(route('cities', { id: filterProvince.value }), {
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
        //console.log (cities.value);
    })
    .catch(error => {
        if (error.message) {
            console.error(error.message);
        }
    });
}
//solo se ejecuta al inicio si la provincia está seleccionada
if(filterProvince.value > 0){
    handleUpdateCities();
}
const handleTypesChange = (value) => {
    filterType.value = value;
    updatePropertiesList(props.currentPage);
}
const handleStatusesChange = (value) => {
    filterStatus.value = value;
    updatePropertiesList(props.currentPage);
}
const handleProvincesChange = (value) => {
    filterProvince.value = value;
    filterCity.value = 0;
    handleUpdateCities();
    updatePropertiesList(props.currentPage);
}
const handleCitiesChange = (value) => {
    filterCity.value = value;
    updatePropertiesList(props.currentPage);
}
const handlePricesChange = (value) => {
    filterPrice.value = value;
    updatePropertiesList(props.currentPage);
}

//search bar
const search = ref(urlParams.get('search') || '');
const priceMin = ref(Number(urlParams.get('priceMin')) || 0);
const priceMax = ref(Number(urlParams.get('priceMax')) || 0);
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
    filterCity.value = 0
    filterPrice.value = 'all'
    search.value = ''
    priceMin.value = 0
    priceMax.value = 0
    updatePropertiesList(props.currentPage);
}
</script>
<template>
    <Layout
        title="Inmuebles"
        canonical="https://inmobiliariabuilding.com.ar/inmuebles"
        metaTitle="Inmuebles - Building Inmobiliaria"
        metaDescription="Venta y alquileres de casas, departamentos, terrenos, oficinas. Todos los inmuebles que ofrece Building Inmobiliaria en Argentina ¿Deseas tasar tu propiedad?"
        metaImg="https://inmobiliariabuilding.com.ar/images/breadcrumbs.avif"
        preLoad="/images/breadcrumbs.avif"
    >
        <HeaderWeb :heroPage="false" />
        <BreadCrums page="Inmuebles" path="inmuebles" />
        <section class="container px-6 py-12 mx-auto">
            <h2 class="mb-4 text-center text-2xl font-extrabold leading-none tracking-tight text-primary-web-700 md:text-3xl lg:text-4xl dark:text-white">Su propiedad ideal</h2>
            <p class="text-center text-base text-primary-web-700 md:text-md lg:text-lg dark:text-white">Realice su búsqueda</p>
        </section>

        <section class="mb-4 mx-auto overflow-hidden px-10">
            <div class="w-full mx-auto px-2 sm:px-4 pb-6 pt-4 md:pb-2 flex flex-column sm:flex-row flex-wrap items-center justify-center">
                <button
                    data-drawer-target="drawer-navigation"
                    data-drawer-toggle="drawer-navigation"
                    aria-controls="drawer-navigation"
                    data-drawer-body-scrolling="true"
                    class="min-[1023px]:hidden px-4 py-2 sm:mr-4 flex text-white border bg-primary-web-700 border-primary-web-700 cursor-pointer rounded hover:bg-primary-web-600 dark:focus:bg-gray-700 focus:ring-2 focus:ring-primary-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    <svg class="w-5 h-5 mr-3 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"><path fill="currentColor" fill-rule="evenodd" d="M15 3H0V2h15zm-3 5H3V7h9zm-2 5H5v-1h5z" clip-rule="evenodd"/></svg>
                    Filtros
                </button>
                <Pagination
                    :total="totalPages(totalProperties, perPage)"
                    :current="currentPage"
                    :onPageChange="handlePageChange"
                    extraClass=""
                />

            </div>
        </section>
        <div class="grid gap-4 grid-cols-12 mx-auto max-w-full sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-[1380px] 2xl:max-w-[1610px] ">
            <div class="col-span-12 min-[1023px]:col-span-4 min-[1281px]:col-span-3 min-[1610px]:col-span-2">
                <Sidebar>
                    <h5 id="drawer-navigation-label" class="text-base font-semibold text-primary-web-700 uppercase dark:text-gray-300 mb-4">Buscar</h5>
                    <div class="relative w-full mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="icon-[mdi--search] w-5 h-5 text-gray-500 dark:text-white"></i>
                        </div>
                        <input
                            v-model="search"
                            type="text"
                            id="simple-search"
                            class="bg-white border border-primary-web-700 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-500 block w-full pl-10 p-2 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Buscar"
                        />
                    </div>
                    <div class="flex justify-between">
                        <h5 class="text-base font-semibold text-primary-web-700 uppercase dark:text-gray-300 mb-4 inline">Filtros</h5>
                        <span @click="resetFilters" class="cursor-pointer hover:font-bold text-gray-700 dark:text-gray-400">Reiniciar</span>
                    </div>
                    <div class=" py-2">
                        <Filters
                            title="Inmueble"
                            :current="filterType"
                            :items="types"
                            extraClass="w-full"
                            :onChange="handleTypesChange"
                        />
                    </div>
                    <div class=" py-2">
                        <Filters
                            title="Condición"
                            :current="filterStatus"
                            :items="statuses"
                            extraClass="w-full"
                            :onChange="handleStatusesChange"
                        />
                    </div>
                    <div class=" py-2">
                        <Filters
                            title="Provincia"
                            :current="filterProvince"
                            :items="provinces"
                            extraClass="w-full"
                            :onChange="handleProvincesChange"
                        />
                    </div>
                    <div class=" py-2">
                        <Filters
                            title="Ciudad"
                            :current="filterCity"
                            :items="cities"
                            extraClass="w-full"
                            :onChange="handleCitiesChange"
                        />
                    </div>
                    <div class=" py-2">
                        <FiltersPrice
                            :current="filterPrice"
                            title="Precio"
                            extraClass="w-full"
                            :onChange="handlePricesChange"
                        />
                    </div>
                    <section>
                        <div class="flex flex-wrap py-4">
                            <div class="w-full mb-4">
                                <label for="input-desde" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Precio desde:</label>
                                <input
                                    type="number"
                                    v-model="priceMin"
                                    id="input-desde"
                                    aria-describedby="helper-text-explanation"
                                    class="w-full bg-white border border-primary-web-700 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-500 block py-1.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500"
                                    placeholder="0"
                                />
                            </div>
                            <div class="w-full">
                                <label for="input-hasta" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Precio hasta:</label>
                                <input
                                    type="number"
                                    v-model="priceMax"
                                    id="input-hasta"
                                    aria-describedby="helper-text-explanation"
                                    class="w-full bg-white border border-primary-web-700 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-500 block py-1.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500"
                                    placeholder="0"
                                />
                            </div>
                        </div>
                    </section>
                </Sidebar>
            </div>
            <div class="auto-rows-max col-span-12 min-[1023px]:col-span-8 min-[1281px]:col-span-9 min-[1610px]:col-span-10 mx-auto grid min-[1610px]:grid-cols-4 min-[1281px]:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-y-2 gap-x-8 justify-items-center">
                <Properties :properties="props.properties" />
            </div>
        </div>
        <Pagination
            :total="totalPages(totalProperties, perPage)"
            :current="currentPage"
            :onPageChange="handlePageChange"
            extraClass="mt-4"
        />
    </Layout>
</template>
