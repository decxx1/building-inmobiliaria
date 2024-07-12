<script setup>
import { ref, onMounted } from 'vue';
import { Dropdown } from 'flowbite';
const props = defineProps({
  title:{
    type: String,
    required: true,
  },
  onChange: {
    type: Function,
  },
  extraClass: {
    type: String,
  },
  current: {
    type: String,
    required: true
  }
});


const dropdown = ref(null);


const handleFilterChange =  (filter) => {
    props.onChange(filter);
    dropdown.value.hide();
}
onMounted(() => {
    const $targetEl = document.getElementById('dropdownFilters'+props.title);
    // set the element that trigger the dropdown menu on click
    const $triggerEl = document.getElementById('dropFilters'+props.title);

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
        id: 'dropFilters'+props.title,
        override: true
    };
    dropdown.value = new Dropdown($targetEl, $triggerEl, options, instanceOptions);
})
</script>
<template>
    <div>
        <label class="block mb-2 text-sm font-semibold text-primary-web-700 dark:text-white">{{ title }}</label>
        <button
            :id="'dropFilters'+title"
            class="w-full flex justify-between items-center text-primary-web-700 bg-white border border-primary-web-700 focus:outline-none hover:bg-primary-web-100 focus:ring-4 focus:ring-primary-web-100 font-medium text-sm px-3 py-1.5 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
            type="button"
        >
            <svg class="w-3 h-3 text-primary-900 dark:text-gray-400 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
            </svg>

                {{ props.current === 'all' ? 'Todos' : props.current }}
            <svg class="w-2.5 h-2.5 ms-2.5 text-primary-900 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div :id="'dropdownFilters' + title" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700 overflow-y-auto max-h-96">
            <h6 class="mb-3 text-sm font-bold text-primary-web-700 dark:text-white">
            {{ title }}
            </h6>
            <ul class="py-3 space-y-1 text-sm text-primary-web-700 dark:text-gray-200" :aria-labelledby="'dropFilters'+title">

                <li>
                    <div @click="handleFilterChange('all')" :class="[props.current === 'all' ? 'active' : '', 'cursor-pointer flex items-center py-2 rounded border-primary-200 hover:bg-primary-50 dark:hover:bg-primary-900 [&.active]:bg-primary-100 dark:[&.active]:bg-primary-800']">
                        <label
                            class="cursor-pointer w-full ms-2 text-sm font-medium text-primary-web-700 rounded dark:text-gray-300"
                        >Todos
                        </label>

                    </div>
                </li>
                <li>
                    <div @click="handleFilterChange('USD')" :class="[props.current === 'USD' ? 'active' : '', 'cursor-pointer flex items-center py-2 rounded border-primary-200 hover:bg-primary-50 dark:hover:bg-primary-900 [&.active]:bg-primary-100 dark:[&.active]:bg-primary-800']">
                        <label
                            class="cursor-pointer w-full ms-2 text-sm font-medium text-primary-web-700 rounded dark:text-gray-300"
                        >UDS
                        </label>
                    </div>
                </li>
                <li>
                    <div @click="handleFilterChange('ARS')" :class="[props.current === 'ARS' ? 'active' : '', 'cursor-pointer flex items-center py-2 rounded border-primary-200 hover:bg-primary-50 dark:hover:bg-primary-900 [&.active]:bg-primary-100 dark:[&.active]:bg-primary-800']">
                        <label
                            class="cursor-pointer w-full ms-2 text-sm font-medium text-primary-web-700 rounded dark:text-gray-300"
                        >ARS
                        </label>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</template>
