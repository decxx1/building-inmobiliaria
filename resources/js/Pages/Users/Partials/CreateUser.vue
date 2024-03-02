<script setup>
import DrawerRight from '@/Components/DrawerRight.vue';
import { toast } from 'vue-sonner'
import { useForm } from '@inertiajs/vue3';

const props = defineProps ({
    handleDrawerCreateToggle: {
        type: Function,
        required: true
    },
    drawerId: {
        type: String,
        required: true
    }
})
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});
const handleCreateUser = () => {
    form.post(route('users.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
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
    });
}
</script>

<template>
    <!-- Crear usuario -->
    <DrawerRight
        icon="icon-[fa6-solid--user-plus]"
        title="Crear Usuario"
        :onSubmit="handleCreateUser"
        :drawerId="props.drawerId"
        :handleDrawerToggle="props.handleDrawerCreateToggle"
    >
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input
                type="text"
                name="name"
                v-model="form.name"
                placeholder="Nombre"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
            </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
            <input
                type="email"
                name="email"
                v-model="form.email"
                placeholder="E-mail"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
            <input
                type="password"
                name="password"
                v-model="form.password"
                placeholder="Contraseña"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="mb-6">
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repetir contraseña</label>
            <input
                type="password"
                name="password_confirmation"
                v-model="form.password_confirmation"
                placeholder="Repetir contraseña"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
    </DrawerRight>
</template>
