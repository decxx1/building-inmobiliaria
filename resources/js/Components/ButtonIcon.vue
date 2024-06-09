<script setup>
const props = defineProps({
    name: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        required: true,
    }
})

</script>
<template>
  <button
    type="button"
    class="text-white bg-primary-600 hover:bg-primary-500 focus:ring-4 focus:outline-none focus:ring-primary-400 font-semibold rounded text-md px-4 py-2 text-center inline-flex items-center me-2 dark:bg-primary-800 dark:hover:bg-primary-700 dark:focus:ring-primary-700"
  >
    <span :class="icon" class="w-5 h-5 me-2"></span>
    {{name}}
  </button>
</template>

<style>
</style>
