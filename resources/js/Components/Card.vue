<script setup>
import { computed } from 'vue';
const props = defineProps ({
    colorHeader:{
        type: String,
        default: 'primary'
    }
})
const headerClass = computed(() => {
    return {
        'primary': 'bg-primary-600 text-white dark:bg-primary-800',
        'secondary': 'bg-secondary-600 text-white dark:bg-secondary-800',
        'info': 'bg-info-600 text-white dark:bg-info-800',
        'warning': 'bg-warning-600 text-secondary-900 dark:bg-warning-800',
        'danger': 'bg-danger-600 text-white dark:bg-danger-800',
        'success': 'bg-success-600 text-white dark:bg-success-800',
    }[props.colorHeader];
});

</script>
<template>
    <div class="flex flex-col">
        <div v-if="$slots.header" :class="[headerClass, 'py-3 px-5 mb-0 break-words rounded-t shadow border-solid border-black bg-clip-border']">
            <slot name="header" />
        </div>
        <div :class="[$slots.header ? 'rounded-b' : 'rounded', 'bg-white dark:bg-surface-dark min-w-0 p-4 mb-4 break-words shadow-md border-solid border-black bg-clip-border']">
            <slot />
        </div>
    </div>
</template>
