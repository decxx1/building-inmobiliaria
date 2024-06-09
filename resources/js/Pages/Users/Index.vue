<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CardUser from '@/Components/CardUser.vue';
import CreateUser from '@/Pages/Users/Partials/CreateUser.vue';
import EditUser from '@/Pages/Users/Partials/EditUser.vue';
import ChangePassword from '@/Pages/Users/Partials/ChangePassword.vue';
import DeleteUser from '@/Pages/Users/Partials/DeleteUser.vue';
import { toast } from 'vue-sonner'
import { Head, useForm } from '@inertiajs/vue3';
import ButtonIcon from '@/Components/ButtonIcon.vue';
import Card from '@/Components/Card.vue';
import Pagination from '@/Components/Pagination.vue';
import { ref, onMounted } from 'vue';
import { Drawer, Modal } from 'flowbite';

const props = defineProps({
    usersPagination: {
        type: Object,
    }
});
//console.log(props.usersPagination)
//pagination
const currentPage = ref(props.usersPagination.current_page);
const users = ref(props.usersPagination.data);
const perPage = ref(props.usersPagination.per_page);
const totalUsers = ref(props.usersPagination.total);
//crud
const userToEdit = ref({});
const drawerEdit = ref(null);
const drawerCreate = ref(null);
const drawerPassword = ref(null);
const modalDelete = ref(null);
const drawerEditId = 'user-edit';
const drawerCreateId = 'user-create';
const drawerPasswordId = 'user-password-change';
const modalDeleteId = 'user-delete';

const totalPages = (total, per_page) => {
    return Math.ceil(total / per_page);
}

const handlePageChange = (page) => {
    currentPage.value = page;
    updateUsers();
}

const updateUsers = () => {
    form.get(route('users', { page: currentPage.value }), {
        onSuccess: (resp) => {
            //console.log(resp)
            users.value = resp.data;
        },
        onError: (error) => {
            console.error(error)
        },
    });
}
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

const form = useForm({
    image: null,
});
const handleFileChange = (event, user) => {
    form.image = event.target.files[0];
    // console.log(event.target.files[0])
    // console.log(user)
    handleEditAvatar(user);
}
const handleEditAvatar = (user) => {
    form.post(route('users.avatar', { id: user.id }), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('¡Imagen actualizada!')
            form.reset();
            updateUsers();
        },
        onError: (error) => {
            console.error(error)
            const { image } = form.errors;
            if (image) {
                toast.warning(image)
            }
        },
    });
}
onMounted(() => {
    // set the drawer menu element
    const targetDrawerCreate = document.getElementById(drawerCreateId);
    const targetDrawerEdit = document.getElementById(drawerEditId);
    const targetDrawerPassword = document.getElementById(drawerPasswordId);
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

    const options = {
        placement: 'right',
        backdrop: 'true',
        backdropClasses: 'bg-gray-900/50 dark:bg-backdrop-dark fixed inset-0 z-30',
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


        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 justify-items-center">
            <CardUser v-for="user in users"
                :user="user"
                :key="user.id"
                :handleOpenDrawerEdit="handleOpenDrawerEdit"
                :handleOpenDrawerPassword="handleOpenDrawerPassword"
                :handleOpenModalDelete="handleOpenModalDelete"
                :handleFileChange="handleFileChange"
            />
        </div>
        <Pagination
            :total="totalPages(totalUsers, perPage)"
            :current="currentPage"
            :onPageChange="handlePageChange"
            :extraClass="'mt-8'"
        />

        <CreateUser
            :drawerId="drawerCreateId"
            :handleDrawerCreateToggle="handleDrawerCreateToggle"
            :updateUsers="updateUsers"
        />

        <EditUser
            :user="userToEdit"
            :drawerId="drawerEditId"
            :handleDrawerEditToggle="handleDrawerEditToggle"
            :updateUsers="updateUsers"
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
            :updateUsers="updateUsers"
        />

    </AuthenticatedLayout>
</template>
