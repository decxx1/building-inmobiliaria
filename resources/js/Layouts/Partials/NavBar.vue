<script setup>
import ColorModeSwitcher from '@/Layouts/Partials/ColorModeSwitcher.vue';
import Notifications from '@/Layouts/Partials/Notifications.vue';
import UserMenu from '@/Layouts/Partials/UserMenu.vue';
import Routes from '@/Layouts/Partials/Routes.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { store } from '@/Services/store.js';

const toggleSidebar = () =>{
    store.sidebarCompact = !store.sidebarCompact;
}
const handleMouseOver = () => {
    if(window.innerWidth > 640 && store.sidebarCompact){
        store.sidebarCompact = false;
        store.mouseOver = true;
    }
}
const handleMouseOut = () => {
    if(window.innerWidth > 640 && store.mouseOver){
        store.sidebarCompact = true;
        store.mouseOver = false;
    }
}
</script>

<template>
    <nav class="fixed top-0 z-40 w-full bg-white border-b border-gray-200 dark:bg-surface-dark dark:border-background-dark">
        <div :class="[store.sidebarCompact ? 'sm:ml-20' : 'sm:ml-64','px-3 py-1 lg:px-5 lg:pl-3 transition-all ease-in duration-300']">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <!-- Botón de mostrar sidebar en dispositivos móviles -->
                    <button
                        data-drawer-target="logo-sidebar"
                        data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar"
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-400 rounded-lg sm:hidden hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-white dark:hover:bg-background-dark dark:focus:ring-background-dark"
                    >
                        <span class="w-7 h-7 icon-[heroicons--bars-3-bottom-left-solid]"></span>
                    </button>
                    <!-- Botón de compactar sidebar -->
                    <button
                        @click="toggleSidebar"
                        type="button"
                        class="hidden p-2 text-sm text-gray-400 rounded-lg sm:block hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-200 dark:hover:text-white dark:hover:bg-background-dark dark:focus:ring-background-dark"
                    >
                        <span class="w-7 h-7 icon-[heroicons--bars-3-bottom-left-solid]"></span>
                    </button>
                </div>
                <div class="flex items-center">
                    <!-- <Notifications /> -->
                    <ColorModeSwitcher />
                    <UserMenu />
                </div>
            </div>
        </div>
    </nav>

    <aside @mouseover="handleMouseOver" @mouseout="handleMouseOut" id="logo-sidebar" :class="[store.sidebarCompact ? 'w-20' : 'w-64', 'fixed top-0 left-0 z-50 h-screen elevation transition-all ease-in duration-300 border-r border-gray-200 sm:translate-x-0 -translate-x-full dark:border-background-dark']" aria-label="Sidebar">
        <div class="bg-primary-600 dark:bg-primary-800 px-3 py-3 lg:px-5 lg:pl-3">
            <a class="flex ps-3">
                <ApplicationLogo
                    :compact="store.sidebarCompact"
                />
            </a>
        </div>
        <div class="h-full px-2 pt-2 overflow-y-auto bg-[#343a40] dark:bg-background-dark">
            <Routes
                :compact="store.sidebarCompact"
            />
        </div>
    </aside>
</template>
