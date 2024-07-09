<script setup>
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
} from '@/Services/env.js';
const { executeRecaptcha, recaptchaLoaded } = useReCaptcha();
const form = useForm({
    name: '',
    message: '',
    captcha_token: '',
});
const recaptcha = async () => {
    // (optional) Wait until recaptcha has been loaded.
    await recaptchaLoaded()

    // Execute reCAPTCHA with action.
    form.captcha_token = await executeRecaptcha('consult')

    handleSubmit();
    // Do stuff with the received token.
};
function handleSubmit(){
    form.post(route('consult.footer'), {
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
    <footer class="p-2 sm:p-4 md:p-12">
        <section class="bg-primary-web-700 dark:bg-gray-900 grid grid-cols-1 sm:grid-cols-3">
            <div class="px-4 py-8 max-sm:mb-4">
                <img :src="baseUrl + 'images/logos/building-inmobiliaria.webp'" class="w-56 mx-auto" alt="Building Inmobiliaria Logo" />
                <div class="flex items-center justify-center mx-auto mt-8">
                    <img :src="baseUrl + 'images/social/facebook.svg'" class="w-12 px-2" alt="icono facebook" />
                    <img :src="baseUrl + 'images/social/instagram.svg'" class="w-12 px-2" alt="icono instagram" />
                </div>
            </div>
            <div class="text-white flex flex-col mx-auto max-sm:text-center sm:mt-10 max-sm:mb-4">
                <h3 class="font-bold text-xl mb-2">Contacto</h3>
                <ul class="mb-6 sm:mb-10 text-lg">
                    <li><a :href="'tel:' + telphoneLinkeable" target="_blank"><i class="icon-[mdi--phone] mr-2 sm:-ml-6"></i>{{ telphoneReadble }}</a></li>
                    <li><a :href="mapUrl" target="_blank"><i class="icon-[mdi--map-marker] mr-2 sm:-ml-6"></i>{{ address }}</a></li>
                </ul>
                <h3 class="font-bold text-xl mb-2">Horarios</h3>
                <ul class="text-lg">
                    <li><i class="icon-[flowbite--clock-solid] mr-2 sm:-ml-6"></i>{{ schedules }}</li>
                </ul>
            </div>
            <div class="text-white text-center max-sm:py-4 sm:text-right sm:mt-10 sm:pr-4 lg:pr-8 xl:pr-12 max-sm:mx-auto">
                <h4 class="font-bold text-2xl">Contáctenos</h4>
                <p>Publique su inmueble con nosotros</p>
                <form @submit.prevent="recaptcha" class="max-w-sm ml-auto mt-3 max-sm:px-2 sm:flex sm:flex-col sm:items-end">
                    <input
                        type="text"
                        v-model="form.name"
                        class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Su Nombre" required
                    />
                    <textarea
                        rows="3"
                        v-model="form.message"
                        class="mb-3 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Su Consulta..."
                        required
                    ></textarea>
                    <button
                        type="submit"
                        class="w-3/6 text-primary-web-700 bg-white hover:bg-gray-200 focus:ring-4 focus:ring-primary-web-300 font-medium text-sm py-2 px-6 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                    >
                        Enviar</button>
                </form>
            </div>
        </section>
    </footer>
</template>
