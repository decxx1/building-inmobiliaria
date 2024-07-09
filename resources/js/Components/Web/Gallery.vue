<script setup>
import { ref } from 'vue';
const props = defineProps({
    images: {
        type: Object,
        required: true
    }
})

const imageOriginal = ref(props.images[0].original)
const handleImageOriginal = (image) => {
    imageOriginal.value = image
}
</script>

<template>

    <section class="container px-6 py-12 mx-auto">
        <div class="grid sm:grid-cols-12 gap-4 items-center">
            <div class="col-span-12 md:col-span-8 mx-auto">
                <img class="w-full sm:h-96 sm:w-auto max-w-full rounded" :src="imageOriginal" alt="">
            </div>
            <div class="col-span-12 md:col-span-4 grid grid-cols-3 md:grid-cols-2 lg:grid-cols-2 gap-4">
                <div v-for="image in props.images" :key="image.id">
                    <img @click="handleImageOriginal(image.original)" class="w-full sm:h-32 sm:max-w-full rounded hover:scale-105 cursor-pointer" :src="image.thumbnail" alt="">
                </div>
            </div>
        </div>
    </section>

</template>
