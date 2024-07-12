<script setup>
import ColorModeSwitcher from '@/Components/Web/ColorModeSwitcherWeb.vue';
import Menu from '@/Components/Web/MenuWeb.vue';
import { onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    heroPage: {
        type: Boolean,
        required: true
    }
})
import {
    baseUrl,
} from '@/Services/env.js';
onMounted(() => {
    //sticky header
    const header = document.querySelector(".header");
      const headerContainer = document.querySelector(".header-container");
      const mediaQuery = window.matchMedia("(min-width: 640px)");
      const handleScroll = () => {
        if (window.scrollY > 60 && window) {
            header.classList.add("sticky");
            header.classList.remove("sm:absolute");
            header.classList.add("shadow-md");
            header.classList.remove("sm:top-12");
            header.classList.add("top-0");
            header.classList.remove("sm:max-w-screen-sm");
            header.classList.remove("md:max-w-screen-md");
            header.classList.remove("lg:max-w-screen-lg");
            header.classList.remove("sm:left-1/2");
            header.classList.remove("sm:transform");
            header.classList.remove("sm:-translate-x-1/2");
            headerContainer.classList.add("sticky-reserved");
        } else {
            header.classList.add("sm:absolute");
            header.classList.remove("sticky");
            header.classList.remove("shadow-md");
            header.classList.add("sm:top-12");
            header.classList.remove("sm:top-0");
            header.classList.add("sm:max-w-screen-sm");
            header.classList.add("md:max-w-screen-md");
            header.classList.add("lg:max-w-screen-lg");
            header.classList.add("sm:left-1/2");
            header.classList.add("sm:transform");
            header.classList.add("sm:-translate-x-1/2");
            headerContainer.classList.remove("sticky-reserved");
        }
      };
       // Check if the screen width is greater than 640px
    if (mediaQuery.matches && props.heroPage) {
        window.addEventListener("scroll", handleScroll);
    }

    // Add or remove event listener based on screen size changes
    mediaQuery.addEventListener("change", (e) => {
        if (e.matches) {
            window.addEventListener("scroll", handleScroll);
        } else {
            window.removeEventListener("scroll", handleScroll);
        }
    });

});


</script>
<template>

    <div class="header-container"></div>
    <header :class="[props.heroPage ? 'sm:absolute sm:top-12 sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg sm:left-1/2 sm:transform sm:-translate-x-1/2' : '', 'header sticky top-0 z-50 w-full transition-[margin] duration-300']">
        <nav class="bg-primary-web-700 px-4 lg:px-6 dark:bg-gray-900 border-primary-web-700 dark:border-gray-800 border-y">
            <div class="flex flex-wrap justify-between items-center mx-auto sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg">
                <Link :href="route('index')" class="flex items-center py-2">
                    <img loading="lazy" :src="baseUrl +'images/logos/building-inmobiliaria-ancho.webp'" class="mr-4 h-12" alt="Building Inmobiliaria Logo" />
                </Link>
                <div class="flex items-center lg:order-2">
                    <ColorModeSwitcher />
                    <button data-collapse-toggle="mobile-menu-2" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-white rounded-lg lg:hidden hover:bg-white hover:text-primary-web-700 focus:outline-none focus:ring-2 focus:ring-primary-web-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:block lg:w-auto " id="mobile-menu-2">
                <Menu />
            </div>

        </div>
    </nav>
</header>
</template>

  <style scoped>
    .sticky-reserved {
        margin-top: -64px;
    }
  </style>
