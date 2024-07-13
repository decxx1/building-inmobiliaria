<script setup>
import { Head } from '@inertiajs/vue3'
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
const props = defineProps({
	title: {
        type: String
    },
	canonical:{
        type: String
    },
	metaTitle: {
        type: String
    },
	metaDescription: {
        type: String
    },
	metaImg: {
        type: String
    },
	preLoad: {
        type: String,
        required: false
    }
});

</script>
<template>
    <Head>
        <link rel="icon" type="image/svg+xml" href="/images/logos/imagotipo.svg" />
        <title>{{ props.title }}</title>
		<!-- SEO -->
		<link rel="canonical" :href="props.canonical" />
		<!-- GOOGLE -->
		<meta name="title" :content="props.metaTitle" />
		<meta name="description" :content="props.metaDescription" />
		<meta http-equiv="Cache-Control" content="no-cache" />
		<meta http-equiv="Expires" content="Mon, 01 Jul 1970 00:00:00 GMT" />
		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow" />
		 <!-- FACEBOOK OPEN GRAPH TAGS -->
		<meta property="og:title" :content="props.metaTitle" />
		<meta property="og:description" :content="props.metaDescription" />
		<meta property="og:type" content="website" />
		<meta property="og:url" :content="props.canonical" />
		<meta property="og:image" :content="props.metaImg" />
		<!-- Twitter -->
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@" />
		<meta name="twitter:title" :content="props.metaTitle" />
		<meta name="twitter:description" :content="props.metaDescription" />
		<meta name="twitter:url" :content="props.canonical" />
		<meta name="twitter:image" :content="props.metaImg" />
		<link v-if="props.preLoad" rel="preload" as="image" :href="props.preLoad" type="image/avif" />
    </Head>
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
