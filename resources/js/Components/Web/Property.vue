<script setup>
import { Link } from '@inertiajs/vue3';
import ButtonIcon from '@/Components/ButtonIcon.vue';
const props = defineProps({
    id: {
        type: Number,
        required: true
    },
    active: {
        type: Boolean,
        required: false
    },
    status: {
        type: String,
        required: true
    },
    type: {
        type: String,
        required: true
    },
    isPriceDollar: {
        type: Boolean,
        required: true
    },
    price: {
        type: Number,
        required: false
    },
    priceHidden: {
        type: Boolean,
        required: true
    },
    address: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    superficieCubierta: {
        type: Number,
        required: false
    },
    superficieTotal: {
        type: Number,
        required: true
    },
    banos: {
        type: String,
        required: false
    },
    dormitorios: {
        type: String,
        required: false
    },
    cochera: {
        type: String,
        required: false
    },
    imageCover: {
        type: String,
        required: true
    },
    admin: {
        type: Boolean,
        required: true
    }
})
const numberFormat = (numero)  => {
    const formato = new Intl.NumberFormat('es-AR');
    return formato.format(numero);
}
const sizeLetterClass = (number) => {
    const length = number.toString().length;
    if (length < 9) {
        return 'text-3xl'
    }else if(length < 12){
        return 'text-2xl'
    }else if(length < 15){
        return 'text-xl'
    }else if(length < 18){
        return 'text-lg'
    }else if(length >= 18){
        return 'text-base'
    }
};

const emit = defineEmits(['edit', 'delete']);
const formattedDescription = (value) => {
    return value.slice(0, 100).replace(/\n/g, '<br>');
}

const iconesProperty = () => {

    switch (props.type) {
        case 'Casa':
        case 'Duplex':
        case 'Triplex':
        case 'Condominio':
        case 'Fraccionamiento':
        case 'P.H.':
        case 'Chalet':
            return 'icon-[mdi--house-outline]'
        case 'Departamento':
        case 'Hotel':
        case 'Loft':
        case 'Piso':
        case 'Semipiso':
            return 'icon-[mdi--house-city-outline]'
        case 'Lote':
        case 'Loteo':
        case 'Campo':
        case 'Terreno':
            return 'icon-[gis--map-poi]'
        case 'Bodega':
        case 'Bodega con Viñedo':
        case 'Finca':
        case 'Quinta':
        case 'Viñedo':
            return 'icon-[game-icons--cellar-barrels]'
        case 'Cabaña':
            return 'icon-[game-icons--wood-cabin]'
        case 'Cochera':
        case 'Depósito':
        case 'Galpón':
        case 'Playa de estacionamiento':
            return 'icon-[mdi--garage-open-variant]'
        case 'Negocio':
        case 'Fondo de comercio':
        case 'Local Comercial':
        case 'Estación de Servicio':
            return 'icon-[jam--store]'
        case 'Fábrica':
        case 'Industria':
            return 'icon-[ph--factory]'
        case 'Oficina':
            return 'icon-[streamline--business-profession-home-office]'
        default:
            return 'icon-[mdi--house-outline]'
    }
}


</script>
<template>
    <article class="cursor-pointer w-64 min-[310px]:w-72 sm:w-80 h-max bg-white border border-primary-web-700 shadow hover:shadow-primary-web-700 hover:scale-105 transition-all duration-300 dark:bg-gray-700 dark:border-gray-700">
        <Link :href="route('inmuebles.show', {id: id})">
            <header>
                <figure class="relative">
                    <span class="w-full h-56 block">
                        <img class="w-full h-full object-cover" :src="imageCover ? imageCover : '/images/properties/sin-propiedad.svg'" alt="imagen de la propiedad" />
                        <div v-if="props.admin && !props.active" class="absolute right-0 top-0 h-16 w-16">
                            <div class="absolute rounded-tl-3xl rounded-tr-3xl transform rotate-45 bg-danger-600 text-center text-white font-bold py-1 right-[-19px] top-[35px] w-[140px]">
                                Inactivo
                            </div>
                        </div>
                    </span>
                    <figcaption class="absolute text-lg text-white top-4">
                        <p class="text-white bg-primary-web-700 px-4 font-medium dark:bg-gray-800">{{ status }}</p>
                    </figcaption>
                    <figcaption class="absolute text-white -bottom-2 right-4 bg-primary-web-700 rounded px-2 pt-1 dark:bg-gray-800">
                        <span :class="['w-8 h-8', iconesProperty()]"></span>
                    </figcaption>
                </figure>
            </header>
            <div class="bg-primary-web-700 dark:bg-gray-800 py-2">
                <div v-if="!priceHidden && price">
                    <p :class="['text-white text-right font-extrabold px-3', sizeLetterClass(price)]">{{ isPriceDollar ? 'US$' : 'ARS$' }} {{ numberFormat(price) }}</p>
                </div>
                <div v-else>
                    <p class="text-white text-right font-extrabold px-3 text-2xl">Consultar</p>
                </div>

            </div>
            <div class="p-2 text-left">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-primary-web-700 dark:text-white">{{ address }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-300 inline" v-html="formattedDescription(description)"></p>
                <span v-if="description.length > 100"> (...)</span>
            </div>
            <footer class="bg-primary-web-700 dark:bg-gray-800 py-2">
                <div class="px-2 flex flex-wrap flex-row justify-start text-white">
                    <div v-if="superficieTotal" class="flex flex-row items-center mr-3">
                        <img class="w-6 mr-1" src="/images/icons-property/superficie.svg" alt="superficie total de la propiedad" />
                        <span>{{ superficieTotal }} m2</span>
                    </div>
                    <div v-if="superficieCubierta" class="flex flex-row items-center mr-3">
                        <img class="w-5 mr-1" src="/images/icons-property/superficie_cubierta.svg" alt="superficie cubierta de la propiedad" />
                        <span>{{ superficieCubierta }} m2</span>
                    </div>
                    <div v-if="banos && banos !== 'Indistinto'" class="flex flex-row items-center mr-3">
                        <img class="w-5 mr-1" src="/images/icons-property/bano2.svg" alt="baños que tiene la propiedad" />
                        <span>{{ banos }}</span>
                    </div>
                    <div v-if="dormitorios && dormitorios !== 'Indistinto'" class="flex flex-row items-center mr-3">
                        <img class="w-6 mr-1" src="/images/icons-property/dormitorio2.svg" alt="habitaciones que tiene la propiedad" />
                        <span>{{ dormitorios }}</span>
                    </div>
                    <div v-if="cochera && cochera !== 'Indistinto'" class="flex flex-row items-center mr-3">
                        <img class="w-6 mr-1" src="/images/icons-property/cochera.svg" alt="tiene cochera el inmueble" />
                        <span>{{ cochera === 'Sin cochera' ? 'No' : 'Si' }}</span>
                    </div>
                </div>
            </footer>
        </Link>
            <div v-if="admin">
                <div class="flex flex-row justify-between py-1">
                    <ButtonIcon
                        name="Editar"
                        size="sm"
                        color="primary"
                        icon="icon-[bx--edit]"
                        @click="emit('edit')"
                    />
                    <ButtonIcon
                        name="Eliminar"
                        size="sm"
                        color="danger"
                        icon="icon-[bx--trash]"
                        @click="emit('delete')"
                    />
                </div>
            </div>
    </article>
</template>

