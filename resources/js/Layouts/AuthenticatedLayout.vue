<script setup>
import NavBar from '@/Layouts/Partials/NavBar.vue';
import Footer from '@/Layouts/Partials/Footer.vue';
import { onMounted } from 'vue'
import {
    initDrawers,
    initDropdowns,
    initModals,
    initPopovers,
    initTooltips } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initDrawers();
    initDropdowns();
    initModals();
    initPopovers();
    initTooltips();
})

</script>

<template>
    <div>

        <NavBar />

        <div class="p-4 sm:ml-64 ">
            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
                <div class="max-w-screen-2xl mx-auto pb-6 pt-16 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
            <!-- Page Content -->
            <div class="py-12">
                <slot />
            </div>
            <Footer />
        </div>

    </div>
</template>
<style>
.elevation {
   box-shadow: 0 14px 28px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.22);
}
.elevation-2 {
  box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23) !important;
}
</style>

