<script setup>
import Layout from '@/Layouts/Layout.vue';
import HeaderWeb from '@/Components/Web/HeaderWeb.vue';
import { useForm } from '@inertiajs/vue3';
import { toast } from 'vue-sonner'
import { useReCaptcha } from 'vue-recaptcha-v3'

const props = defineProps({
    recaptcha_site_key: {
        type: String,
    }
})

import {
    telphoneReadble,
    telphoneLinkeable,
    address,
    mapUrl,
    schedules,
    baseUrl,
    email,
    mapIframe,
} from '@/Services/env.js';

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha();
const form = useForm({
    name: '',
    email: '',
    phone: '',
    message: '',
    captcha_token: '',
});
const recaptcha = async () => {
    // (optional) Wait until recaptcha has been loaded.
    await recaptchaLoaded()

    // Execute reCAPTCHA with action.
    form.captcha_token = await executeRecaptcha('contact')

    handleSubmit();
    // Do stuff with the received token.
};
function handleSubmit(){
    form.post(route('consult.contact'), {
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
</script>

<template>
<Layout>
    <HeaderWeb :heroPage="false" />
    <section class="bg-white dark:bg-gray-900">
        <div class="bg-[url('/images/breadcrumbs.avif')] bg-no-repeat bg-cover bg-center bg-gray-600 bg-blend-multiply">
            <div class="px-4 lg:pt-24 pt-8 pb-72 lg:pb-80 mx-auto max-w-screen-sm text-center lg:px-6 ">
                <h1 class="mb-4 text-4xl tracking-tight font-extrabold text-white">Contacto</h1>
                <p class="mb-16 font-light text-gray-400 sm:text-xl">Consúltenos por tasaciones, alquileres o ventas de inmuebles</p>
            </div>
        </div>
        <div class="py-16 px-4 mx-auto -mt-96 max-w-screen-xl sm:py-24 lg:px-6 ">
            <form @submit.prevent="recaptcha" class="grid grid-cols-1 gap-8 p-6 mx-auto mb-16 max-w-screen-md bg-white border border-gray-200 shadow-sm lg:mb-28 dark:bg-gray-800 dark:border-gray-700 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre completo</label>
                    <input type="text" name="name" v-model="form.name" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 shadow-sm focus:ring-primary-web-500 focus:border-primary-web-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500 dark:shadow-sm-light" placeholder="Su nombre " required>
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">E-mail</label>
                    <input type="email" name="email" v-model="form.email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-web-500 focus:border-primary-web-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500 dark:shadow-sm-light" placeholder="Su correo" required>
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Teléfono</label>
                    <input type="text" name="phone" v-model="form.phone" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 shadow-sm focus:ring-primary-web-500 focus:border-primary-web-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500 dark:shadow-sm-light" placeholder="Su teléfono" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Mensaje</label>
                    <textarea mae="message" rows="6" v-model="form.message" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 shadow-sm border border-gray-300 focus:ring-primary-web-500 focus:border-primary-web-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-web-500 dark:focus:border-primary-web-500" placeholder="Detalle sobre su consulta..."></textarea>
                </div>
                <button type="submit" :disabled="form.processing" class="py-3 px-5 text-sm font-medium text-center text-white bg-primary-web-700 sm:w-fit hover:bg-primary-web-600 focus:ring-4 focus:outline-none focus:ring-primary-web-300 dark:bg-primary-web-600 dark:hover:bg-primary-web-700 dark:focus:ring-primary-web-800">Enviar</button>
            </form>
            <div class="space-y-8 text-center md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div>
                    <div class="flex justify-center items-center mx-auto mb-4 w-10 h-10 bg-gray-100 dark:bg-gray-800 lg:h-16 lg:w-16">
                        <svg class="w-5 h-5 text-primary-web-600 lg:w-8 lg:h-8 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                    </div>
                    <p class="mb-2 text-xl font-bold dark:text-white">E-mail</p>
                    <a :href="'mailto:' + email" class="inline-flex py-2 px-4 text-sm font-medium rounded text-center border text-primary-web-600 border-primary-web-600 hover:text-white hover:bg-primary-web-600 focus:ring-4 focus:outline-none focus:ring-primary-web-300 dark:border-primary-web-500 dark:text-primary-web-500 dark:hover:text-white dark:hover:bg-primary-web-600 dark:focus:ring-primary-web-800">{{ email }} </a>
                </div>
                <div>
                    <div class="flex justify-center items-center mx-auto mb-4 w-10 h-10 bg-gray-100 dark:bg-gray-800 lg:h-16 lg:w-16">
                        <svg class="w-5 h-5 text-primary-web-600 lg:w-8 lg:h-8 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                    </div>
                    <p class="mb-2 text-xl font-bold dark:text-white">Llámanos:</p>
                    <a :href="'tel:' + telphoneLinkeable" class="inline-flex py-2 px-4 text-sm font-medium rounded text-center border text-primary-web-600 border-primary-web-600 hover:text-white hover:bg-primary-web-600 focus:ring-4 focus:outline-none focus:ring-primary-web-300 dark:border-primary-web-500 dark:text-primary-web-500 dark:hover:text-white dark:hover:bg-primary-web-600 dark:focus:ring-primary-web-800">{{ telphoneReadble }}</a>
                </div>
                <div>
                    <div class="flex justify-center items-center mx-auto mb-4 w-10 h-10 bg-gray-100 dark:bg-gray-800 lg:h-16 lg:w-16">
                        <svg class="w-5 h-5 text-primary-web-600 lg:w-8 lg:h-8 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <p class="mb-2 text-xl font-bold dark:text-white">Dirección</p>
                    <a :href="mapUrl" target="_blank" class="inline-flex py-2 px-4 text-sm font-medium text-center rounded border text-primary-web-600 border-primary-web-600 hover:text-white hover:bg-primary-web-600 focus:ring-4 focus:outline-none focus:ring-primary-web-300 dark:border-primary-web-500 dark:text-primary-web-500 dark:hover:text-white dark:hover:bg-primary-web-600 dark:focus:ring-primary-web-800">{{ address }}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20">
        <div class="max-w-screen-lg mx-auto rounded-xl shadow-xl h-72" v-html="mapIframe"></div>
    </section>
</Layout>
</template>
