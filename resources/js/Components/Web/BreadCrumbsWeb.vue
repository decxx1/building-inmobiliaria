<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    page: {
        type: String,
        required: true,
    },
    path: {
        type: String,
        required: true
    }
})
</script>
<template>
    <section class="bg-[url('/images/breadcrumbs.avif')] bg-no-repeat bg-cover bg-center bg-gray-400 bg-blend-multiply dark:bg-gray-600">
        <div class="relative py-20 px-4 mx-auto max-w-screen-lg xl:px-0 z-1 container flex flex-col sm:flex-row justify-center sm:justify-between items-center">
            <h1 class="text-5xl font-bold text-white max-sm:mb-4">{{ page }}</h1>
            <div class="flex items-center space-x-2 border border-white rounded-full w-max px-4 py-1">
                <Link :href="route('index')">
                    <img src="/images/icons/home.svg" class="w-6" alt="home" />
                </Link>
                <p class="text-md text-white"> / {{ path }}</p>

            </div>
        </div>
    </section>
</template>
