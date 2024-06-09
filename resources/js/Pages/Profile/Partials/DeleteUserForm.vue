<script setup>
import DangerButton from '@/Components/ButtonDanger.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/ButtonSecondary.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Eliminar Usuario</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Los datos de esta cuenta se eliminarán permanentemente.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Eliminar Usuario</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <template #header>
                <div class="flex items-center text-lg text-black dark:text-white">
                    Eliminar Usuario
                </div>
            </template>
            <template #body>
                <div class="px-6">

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        ¿Seguro que quieres eliminar esta cuenta?
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Los datos se eliminarán permanentemente.
                    </p>

                    <div class="mt-6">
                        <InputLabel for="password" value="Password" class="sr-only" />

                        <TextInput
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="Contraseña"
                            @keyup.enter="deleteUser"
                        />

                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>
                </div>
                </template>
                <template #footer>
                    <div class="flex justify-end">
                        <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                        <DangerButton
                            class="ms-3"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="deleteUser"
                        >
                            Eliminar cuenta
                        </DangerButton>
                    </div>
                </template>

        </Modal>
    </section>
</template>
