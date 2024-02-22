<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CardUser from '@/Components/CardUser.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    users: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Usuarios</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <CardUser v-for="user in users"
                    :user="user"
                    :key="user.id"
                />

            </div>
        </div>

    </AuthenticatedLayout>
</template>
