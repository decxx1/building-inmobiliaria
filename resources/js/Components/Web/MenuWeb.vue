<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const path = ref('');

onMounted(() => {
    path.value = window.location.pathname;
})
</script>
<template>
    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-4 lg:mt-0">
        <li :class="[path === '/' ? 'bg-white dark:bg-gray-700' : '', 'lg:py-5 lg:px-4 cursor-pointer group hover:bg-white dark:hover:bg-gray-700']" >
            <Link :href="route('index')"
                :class="[path === '/' ? 'bg-white dark:bg-gray-700 text-primary-web-700 lg:text-primary-web-700 lg:font-normal dark:text-white' : 'text-white', 'block py-2 pr-4 pl-3  border-b border-gray-100 lg:border-0 group-hover:text-primary-web-700 lg:p-0 dark:text-gray-400 lg:dark:group-hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700']"
                aria-current="page">Inicio</Link>
        </li>
        <li :class="[path === '/inmuebles' ? 'bg-white dark:bg-gray-700' : '', 'lg:py-5 lg:px-4 cursor-pointer group hover:bg-white dark:hover:bg-gray-700']">
            <Link :href="route('inmuebles')"
            :class="[path === '/inmuebles' ? 'bg-white dark:bg-gray-700 text-primary-web-700 lg:text-primary-web-700 lg:font-normal dark:text-white' : 'text-white', 'block py-2 pr-4 pl-3  border-b border-gray-100 lg:border-0 group-hover:text-primary-web-700 lg:p-0 dark:text-gray-400 lg:dark:group-hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700']"
                >Inmuebles</Link>
        </li>
        <li :class="[path === '/contacto' ? 'bg-white dark:bg-gray-700' : '', 'lg:py-5 lg:px-4 cursor-pointer group hover:bg-white dark:hover:bg-gray-700']">
            <Link href="/contacto"
            :class="[path === '/contacto' ? 'bg-white dark:bg-gray-700 text-primary-web-700 lg:text-primary-web-700 lg:font-normal dark:text-white' : 'text-white', 'block py-2 pr-4 pl-3  border-b border-gray-100 lg:border-0 group-hover:text-primary-web-700 lg:p-0 dark:text-gray-400 lg:dark:group-hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700']"
                >Contacto</Link>
        </li>
    </ul>
</template>
