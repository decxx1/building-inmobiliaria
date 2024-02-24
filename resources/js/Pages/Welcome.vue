<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Nav from '../Components/Nav.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0">
            <Nav v-if="$page.props.auth.user">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-900 md:dark:bg-gray-900 dark:border-gray-700">
                    <li >
                        <a :href="route('dashboard')" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Iniciar sesión</a>
                    </li>
                </ul>
            </Nav>
            <Nav v-else>
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0  dark:bg-gray-900 md:dark:bg-gray-900 dark:border-gray-900">
                    <li v-if="$page.props.auth.user">
                        <a :href="route('dashboard')" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Dashboard</a>
                    </li>
                    <li>
                        <a :href="route('login')" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Iniciar sesión</a>
                    </li>
                    <li v-if="canRegister">
                        <a :href="route('register')" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Registrarse</a>
                    </li>
                </ul>
            </Nav>
        </div>

        <div class="text-center container">
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Dashboard Base <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">con Flowbite</span></h1>
            <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Laravel con vue e inertia.</p>
        </div>
    </div>
</template>

<style>

</style>
