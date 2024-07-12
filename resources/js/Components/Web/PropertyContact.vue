<script setup>
import { useForm } from '@inertiajs/vue3';
import { toast } from 'vue-sonner'
import { useReCaptcha } from 'vue-recaptcha-v3'
const props = defineProps({
    property: {
        type: Object,
        required: true
    },
    recaptcha_site_key: {
        type: String,
    }
})
const { executeRecaptcha, recaptchaLoaded } = useReCaptcha();
const form = useForm({
    url: '',
    name: '',
    phone: '',
    message: '',
    captcha_token: '',
});
const recaptcha = async () => {
    // (optional) Wait until recaptcha has been loaded.
    await recaptchaLoaded()

    // Execute reCAPTCHA with action.
    form.captcha_token = await executeRecaptcha('consult')
    //agregar la ruta actual
    form.url = window.location.href;
    handleSubmit();
    // Do stuff with the received token.
};
function handleSubmit(){
    form.post(route('consult.property'), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            toast.success('¡Gracias por contactar con nosotros! Te responderemos lo antes posible.');
            form.reset()
        },
        onError: (error) => {
            //console.error(error)
            const formErrors = form.errors;

            for (let field in formErrors) {
                if (formErrors.hasOwnProperty(field)) {
                    toast.warning(formErrors[field]);
                    break; // Detener el bucle después de mostrar el primer mensaje de error
                }
            }

            if (error.message) {
                toast.warning(error.message);
            }
        },
    })
}

import {
    telphoneReadble,
    telphoneLinkeable,
    whatsappReadble,
    whatsappLinkeable,
    baseUrl,
} from '@/Services/env.js';

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

</script>

<template>
    <section class="bg-white border border-primary-web-700 dark:bg-gray-800 dark:border-gray-600 md:ml-8 max-md:mt-6">
        <section class="text-primary-web-700 text-left px-4 dark:text-white">
            <div v-if="!props.property.price_hidden && props.property.price_property">
                <p :class="['text-primary-web-700 font-extrabold px-2 mt-4 dark:text-white', sizeLetterClass(props.property.price_property)]">{{ props.property.is_price_dollar ? 'US$' : 'ARS$' }} {{ numberFormat(props.property.price_property) }}</p>
            </div>
            <div v-else>
                <p class="text-primary-web-700 font-extrabold px-2 text-2xl mt-4 dark:text-white">Consultar</p>
            </div>
            <p class="text-primary-web-700 font-bold text-xl px-2 mt-2 uppercase dark:text-gray-300">{{ props.property.status }}</p>
        </section>
        <section class="bg-primary-web-700 text-white mt-6 px-4 py-4 dark:bg-gray-900">
            <div class="grid grid-cols-2">
                <div v-if="props.property.superficie_total" class="flex flex-row items-center mr-3">
                    <img class="w-10 mr-2" :src="baseUrl + 'images/icons-property/superficie.svg'" alt="superficie total de la propiedad" />
                    <span>{{ props.property.superficie_total }} m2</span>
                </div>
                <div v-if="props.property.superficie_cubierta" class="flex flex-row items-center mr-3">
                    <img class="w-10 mr-2" :src="baseUrl + 'images/icons-property/superficie_cubierta.svg'" alt="superficie cubierta de la propiedad" />
                    <span>{{ props.property.superficie_cubierta }} m2</span>
                </div>
                <div v-if="props.property.banos && props.property.banos !== 'Indistinto'" class="flex flex-row items-center mr-3">
                    <img class="w-10 mr-2" :src="baseUrl + 'images/icons-property/bano2.svg'" alt="baños que tiene la propiedad" />
                    <span>{{ props.property.banos }}</span>
                </div>
                <div v-if="props.property.dormitorios && props.property.dormitorios !== 'Indistinto'" class="flex flex-row items-center mr-3">
                    <img class="w-10 mr-2" :src="baseUrl + 'images/icons-property/dormitorio2.svg'" alt="habitaciones que tiene la propiedad" />
                    <span>{{ props.property.dormitorios }}</span>
                </div>
                <div v-if="props.property.cochera && props.property.cochera !== 'Indistinto'" class="flex flex-row items-center mr-3">
                    <img class="w-10 mr-2" :src="baseUrl + 'images/icons-property/cochera.svg'" alt="tiene cochera el inmueble" />
                    <span>{{ props.property.cochera === 'Sin cochera' ? 'No' : 'Si' }}</span>
                </div>
            </div>
        </section>
        <section class="px-2 xl:px-4 pt-8 pb-4">
            <div class="grid grid-cols-2 xl:mx-4 gap-4">
                <a
                    :href="'https://wa.me/54' + whatsappLinkeable"
                    class="text-white bg-[#26ca43] p-2 text-md xl:text-lg inline-flex items-center justify-center"
                >
                    <i class="icon-[mdi--whatsapp] mr-2 w-5 h-5 lg:w-6 lg:h-6"></i>WhatsApp</a>
                <a
                    :href="'tel:' + telphoneLinkeable"
                    class="text-white bg-primary-web-700 p-2 text-md xl:text-lg inline-flex items-center justify-center dark:bg-gray-900"
                ><i class="icon-[mdi--phone] mr-2 w-5 h-5 lg:w-6 lg:h-6"></i>Teléfono</a>
            </div>
        </section>
        <section class="text-center mx-auto px-4 pb-6">
            <h4 class="font-normal text-2xl uppercase text-primary-web-700 dark:text-white">Consultar</h4>
            <form @submit.prevent="recaptcha" class="mt-3">
                <input
                    type="text"
                    v-model="form.name"
                    class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500 dark:shadow-sm-light"
                    placeholder="Su Nombre" required
                />
                <input
                    type="text"
                    v-model="form.phone"
                    class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500 dark:shadow-sm-light"
                    placeholder="Su Teléfono" required
                />
                <textarea
                    rows="3"
                    v-model="form.message"
                    class="mb-3 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-primary-web-500 focus:border-primary-web-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500"
                    placeholder="Consulte por este inmueble..."
                    required
                ></textarea>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full font-medium text-sm py-2 text-white bg-primary-web-700 hover:bg-primary-web-600 focus:ring-4 focus:ring-primary-web-300 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                >Enviar</button>
            </form>
        </section>

    </section>
</template>
