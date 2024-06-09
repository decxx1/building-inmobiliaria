<script setup>
import ButtonDelete from '@/Components/ButtonDelete.vue';
import { toast } from 'vue-sonner'
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
const props = defineProps ({
    user: {
        type: Object,
        required: true
    },
    handleCloseModalDelete: {
        type: Function,
        required: true
    },
    modalId: {
        type: String,
        required: true
    },
    updateUsers: {
        type: Function,
        required: true
    }
})
const form = useForm({
    id: props.user.id,
});

watch(() => props.user, () => {
    form.id = props.user.id;
});

const handleDeleteUser = () => {
    form.delete(route('users.destroy', { id: form.id }), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('¡Usuario eliminado!')
            form.reset();
            props.handleCloseModalDelete();
            props.updateUsers();
        },
        onError: (error) => {
            console.error(error)
           if (error.message){
                toast.warning(error.message)
            }
        },
    });
}
</script>

<template>
    <ButtonDelete
        :handleCloseModalDelete="handleCloseModalDelete"
        :handleConfirmDelete="handleDeleteUser"
        :modalId="props.modalId"
        :title="'¿Desea eliminar el usuario ' + props.user.name + ' ?'"
    />
</template>
