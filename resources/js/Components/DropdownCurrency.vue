<script setup>
import { onMounted,ref } from 'vue';
import { Dropdown } from 'flowbite';

const dropdown = ref(null);
const props = defineProps({
    currency: {
        type: Boolean,
        required: false
    }
})
onMounted(() => {
    // set the dropdown menu element
    const $targetDdCurrency = document.getElementById('dropdown-currency-menu');

    // set the element that trigger the dropdown menu on click
    const $triggerDdCurrency = document.getElementById('dropdown-currency-button');

    // options with default values
    const options = {
        placement: 'bottom',
        triggerType: 'click',
        offsetSkidding: 0,
        offsetDistance: 10,
        delay: 300,
        ignoreClickOutsideClass: false,

    };

    // instance options object
    const instanceOptions = {
        id: 'dropdown-currency-menu',
        override: true
    };
    dropdown.value = new Dropdown($targetDdCurrency, $triggerDdCurrency, options, instanceOptions);
})
const emit = defineEmits(['select']);


const handleClickItem = (value) => {
    emit('select', value);
    dropdown.value.hide()
}
</script>
<template>
    <button id="dropdown-currency-button" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-1 sm:px-4 text-xs sm:text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">

        <span v-show="props.currency" class="icon-[openmoji--flag-united-states] w-4 h-4 sm:w-5 sm:h-5 mr-2"></span>
        <span v-show="!props.currency" class="icon-[openmoji--flag-argentina] w-4 h-4 sm:w-5 sm:h-5 mr-2"></span>
        {{ props.currency ? 'USD' : 'ARS' }}
        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
    </button>
    <div id="dropdown-currency-menu" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-36 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-currency-button">
            <li>
                <button @click="handleClickItem(true)" type="button" class="inline-flex w-full px-4 py-2 text-xs sm:text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                    <div class="inline-flex items-center">
                        <span class="icon-[openmoji--flag-united-states] w-4 h-4 sm:w-5 sm:h-5 mr-2"></span>
                        USD
                    </div>
                </button>
            </li>
            <li >
                <button  @click="handleClickItem(false)" type="button" class="inline-flex w-full px-4 py-2 text-xs sm:text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                    <div class="inline-flex items-center">
                        <span class="icon-[openmoji--flag-argentina] w-4 h-4 sm:w-5 sm:h-5 mr-2"></span>
                        ARS
                    </div>
                </button>
            </li>
        </ul>
    </div>
</template>

<style>

</style>
