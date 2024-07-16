<script setup>
import { Link } from '@inertiajs/vue3';

</script>
<template>
    <section class="bg-gradient-to-b from-body via-primary-web-100 to-body py-12 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-md text-center">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-primary-web-700 dark:text-white">
                    ¿Querés vender o alquilar una propiedad con nosotros?</h2>
                <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">
                    Contactanos para obtener más información.
                </p>
                <Link :href="route('contacto')" class="text-white bg-primary-web-700 hover:bg-primary-web-600 focus:ring-4 focus:ring-primary-web-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none dark:focus:ring-primary-web-800">
                    Contáctenos</Link>
            </div>
        </div>
    </section>
</template>
