<script setup>

defineProps ({
    onSubmit: {
        type: Function,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        required: true
    },
    drawerId: {
        type: String,
        required: true
    },
    handleDrawerToggle: {
        type: Function,
        required: true
    }
})
</script>
<template>
    <div
        :id="drawerId"
        class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1"
        :aria-labelledby="drawerId + '-label'"
    >
        <h5 :id="drawerId + '-label'" class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
            <i :class="[icon, 'me-3']" ></i>
            {{title}}
        </h5>
        <button type="button" @click="handleDrawerToggle" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
            <i class="icon-[radix-icons--cross-1] w-6 h-6"></i>
            <span class="sr-only">Close menu</span>
        </button>
        <form @submit.prevent="onSubmit" class="mb-6">
            <slot />

            <button type="submit" class="justify-center flex items-center text-md py-2.5 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <i :class="[icon, 'me-3 h-5 w-5']"></i>
                {{title}}
            </button>
        </form>
    </div>
</template>
