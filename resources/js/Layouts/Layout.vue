<script setup>
import { Toaster } from 'vue-sonner';
import { router } from '@inertiajs/vue3'
import FooterWeb from '@/Components/Web/FooterWeb.vue';
import WhatsAppButton from '@/Components/Web/WhatsAppButton.vue';
import { onMounted } from 'vue';
import '@fontsource/poppins/400.css';
import '@fontsource/poppins/500.css';
import '@fontsource/poppins/600.css';
import '@fontsource/poppins/700.css';
import '@fontsource/poppins/800.css';
import '@fontsource/poppins/900.css';
import {
    initDropdowns,
    initCollapses,
} from 'flowbite';

onMounted(() => {
    initDropdowns();
    initCollapses();

})
router.on('navigate', (event) => {
    initDropdowns();
    initCollapses();
})


</script>
<template>
    <Toaster
        richColors
        position="top-right"
    />
    <main class="font-Poppins bg-body dark:bg-gray-900 scrollbar scrollbar-w-3 scrollbar-thumb-rounded-[0.25rem] scrollbar-track-gray-200 scrollbar-thumb-gray-400 dark:scrollbar-track-gray-900 dark:scrollbar-thumb-gray-700">
        <slot />
    </main>
    <WhatsAppButton />
    <FooterWeb />
</template>

<style>
/*recaptcha*/
.grecaptcha-badge {
	width: 70px !important;
	overflow: hidden !important;
	transition: all 0.3s ease !important;
	left: 4px !important;
	z-index:100;
}

.grecaptcha-badge:hover {
	width: 256px !important;
}
</style>
