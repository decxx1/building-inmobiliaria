<script setup>
import { Link } from '@inertiajs/vue3';

</script>
<template>
    <section class="bg-primary-web-700 dark:bg-gray-800 max-sm:pb-12 py-4 sm:py-12">
        <div class="grid grid-cols-12 mx-auto">
            <div class="col-span-12 sm:col-span-6 lg:col-span-4 px-12 max-sm:pt-4 max-sm:pb-8 sm:py-4">
                <img src="images/logos/building-inmobiliaria.webp" class="w-full min-[1420px]:w-9/12 mx-auto" alt="Building Inmobiliaria Logo" />
            </div>
            <div class="col-span-12 sm:col-span-6 lg:col-span-8 mx-auto my-auto">
                <div class="grid grid-cols-2 min-[500px]:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-12 items-center mx-auto">
                    <Link :href="route('inmuebles',{'page':1, 'type':1})" class="bg-white p-4 cursor-pointer transition-all transform hover:scale-105 hover:-rotate-6 rounded-2xl w-28 lg:w-36 h-28 lg:h-36 text-center">
                        <img src="images/features/casas.svg" class="max-w-16 lg:max-w-24 mx-auto" alt="venta y alquiler de casas" />
                        <h3 class="font-bold text-primary-web-700 dark:text-black">Casas</h3>
                    </Link>
                    <Link :href="route('inmuebles',{'page':1, 'type':2})" class="bg-white p-4 cursor-pointer transition-all transform hover:scale-105 hover:-rotate-6  rounded-2xl w-28 lg:w-36 h-28 lg:h-36 text-center">
                        <img src="images/features/deptos.svg" class="max-w-16 lg:max-w-24 mx-auto" alt="venta y alquiler de departamentos" />
                        <h3 class="font-bold text-primary-web-700 dark:text-black">Deptos</h3>
                    </Link>
                    <Link :href="route('inmuebles',{'page':1, 'type':32})" class="bg-white p-4 cursor-pointer transition-all transform hover:scale-105 hover:-rotate-6  rounded-2xl w-28 lg:w-36 h-28 lg:h-36 text-center">
                        <img src="images/features/terrenos.svg" class="max-w-16 lg:max-w-24 mx-auto" alt="venta y alquiler de terrenos" />
                        <h3 class="font-bold text-primary-web-700 dark:text-black">Terrenos</h3>
                    </Link>
                    <Link :href="route('inmuebles',{'page':1, 'type':26})" class="bg-white p-4 cursor-pointer transition-all transform hover:scale-105 hover:-rotate-6  rounded-2xl w-28 lg:w-36 h-28 lg:h-36 text-center">
                        <img src="images/features/oficinas.svg" class="max-w-16 lg:max-w-24 mx-auto" alt="venta y alquiler de oficinas" />
                        <h3 class="font-bold text-primary-web-700 dark:text-black">Oficinas</h3>
                    </Link>
                    <Link :href="route('inmuebles',{'page':1, 'type':22})" class="bg-white p-4 cursor-pointer transition-all transform hover:scale-105 hover:-rotate-6  rounded-2xl w-28 lg:w-36 h-28 lg:h-36 text-center">
                        <img src="images/features/comercios.svg" class="max-w-16 lg:max-w-24 mx-auto" alt="venta y alquiler de comercios" />
                        <h3 class="font-bold text-primary-web-700 dark:text-black">Comercios</h3>
                    </Link>
                    <Link :href="route('inmuebles',{'page':1, 'type':9})" class="bg-white p-4 cursor-pointer transition-all transform hover:scale-105 hover:-rotate-6  rounded-2xl w-28 lg:w-36 h-28 lg:h-36 text-center">
                        <img src="images/features/cocheras.svg" class="max-w-16 lg:max-w-24 mx-auto" alt="venta y alquiler de cocheras" />
                        <h3 class="font-bold text-primary-web-700 dark:text-black">Cocheras</h3>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
