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
        <section class="text-left p-6 border border-primary-web-700 bg-white dark:bg-gray-800 dark:border-gray-600">
            <h2 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-primary-web-700 md:text-3xl dark:text-white">
                {{ props.property.address }}
            </h2>
            <p class="text-md font-normal text-primary-web-700 lg:text-xl dark:text-gray-400">
                {{ props.property.neighborhood }}
            </p>
        </section>
        <section class="mt-6 text-left p-6 border border-primary-web-700 bg-white dark:bg-gray-800 dark:border-gray-600">
            <p class="text-primary-web-700 font-medium text-lg dark:text-white" v-html="props.property.description">
            </p>
        </section>
        <section class="mt-6 text-left p-6 border border-primary-web-700 bg-white dark:bg-gray-800 dark:border-gray-600">
            <h3 class="text-2xl font-semibold mb-6 text-primary-web-700 dark:text-white">Características</h3>
            <div class="grid sm:grid-cols-2 text-primary-web-700 dark:text-white">
                <ul>
                    <li v-if="props.property.superficie_total" class="mb-2"><strong>Superficie total:</strong> {{ props.property.superficie_total }}</li>
                    <li v-if="props.property.superficie_cubierta" class="mb-2"><strong>Superficie cubierta:</strong> {{ props.property.superficie_cubierta }}</li>
                    <li v-if="props.property.ambientes && props.property.ambientes !== 'Indistinto'" class="mb-2"><strong>Ambientes:</strong> {{ props.property.ambientes }}</li>
                    <li v-if="props.property.plantas && props.property.plantas !== 'Indistinto'" class="mb-2"><strong>Plantas:</strong> {{ props.property.plantas }}</li>
                    <li v-if="props.property.dormitorios && props.property.dormitorios !== 'Indistinto'" class="mb-2"><strong>Dormitorios:</strong> {{ props.property.dormitorios }}</li>
                    <li v-if="props.property.banos && props.property.banos !== 'Indistinto'" class="mb-2"><strong>Baños:</strong> {{ props.property.banos }}</li>
                    <li v-if="props.property.cochera && props.property.cochera !== 'Indistinto'" class="mb-2"><strong>Cochera:</strong> {{ props.property.cochera }}</li>
                    <li v-if="props.property.expensas && props.property.expensas !== 'Indistinto'" class="mb-2"><strong>Expensas:</strong> {{ props.property.expensas }}</li>
                    <li v-if="props.property.antiquity && props.property.antiquity !== 'Indistinto'" class="mb-2"><strong>Antigüedad:</strong> {{ props.property.antiquity }}</li>
                    <li v-if="props.property.conservacion && props.property.conservacion !== 'Indistinto'" class="mb-2"><strong>Conservación:</strong> {{ props.property.conservacion }}</li>
                    <li v-if="props.property.financiacion && props.property.financiacion !== 'Indistinto'" class="mb-2"><strong>Financiación:</strong> {{ props.property.financiacion }}</li>
                    <li v-if="props.property.hipoteca && props.property.hipoteca !== 'Indistinto'" class="mb-2"><strong>Hipoteca:</strong> {{ props.property.hipoteca }}</li>
                    <li v-if="props.property.permuta && props.property.permuta !== 'Indistinto'" class="mb-2"><strong>Permuta:</strong> {{ props.property.permuta }}</li>
                    <li v-if="props.property.barrio_privado && props.property.barrio_privado !== 'Indistinto'" class="mb-2"><strong>Barrio privado:</strong> {{ props.property.barrio_privado }}</li>
                </ul>
                <ul>
                    <li v-if="props.property.amoblado && props.property.amoblado !== 'Indistinto'" class="mb-2"><strong>Amoblado:</strong> {{ props.property.amoblado }}</li>
                    <li v-if="props.property.internet && props.property.internet !== 'Indistinto'" class="mb-2"><strong>Internet:</strong> {{ props.property.internet }}</li>
                    <li v-if="props.property.piscina && props.property.piscina !== 'Indistinto'" class="mb-2"><strong>Piscina:</strong> {{ props.property.piscina }}</li>
                    <li v-if="props.property.cable && props.property.cable !== 'Indistinto'" class="mb-2"><strong>Cable:</strong> {{ props.property.cable }}</li>
                    <li v-if="props.property.telefono && props.property.telefono !== 'Indistinto'" class="mb-2"><strong>Teléfono:</strong> {{ props.property.telefono }}</li>
                    <li v-if="props.property.aire_acondicionado && props.property.aire_acondicionado !== 'Indistinto'" class="mb-2"><strong>Aire Acondicionado:</strong> {{ props.property.aire_acondicionado }}</li>
                    <li v-if="props.property.calefaccion_central && props.property.calefaccion_central !== 'Indistinto'" class="mb-2"><strong>Calefacción Central:</strong> {{ props.property.calefaccion_central }}</li>
                    <li v-if="props.property.mascotas && props.property.mascotas !== 'Indistinto'" class="mb-2"><strong>Mascotas:</strong> {{ props.property.mascotas }}</li>
                    <li v-if="props.property.zona_escolar && props.property.zona_escolar !== 'Indistinto'" class="mb-2"><strong>Zona Escolar:</strong> {{ props.property.zona_escolar }}</li>
                    <li v-if="props.property.agua && props.property.agua !== 'Indistinto'" class="mb-2"><strong>Agua:</strong> {{ props.property.agua }}</li>
                    <li v-if="props.property.gas && props.property.gas !== 'Indistinto'" class="mb-2"><strong>Gas:</strong> {{ props.property.gas }}</li>
                    <li v-if="props.property.luz && props.property.luz !== 'Indistinto'" class="mb-2"><strong>Luz:</strong> {{ props.property.luz }}</li>
                    <li v-if="props.property.cloacas && props.property.cloacas !== 'Indistinto'" class="mb-2"><strong>Cloacas:</strong> {{ props.property.cloacas }}</li>
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
