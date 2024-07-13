<script setup>
import { ref,onMounted, onUnmounted } from 'vue';
import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'photoswipe/style.css';

const galleryID = ref('galleryID')
const lightbox = ref(null)

onMounted(() => {
    if (!lightbox.value) {
      lightbox.value = new PhotoSwipeLightbox({
        gallery: '#' + galleryID.value,
        children: 'a',
        mouseMovePan: true,
        showHideAnimationType: 'zoom',
        initialZoomLevel: 'fit',
        secondaryZoomLevel: 1.5,
        maxZoomLevel: 1,

        imageClickAction: 'close',
        tapAction: 'close',
        pswpModule: () => import('photoswipe'),
      });
      lightbox.value.init();
    }
})
onUnmounted(() => {
    if (lightbox.value) {
      lightbox.value.destroy();
      lightbox.value = null;
    }
})
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
        <div :id="galleryID" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 items-center justify-center">
            <a v-for="image in props.images" :href="image.original" :data-pswp-width="image.width" :data-pswp-height="image.height" target="_blank" :key="image.id">
                <img class="w-full h-20 sm:h-32 object-cover rounded hover:scale-105 cursor-pointer transition-all transform hover:-rotate-3" :src="image.thumbnail" alt="">
            </a>
        </div>
    </section>

</template>
