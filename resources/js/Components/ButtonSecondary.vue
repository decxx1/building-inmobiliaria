<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-white dark:bg-background-dark border border-gray-300 dark:border-gray-800 rounded font-semibold text-md text-gray-700 dark:text-white tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-background-semidark focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
