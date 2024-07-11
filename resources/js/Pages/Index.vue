<script setup>
import Layout from '@/Layouts/Layout.vue';
import Hero from '@/Components/Web/Hero.vue'
import HeaderWeb from '@/Components/Web/HeaderWeb.vue'
import Features from '@/Components/Web/Features.vue'
import LatestProperties from '@/Components/Web/LatestProperties.vue'

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
    <Layout>
        <HeaderWeb :heroPage="true" />
        <Hero :types="props.types" :statuses="props.statuses" />
        <Features />
        <LatestProperties
            :properties="props.properties"
        />
    </Layout>
</template>
