<script setup>
const props = defineProps ({
    colorHeader:{
        type: String,
        default: 'primary'
    }
})
let headerClass = `bg-${props.colorHeader} text-white dark:bg-${props.colorHeader}-dark`;

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
