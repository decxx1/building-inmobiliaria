<script setup>
//ruta absoluta
const url = window.location.origin;
defineProps({
    compact: {
        type: Boolean,
        default: false
    }
})

</script>
<template>
    <img
        :src="url + '/imagotipo.png'"
        class="h-8"
        alt="Imagotipo ManejoWeb"
    />
    <span
        :class="[compact ? 'opacity-0 pointer-events-none' : 'opacity-100', 'font-Montserrat ms-2 self-center text-xl text-white dark:text-white font-semibold whitespace-nowrap transition-opacity duration-300']"
    >Manejo Web</span>
</template>
