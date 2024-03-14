<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CardUser from '@/Components/CardUser.vue';
import CreateUser from '@/Pages/Users/Partials/CreateUser.vue';
import EditUser from '@/Pages/Users/Partials/EditUser.vue';
import ChangePassword from '@/Pages/Users/Partials/ChangePassword.vue';
import DeleteUser from '@/Pages/Users/Partials/DeleteUser.vue';
import { Head } from '@inertiajs/vue3';
import ButtonIcon from '@/Components/ButtonIcon.vue';
import Card from '@/Components/Card.vue';
import { ref, onMounted } from 'vue';
import { Drawer, Modal } from 'flowbite';

defineProps({
    users: {
        type: Object,
    },
});

const userToEdit = ref({});
const drawerEdit = ref(null);
const drawerCreate = ref(null);
const drawerPassword = ref(null);
const modalDelete = ref(null);
const drawerEditId = 'user-edit';
const drawerCreateId = 'user-create';
const drawerPasswordId = 'user-password-change';
const modalDeleteId = 'user-delete';

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
const handleOpenModalDelete = (user) => {
    userToEdit.value = user;
    modalDelete.value.show();
}
const handleCloseModalDelete = () => {
    modalDelete.value.hide();
}
onMounted(() => {
    // set the drawer menu element
    const targetDrawerCreate = document.getElementById(drawerCreateId);
    const targetDrawerEdit = document.getElementById(drawerEditId);
    const targetDrawerPassword = document.getElementById(drawerPasswordId);
    // set the modal menu element
    const targetModalDelete = document.getElementById(modalDeleteId);

    // options with default values
    const optionsModal = {
        placement: 'bottom-right',
        backdrop: 'dynamic',
        backdropClasses:
            'bg-gray-900/50 dark:bg-backdrop-dark fixed inset-0 z-40',
        closable: true,
    };

    // instance options object
    const instanceOptionsModal = {
        id: modalDeleteId,
        override: true
    };

    // options with default values
    const options = {
        placement: 'right',
        backdrop: 'true',
        backdropClasses:
            'bg-gray-900/50 dark:bg-backdrop-dark fixed inset-0 z-30',
        bodyScrolling: true,

    };

    drawerEdit.value = new Drawer(targetDrawerEdit, options);
    drawerCreate.value = new Drawer(targetDrawerCreate, options);
    drawerPassword.value = new Drawer(targetDrawerPassword, options);
    modalDelete.value = new Modal(targetModalDelete, optionsModal, instanceOptionsModal);
})

</script>

<template>
    <Head title="Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Usuarios</h2>
        </template>

        <Card class="mb-8">
            <ButtonIcon
                name="Crear Usuario"
                icon="icon-[fa6-solid--user-plus]"
                @click="handleOpenDrawerCreate"
            >
            </ButtonIcon>
        </Card>


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                <CardUser v-for="user in users"
                    :user="user"
                    :key="user.id"
                    :handleOpenDrawerEdit="handleOpenDrawerEdit"
                    :handleOpenDrawerPassword="handleOpenDrawerPassword"
                    :handleOpenModalDelete="handleOpenModalDelete"
                />
            </div>


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

        <DeleteUser
            :user="userToEdit"
            :modalId="modalDeleteId"
            :handleCloseModalDelete="handleCloseModalDelete"
        />


    </AuthenticatedLayout>
</template>
