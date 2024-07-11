<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
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
const search = ref('');
const filterType = ref(0);
const filterStatus = ref(0);
const updatePropertiesList = () => {
    form.get(route('inmuebles', {
            page: 1,
            search: search.value,
            type: filterType.value,
            status: filterStatus.value,
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
};
</script>
<template>
    <section
        class="bg-[url('/images/hero.avif')] bg-no-repeat bg-cover bg-center bg-gray-100 bg-blend-multiply dark:bg-gray-400">
        <div class="relative py-8 px-4 mx-auto max-w-screen-xl lg:py-52 xl:px-0 z-1">
            <div class="max-w-md text-center mx-auto min-h-96 justify-center flex">
                <div class="bg-white p-4 dark:bg-gray-800 rounded bottom-24 lg:bottom-64 absolute">
                    <form @submit.prevent="updatePropertiesList" class="mx-auto grid gap-4 grid-cols-12">
                        <select v-model="filterType" class="col-span-6 sm:col-span-2 max-sm:mb-2 p-2 h-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-700 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500">
                            <option :value="0" selected>Todos</option>
                            <option v-for="(item) in props.types" :key="item.id" :value="item.id">{{ item.name }}</option>
                        </select>
                        <select v-model="filterStatus" class="col-span-6 sm:col-span-3 max-sm:mb-2 p-2 h-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-700 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500">
                            <option :value="0">Todos</option>
                            <option v-for="(item) in props.statuses" :key="item.id" :value="item.id">{{ item.name }}</option>
                        </select>
                        <div class="col-span-12 sm:col-span-5 relative max-sm:mb-2">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" v-model="search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-primary-web-500 focus:border-primary-web-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500" placeholder="Ingrese ubicación" />
                        </div>
                        <button type="submit" :disabled="form.processing" class="col-span-12 sm:col-span-2 text-white bg-primary-web-700 hover:bg-primary-web-800 focus:ring-4 focus:ring-primary-web-300 font-medium text-sm py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
