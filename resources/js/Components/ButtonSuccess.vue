<script setup>
import { ref, watch } from 'vue';
const props = defineProps ({
    disabled : {
        type: Boolean,
        default: false
    },
    type : {
        type: String,
        default: 'button'
    }
})

</script>
<template>
    <button
        class="text-white bg-success-600 hover:bg-success-500 focus:ring-4 focus:outline-none focus:ring-success-400 rounded font-semibold text-md px-4 py-2 text-center dark:bg-success-800 dark:hover:bg-success-700 dark:focus:ring-success-700"
        :disabled="props.disabled"
        :type="props.type"
    >
        <slot />
    </button>
</template>
