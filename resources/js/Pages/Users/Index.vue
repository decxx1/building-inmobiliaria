<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CardUser from '@/Components/CardUser.vue';
import CreateUser from '@/Pages/Users/Partials/CreateUser.vue';
import EditUser from '@/Pages/Users/Partials/EditUser.vue';
import ChangePassword from '@/Pages/Users/Partials/ChangePassword.vue';
import { Head } from '@inertiajs/vue3';
import ButtonIcon from '@/Components/ButtonIcon.vue';
import Card from '@/Components/Card.vue';
import { ref, onMounted } from 'vue';
import { Drawer } from 'flowbite';

defineProps({
    users: {
        type: Object,
    },
});

const userToEdit = ref({});
const drawerEdit = ref(null);
const drawerCreate = ref(null);
const drawerPassword = ref(null);
const drawerEditId = 'user-edit';
const drawerCreateId = 'user-create';
const drawerPasswordId = 'user-password-change';

const handleDrawerEditToggle = () => {
    drawerEdit.value.toggle();
}
const handleDrawerCreateToggle = () => {
    drawerCreate.value.toggle();
}
const handleDrawerPasswordToggle = () => {
    drawerPassword.value.toggle();
}
const handleOpenDrawerEdit = (user) => {
    userToEdit.value = user;
    drawerEdit.value.show();
}
const handleOpenDrawerPassword = (user) => {
    userToEdit.value = user;
    drawerPassword.value.show();
}
const handleOpenDrawerCreate = () => {
    drawerCreate.value.show();
}

onMounted(() => {
    // set the drawer menu element
    const targetDrawerCreate = document.getElementById(drawerCreateId);
    const targetDrawerEdit = document.getElementById(drawerEditId);
    const targetDrawerPassword = document.getElementById(drawerPasswordId);

    // options with default values
    const options = {
        placement: 'right',
        backdrop: 'false',
        backdropClasses:
                'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30',
        bodyScrolling: true,

    };

    drawerEdit.value = new Drawer(targetDrawerEdit, options);
    drawerCreate.value = new Drawer(targetDrawerCreate, options);
    drawerPassword.value = new Drawer(targetDrawerPassword, options);
})

</script>

<template>
    <Head title="Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Usuarios</h2>
        </template>

        <Card >
            <ButtonIcon
                name="Crear Usuario"
                icon="icon-[fa6-solid--user-plus]"
                @click="handleOpenDrawerCreate"
            >
            </ButtonIcon>
        </Card>

        <Card>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                <CardUser v-for="user in users"
                    :user="user"
                    :key="user.id"
                    :handleOpenDrawerEdit="handleOpenDrawerEdit"
                    :handleOpenDrawerPassword="handleOpenDrawerPassword"
                />
            </div>
        </Card>

        <CreateUser
            :drawerId="drawerCreateId"
            :handleDrawerCreateToggle="handleDrawerCreateToggle"
        />

        <EditUser
            :user="userToEdit"
            :drawerId="drawerEditId"
            :handleDrawerEditToggle="handleDrawerEditToggle"
        />

        <ChangePassword
            :user="userToEdit"
            :drawerId="drawerPasswordId"
            :handleDrawerPasswordToggle="handleDrawerPasswordToggle"
        />



    </AuthenticatedLayout>
</template>
