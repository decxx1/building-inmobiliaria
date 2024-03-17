<script setup>
import DrawerRight from '@/Components/DrawerRight.vue';
import { toast } from 'vue-sonner'
import { useForm } from '@inertiajs/vue3';
import { watch, onMounted } from 'vue';



const props = defineProps ({
    user: {
        type: Object,
        required: true
    },
    handleDrawerAvatarToggle: {
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
    avatar: props.user.avatar,
});

const handleEditAvatar = () => {
    form.put(route('users.avatar', { id: form.id }), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('¡Avatar actualizado!')
            form.reset();
            props.handleDrawerAvatarToggle();
        },
        onError: (error) => {
            //console.error(error)
            const { avatar } = form.errors;
            if (avatar) {
                toast.warning(avatar)
            }
        },
    });
}

onMounted(() => {


})
watch(() => props.user, () => {
    form.id = props.user.id;
    form.avatar = props.user.avatar;
});


</script>

<template>
    <!-- Editar avatar -->
    <DrawerRight
        icon="icon-[fa-solid--edit]"
        title="Cambiar Avatar"
        :onSubmit="handleEditAvatar"
        :drawerId="props.drawerId"
        :handleDrawerToggle="props.handleDrawerAvatarToggle"
    >

        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar</label>
        <form action="/file-upload"
            class="dropzone"
            id="avatar"
            >
        </form>

    </DrawerRight>
</template>
