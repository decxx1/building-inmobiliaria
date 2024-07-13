<script setup>
import Layout from '@/Layouts/Layout.vue';
import HeaderWeb from '@/Components/Web/HeaderWeb.vue';
import BreadCrums from '@/Components/Web/BreadCrumbsWeb.vue';
import Gallery from '@/Components/Web/Gallery.vue';
import PropertyInfo from '@/Components/Web/PropertyInfo.vue';
import PropertyContact from '@/Components/Web/PropertyContact.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import {
    baseUrl,
} from '@/Services/env.js';
const props = defineProps({
    property: {
        type: Object,
        required: true
    }
})

// Función para validar imágenes
const isValidImageObject = (imageObject) => {
  return imageObject && imageObject.id && imageObject.thumbnail && imageObject.original && imageObject.position
}
// Filtrar y guardar las imágenes válidas
const images = [
    props.property.currentImageCover,
    props.property.currentImageExtra2,
    props.property.currentImageExtra3,
    props.property.currentImageExtra4,
    props.property.currentImageExtra5,
    props.property.currentImageExtra6
].filter(isValidImageObject)

</script>
<template>
    <Layout
        title="Inmueble"
        :canonical="baseUrl + 'inmueble/' + props.property.id"
        :metaTitle="props.property.status + props.property.type + props.property.address"
        :metaDescription="props.property.description.slice(0, 155)"
        :metaImg="props.property.currentImageCover.thumbnail"
        :preLoad="props.property.currentImageCover.original"
    >
        <HeaderWeb :heroPage="false" />
        <BreadCrums
            :page="props.property.status + ' - ' + props.property.type"
            :path="props.property.id.toString()"
        />
        <Gallery
            :images="images"
        />
        <section class="container px-6 py-4 mx-auto grid grid-cols-12">
            <div class="col-span-12 md:col-span-6 lg:col-span-8">
                <PropertyInfo
                    :property="props.property"
                />
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-4">
                <PropertyContact
                    :property="props.property"
                />
            </div>
        </section>
    </Layout>
</template>
