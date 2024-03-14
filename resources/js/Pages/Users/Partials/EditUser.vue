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
    handleDrawerEditToggle: {
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
    name: props.user.name,
    email: props.user.email,
});

watch(() => props.user, () => {
    form.id = props.user.id;
    form.name = props.user.name;
    form.email = props.user.email;
});

const handleEditUser = () => {
    form.put(route('users.update', { id: form.id }), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('¡Usuario actualizado!')
            form.reset();
            props.handleDrawerEditToggle();
        },
        onError: (error) => {
            //console.error(error)
            const { name, email } = form.errors;
            if (name) {
                toast.warning(name)
            }else if (email) {
                toast.warning(email)
            }else if (error.message){
                toast.warning(error.message)
            }
        },
    });
}
</script>

<template>
    <!-- Editar usuario -->
    <DrawerRight
        icon="icon-[fa-solid--user-edit]"
        title="Editar Usuario"
        :onSubmit="handleEditUser"
        :drawerId="props.drawerId"
        :handleDrawerToggle="props.handleDrawerEditToggle"
    >
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input
                type="text"
                name="name"
                v-model="form.name"
                placeholder="Nombre"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-background-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
    </DrawerRight>
</template>
