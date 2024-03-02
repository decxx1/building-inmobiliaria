<script setup>
import DrawerRight from '@/Components/DrawerRight.vue';
import { toast } from 'vue-sonner'
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps ({
    user: {
        type: Object,
        required: true
    },
    handleDrawerPasswordToggle: {
        type: Function,
        required: true
    },
    drawerId: {
        type: String,
        required: true
    }
})

const form = useForm({
    id: props.user.id,
    password: '',
    password_confirmation: '',
    password_current: ''
});

watch(() => props.user, () => {
    form.id = props.user.id;
});

const handleChangePassword = () => {
    form.put(route('users.update.password', { id: form.id }), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Contraseña actualizada!')
            form.reset();
            props.handleDrawerPasswordToggle();
        },
        onError: (error) => {
            console.error(error)
            const { password, password_confirmation, password_current } = form.errors;

            if (password_current) {
                toast.warning(password_current)
            }else if (password) {
                toast.warning(password)
            }else if (password_confirmation) {
                toast.warning(password_confirmation)
            }else if (error.message){
                toast.warning(error.message)
            }
        },
    });
}
</script>

<template>
    <!-- Cambiar contraseña -->
    <DrawerRight
        icon="icon-[tabler--password-user]"
        title="Cambiar contraseña"
        :onSubmit="handleChangePassword"
        :drawerId="props.drawerId"
        :handleDrawerToggle="props.handleDrawerPasswordToggle"
    >
        <div class="mb-6">
            <label for="password_current" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña Actual</label>
            <input
                type="password"
                name="password_current"
                v-model="form.password_current"
                placeholder="Contraseña actual"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
            </div>
        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña nueva</label>
            <input
                type="password"
                name="password"
                v-model="form.password"
                placeholder="Contraseña nueva"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="mb-6">
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repetir contraseña nueva</label>
            <input
                type="password"
                name="password_confirmation"
                v-model="form.password_confirmation"
                placeholder="Repetir contraseña nueva"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
    </DrawerRight>
</template>
