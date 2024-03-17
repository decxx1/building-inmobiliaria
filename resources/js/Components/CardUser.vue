<script setup>
const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    handleOpenDrawerEdit: {
        type: Function,
        required: true
    },
    handleOpenDrawerPassword: {
        type: Function,
        required: true
    },
    handleOpenDrawerAvatar: {
        type: Function,
        required: true
    },
    handleOpenModalDelete: {
        type: Function,
        required: true
    }
});

</script>

<template>

    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:border-surface-dark dark:shadow-gray-900 dark:bg-surface-dark">
        <div class="flex justify-end px-4 pt-4">
           <button id="dropdownButton" :data-dropdown-toggle="'dropdown' + user.id" class="inline-block text-gray-500 dark:text-white hover:bg-gray-100 dark:hover:bg-background-dark focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-background-dark rounded-lg text-sm p-1.5" type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
            </button>

            <div :id="'dropdown' + user.id" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-background-dark dark:shadow-surface-dark dark:border-surface-dark">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li>
                        <a
                            @click="handleOpenDrawerEdit(user)"
                            class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-200 dark:hover:text-white"
                        >
                            Editar
                        </a>
                    </li>
                    <li>
                        <a
                            @click="handleOpenDrawerPassword(user)"
                            class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-200 dark:hover:text-white"
                        >
                            Cambiar Contraseña
                        </a>
                    </li>
                    <li v-if="user.id !== $page.props.auth.user.id">
                        <a
                            @click="handleOpenModalDelete(user)"
                            class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-200 dark:hover:text-white"
                        >
                            Eliminar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" :src="user.avatar ? user.avatar : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'" alt="Avatar usuario"/>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{user.name}}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{user.email}}</span>
            <div class="flex mt-4 md:mt-6">
                <button @click="handleOpenDrawerAvatar(user)" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-primary hover:bg-primary-hover focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-centerme-2 dark:bg-primary-dark dark:hover:bg-blue-800 dark:focus:ring-blue-800">Cambiar avatar</button>

            </div>
        </div>
    </div>

</template>
