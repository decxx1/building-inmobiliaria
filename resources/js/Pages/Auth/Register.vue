<script setup>
import InputError from '@/Components/InputError.vue';
import { toast } from 'vue-sonner'
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputStyle from '@/Components/Welcome/InputStyle.vue';

const showPassword = ref(false);

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onError: (error) => {
            //console.error(error)
            const { name, email, password } = form.errors;
            if (name) {
                toast.warning(name)
            }else if (email) {
                toast.warning(email)
            }else if (password) {
                toast.warning(password)
            }else if (error.message){
                toast.warning(error.message)
            }
        },
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <form class="sign-up-form" @submit.prevent="submit">
        <h2 class="text-4xl font-bold mb-3 text-gray-600 dark:text-gray-300">Registrarse</h2>

        <InputStyle
            icon="icon-[fa--id-card]"
            id="name"
            type="text"
            placeholder="Nombre"
            v-model="form.name"
            required
            autofocus
            autocomplete="name"
        />
        <InputError class="mt-2" :message="form.errors.name" />

        <InputStyle
            icon="icon-[fa--envelope]"
            id="email"
            type="email"
            placeholder="E-mail"
            v-model="form.email"
            required
            autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />

        <InputStyle
            icon="icon-[fa--lock]"
            id="password"
            :type="showPassword ? 'text' : 'password'"
            v-model="form.password"
            placeholder="Contraseña"
            required
            autocomplete="new-password"
        >
            <i :class="[showPassword ? 'icon-[fa--eye-slash]' : 'icon-[fa--eye]', 'cursor-pointer justify-self-center self-center h-[18px] w-[18px] bg-gray-400 dark:bg-gray-200']" @click="togglePassword"></i>
        </InputStyle>

        <InputError class="mt-2" :message="form.errors.password" />

        <InputStyle
            icon="icon-[fa--lock]"
            id="password_confirmation"
            :type="showPassword ? 'text' : 'password'"
            placeholder="Repetir contraseña"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
        >
            <i :class="[showPassword ? 'icon-[fa--eye-slash]' : 'icon-[fa--eye]', 'cursor-pointer justify-self-center self-center h-[18px] w-[18px] bg-gray-400 dark:bg-gray-200']" @click="togglePassword"></i>
        </InputStyle>

        <InputError class="mt-2" :message="form.errors.password_confirmation" />

        <!-- <label class="check">
            <input type="checkbox" checked="checked">
            <span class="checkmark">I accept the <a href="terms.html">terms and services</a></span>
        </label> -->
        <input
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            type="submit"
            value="Crear cuenta"
            class="w-40 h-12 text-sm md:text-base bg-primary-600 hover:bg-primary-500 dark:bg-primary-800 dark:hover:bg-primary-700 rounded-3xl text-white font-semibold cursor-pointer my-2.5 uppercase"
        />

    </form>
</template>
