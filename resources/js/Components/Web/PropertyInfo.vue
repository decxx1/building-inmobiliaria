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
        <section class="mt-6">
            <div class="grid grid-cols-2">
                <ul>
                    <li>Superficie total: {{ props.property.superficie_total }}</li>
                    <li>Superficie cubierta: {{ props.property.superficie_cubierta }}</li>
                    <li>Ambientes: {{ props.property.ambientes }}</li>
                    <li>Plantas: {{ props.property.plantas }}</li>
                    <li>Dormitorios: {{ props.property.dormitorios }}</li>
                    <li>Baños: {{ props.property.banos }}</li>
                    <li>Cochera: {{ props.property.cochera }}</li>
                    <li>Expensas: {{ props.property.expensas }}</li>
                    <li>Antigüedad: {{ props.property.antiquity }}</li>
                    <li>Conservación: {{ props.property.conservacion }}</li>
                    <li>Financiación: {{ props.property.financiacion }}</li>
                    <li>Hipoteca: {{ props.property.hipoteca }}</li>
                    <li>Permuta: {{ props.property.permuta }}</li>
                    <li>Barrio privado: {{ props.property.barrio_privado }}</li>
                </ul>
                <ul>
                    <li>Amoblado: {{ props.property.amoblado }}</li>
                    <li>Internet: {{ props.property.internet }}</li>
                    <li>Piscina: {{ props.property.piscina }}</li>
                    <li>Cable: {{ props.property.cable }}</li>
                    <li>Teléfono: {{ props.property.telefono }}</li>
                    <li>Aire Acondicionado: {{ props.property.aire_acondicionado }}</li>
                    <li>Calefacción Central: {{ props.property.calefaccion_central }}</li>
                    <li>Mascotas: {{ props.property.mascotas }}</li>
                    <li>Zona Escolar: {{ props.property.zona_escolar }}</li>
                    <li>Agua: {{ props.property.agua }}</li>
                    <li>Gas: {{ props.property.gas }}</li>
                    <li>Luz: {{ props.property.luz }}</li>
                    <li>Cloacas: {{ props.property.cloacas }}</li>
                </ul>
            </div>
        </section>
        <section class="mt-6">
            <LeafletMap
                :latLng="{'lat':props.property.lat, 'lng':props.property.lng}"
            />
        </section>


    </section>
</template>
