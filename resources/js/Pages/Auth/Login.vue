<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import ColorModeSwitcher from '@/Layouts/Partials/ColorModeSwitcher.vue';
import InputStyle from '@/Components/Welcome/InputStyle.vue';

const showPassword = ref(false);

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <section
        class="bg-[url('/images/hero.avif')] bg-no-repeat bg-cover bg-center bg-gray-700 bg-blend-multiply bg-opacity-60">
        <form class="sign-in-form" @submit.prevent="submit">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen pt:mt-0">
                <a href="/" class="flex items-center justify-center mb-4 text-2xl font-semibold text-white bg-primary-web-700 w-full sm:max-w-md py-2 rounded">
                    <img class="h-14 mr-2" loading="lazy" src="images/logos/building-inmobiliaria-ancho.webp"
                        alt="logo">
                </a>
                <div class="w-full bg-white rounded shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800">
                    <div class="p-6 space-y-4 md:space-y-6 lg:space-y-8 sm:p-8">
                        <h1
                            class="text-xl font-bold leading-tight tracking-tight text-center text-gray-900 md:text-2xl dark:text-white">
                            Iniciar sesión
                        </h1>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    E-mail</label>
                                <input
                                    placeholder="E-mail"
                                    type="email"
                                    name="email"
                                    id="email"
                                    v-model="form.email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    required
                                />
                            </div>
                            <div>
                                <label
                                    for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Contraseña
                                </label>
                                <input
                                    placeholder="Contraseña"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    id="password"
                                    v-model="form.password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    required
                                />
                            </div>

                            <button
                                :disabled="form.processing"
                                type="submit"
                                class="w-full text-white bg-primary-web-700 hover:bg-primary-web-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            >
                                Entrar
                            </button>
                    </div>
                </div>
            </div>
        </form>
    </section>


</template>
