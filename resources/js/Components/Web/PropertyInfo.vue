<script setup>
import LeafletMap from '@/Components/Web/LeafletMapWeb.vue';
const props = defineProps({
    property: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <section>
        <section class="text-left p-6 border border-primary-web-700 bg-white dark:bg-gray-800">
            <h2 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-primary-web-700 md:text-3xl dark:text-white">
                {{ props.property.address }}
            </h2>
            <p class="text-md font-normal text-primary-web-700 lg:text-xl dark:text-gray-400">
                {{ props.property.neighborhood }}
            </p>
        </section>
        <section class="mt-6 text-left p-6 border border-primary-web-700 bg-white dark:bg-gray-800">
            <p class="text-primary-web-700 font-medium text-lg" v-html="props.property.description">
            </p>
        </section>
        <section class=" mt-6 ">
            <LeafletMap
                :latLng="{'lat':props.property.lat, 'lng':props.property.lng}"
            />
        </section>
    </section>
</template>
