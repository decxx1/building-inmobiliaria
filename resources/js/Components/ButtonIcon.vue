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
    class="text-white bg-primary hover:bg-primary-hover focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded text-md px-4 py-2 text-center inline-flex items-center me-2 dark:bg-primary-dark dark:hover:bg-blue-800 dark:focus:ring-blue-800"
  >
    <span :class="icon" class="w-5 h-5 me-2"></span>
    {{name}}
  </button>
</template>

<style>
</style>
