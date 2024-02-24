<script setup>
defineProps({
    heightClass:{
        type: String,
    }
})
</script>

<template>
    <img src="imagotipo.png" :class="heightClass" class="me-3" alt="Imagotipo ManejoWeb" />
</template>
