<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

defineProps({
    icon: {
        type: String,
        required: true,
    },
    placeholder: {
        type: String,
    },
    type: {
        type: String,
    }
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

</script>

<template>
    <div class="max-w-sm w-5/6 h-14 grid my-2.5 px-1.5 rounded-3xl bg-white dark:bg-surface-dark" style="grid-template-columns: 15% 70% 15%;">
        <i :class="`${icon} justify-self-center self-center h-[18px] w-[18px] bg-gray-400 dark:bg-gray-300`"></i>
        <input
            class="bg-autocomplete bg-transparent outline-none border-none font-semibold text-lg text-gray-800 dark:text-gray-100 focus:ring-transparent placeholder:dark:text-gray-500 placeholder:text-gray-300 placeholder:font-medium"
            v-model="model"
            ref="input"
            :placeholder="placeholder"
            :type="type"
        />
        <slot />
    </div>
</template>

<style scoped>
.bg-autocomplete:-webkit-autofill,
.bg-autocomplete:-webkit-autofill:hover,
.bg-autocomplete:-webkit-autofill:focus,
.bg-autocomplete:-webkit-autofill:active {
  transition: background-color 5000s ease-in-out 0s;
  background: transparent !important;
}
</style>
