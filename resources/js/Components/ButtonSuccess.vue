<script setup>
import { ref, watch } from 'vue';
const props = defineProps ({
    disabled : {
        type: Boolean,
        default: false
    }
})
const statusButton = ref(props.disabled);
watch(
    () => props.disabled,
    () => {
        statusButton.value = props.disabled
    },
);
</script>
<template>
    <button
        class="text-white bg-success hover:bg-success-hover focus:ring-4 focus:outline-none focus:ring-green-300 rounded font-semibold text-md px-4 py-2 text-center dark:bg-success-dark dark:hover:bg-success-hover dark:focus:ring-green-800"
        :disabled="statusButton"
    >
        <slot />
    </button>
</template>
