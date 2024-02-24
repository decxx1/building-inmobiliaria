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
    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-800"
  >
    <span :class="icon" class="w-5 h-5 me-2"></span>
    {{name}}
  </button>
</template>

<style>
</style>
