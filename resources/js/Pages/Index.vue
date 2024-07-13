<script setup>
import Layout from '@/Layouts/Layout.vue';
import Hero from '@/Components/Web/Hero.vue'
import HeaderWeb from '@/Components/Web/HeaderWeb.vue'
import Features from '@/Components/Web/Features.vue'
import LatestProperties from '@/Components/Web/LatestProperties.vue'
import CallToAction from '@/Components/Web/CallToAction.vue'
const props = defineProps({
    properties: {
        type: Array,
        required: true
    },
    types: {
        type: Array,
        required: true
    },
    statuses: {
        type: Array,
        required: true
    },
});

</script>

<template>
    <Layout
        title="Inicio"
        canonical="https://inmobiliariabuilding.com.ar/"
        metaTitle="Building Inmobiliaria"
        metaDescription="Building Inmobiliaria en Argentina. ¿Quieres vender o alquilar tu propiedad con nosotros? te enviaremos un corredor inmobiliario a tu domicilio"
        metaImg="https://inmobiliariabuilding.com.ar/images/hero.avif"
        preLoad="images/hero.avif"
    >
        <HeaderWeb :heroPage="true" />
        <Hero :types="props.types" :statuses="props.statuses" />
        <Features />
        <LatestProperties
            :properties="props.properties"
        />
        <CallToAction />
    </Layout>
</template>
