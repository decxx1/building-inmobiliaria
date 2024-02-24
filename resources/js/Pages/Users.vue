<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CardUser from '@/Components/CardUser.vue';
import { Head } from '@inertiajs/vue3';
import ButtonIcon from '@/Components/ButtonIcon.vue';

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
                <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <ButtonIcon
                        name="Crear Usuario"
                        icon="icon-[fa6-solid--user-plus]"
                    >
                    </ButtonIcon>
                </div>
                <div class="mt-5 w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                        <CardUser v-for="user in users"
                            :user="user"
                            :key="user.id"
                        />
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
