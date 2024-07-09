<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Toaster } from 'vue-sonner';
import Login from '@/Pages/Auth/Login.vue';
import {ref} from "vue";


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
    <Head title="Admin" />

    <Toaster richColors position="top-right" />

    <Login />
</template>

<style scoped>
</style>
