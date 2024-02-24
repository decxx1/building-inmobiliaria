<script setup>
const props = defineProps({
    name: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        required: true,
    },
    active:{
        type: String,
    },
    compact: {
        type: Boolean,
        default: false
    }
})

</script>
<template>
    <span :class="[icon,  active]" class="w-6 h-6 text-gray-300 transition duration-75 dark:text-gray-400 group-hover:text-white [&.active]:text-white [&.active]:dark:text-white"></span>
    <span :class="[compact ? 'hidden' : '', 'flex-1 ms-2 whitespace-nowrap']" >{{name}}</span>
</template>

<style>
</style>
