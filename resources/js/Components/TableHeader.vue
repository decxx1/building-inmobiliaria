<script setup>
import { ref } from 'vue';

const hiddenFilters = ref(true);

const toggleFilters = () => {
    hiddenFilters.value = !hiddenFilters.value;
}
</script>
<template>
    <div v-if="$slots.topHeader" class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <slot name="topHeader" />
    </div>
    <div class="flex flex-col space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="flex flex-row justify-between mb-4">
            <div class="w-full md:w-1/2">
                <slot name="searchBar" />
            </div>
            <button type="button" @click="toggleFilters()" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                <svg class="w-4 h-4 text-black dark:text-gray-400 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                </svg>
                Filtros
            </button>

        </div>
        <div class="w-full border-t border-b md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center md:space-x-3 flex-shrink-0">

            <div :class="['flex flex-wrap w-full', hiddenFilters ? 'hidden' : '']">
                <slot name="filters" />
            </div>
        </div>
    </div>
</template>
