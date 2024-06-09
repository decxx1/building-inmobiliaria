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
    <form class="sign-in-form" @submit.prevent="submit">
        <h2 class="text-4xl font-bold mb-3 text-gray-600 dark:text-gray-300">Iniciar sesión</h2>

            <InputStyle
                icon="icon-[fa--envelope]"
                placeholder="E-mail"
                type="email"
                name="email"
                id="email"
                v-model="form.email"
                required
            />

            <InputStyle
                icon="icon-[fa--lock]"
                placeholder="Contraseña"
                :type="showPassword ? 'text' : 'password'"
                name="password"
                id="password"
                v-model="form.password"
                required
            >
                <i :class="[showPassword ? 'icon-[fa--eye-slash]' : 'icon-[fa--eye]', 'cursor-pointer justify-self-center self-center h-[18px] w-[18px] bg-gray-400 dark:bg-gray-200']" @click="togglePassword"></i>
            </InputStyle>

        <input
            :disabled="form.processing"
            type="submit"
            value="Entrar"
            class="w-40 h-12 text-sm md:text-base bg-primary dark:bg-primary-dark hover:bg-primary-hover rounded-3xl text-white font-semibold cursor-pointer my-2.5 uppercase"
        />
        <div class="mt-5">
            <ColorModeSwitcher />
        </div>
        <p class="text-gray-500 dark:text-gray-500">Cambiar tema</p>
    </form>
</template>
