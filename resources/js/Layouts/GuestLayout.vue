<script setup>
import ApplicationImagotipo from '@/Components/ApplicationImagotipo.vue';
import { Toaster } from 'vue-sonner'
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <Toaster richColors position="bottom-right" />
        <div>
            <Link href="/" class="flex ms-2 justify-center">
                <ApplicationImagotipo heightClass="h-16" />
                <span class="self-center md:text-xl font-semibold lg:text-2xl hidden md:block whitespace-nowrap dark:text-white">ManejoWeb</span>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
