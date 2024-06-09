<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Toaster } from 'vue-sonner';
import Login from '@/Pages/Auth/Login.vue';
import Register from '@/Pages/Auth/Register.vue';
import {ref} from "vue";
import '@fontsource/poppins/200.css';
import '@fontsource/poppins/300.css';
import '@fontsource/poppins/400.css';
import '@fontsource/poppins/500.css';
import '@fontsource/poppins/600.css';
import '@fontsource/poppins/700.css';
import '@fontsource/poppins/800.css';

const props = defineProps({
    loginRegister: {
        type: String,
    },
});

const signUpMode = ref(props.loginRegister);

const signUpBtn= () => {
    signUpMode.value = 'sign-up-mode';
};

const signInBtn = () => {
    signUpMode.value = '';
};

</script>

<template>
    <Head title="Entrar / Registro" />

    <Toaster richColors position="top-right" />

    <div :class="['container2', signUpMode, 'font-[Poppins]']">
    <div class="forms-container">
      <div class="signin-signup">

        <!-- formulario de login -->
        <Login />

       <!-- formulario de registro -->
        <Register />
      </div>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>¿No tienes cuenta?</h3>
          <p>Cree una cuenta nueva para poder utilizar el programa de stock.<br/>
            Pruébelo GRATIS no requiere tarjeta</p>
          <button class="md:w-32 md:h-10 h-9 w-28 text-xs md:text-sm bg-transparent border-2 border-white hover:bg-primary dark:hover:bg-primary-dark hover:border-none rounded-3xl text-white font-semibold cursor-pointer my-2.5 uppercase" @click="signUpBtn">Registrarse</button>
        </div>
        <br/>
      </div>

      <div class="panel right-panel">
        <div class="content">
          <h3>¿Ya tiene una cuenta?</h3>
          <p>Si se registró con anterioridad, inicie sesión con sus datos</p>
          <button class="md:w-32 md:h-10 h-9 w-28 text-xs md:text-sm bg-transparent border-2 border-white hover:bg-primary dark:hover:bg-primary-dark hover:border-none rounded-3xl text-white font-semibold cursor-pointer my-2.5 uppercase" @click="signInBtn">Iniciar sesión</button>
        </div>
        <br/>
      </div>
    </div>
  </div>
</template>

<style scoped>
@import '@/../css/login.css';
</style>
