<script setup>
const props = defineProps({
    name: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        required: true,
    },
    size: {
        type: String,
        default: 'md'
    },
    color: {
        type: String,
        default: 'primary'
    }
})

const sizeClass = () => {
    if(props.size === 'sm'){
        return 'px-2 py-1 text-sm'
    }
    if(props.size === 'md'){
        return 'px-4 py-2 text-md'
    }
    if(props.size === 'lg'){
        return 'px-8 py-4 text-lg'
    }
}
const colorClass = () => {
    if(props.color === 'primary'){
        return 'bg-primary-600 hover:bg-primary-500 focus:ring-primary-400 dark:bg-primary-800 dark:hover:bg-primary-700 dark:focus:ring-primary-700'
    }
    if(props.color === 'danger'){
        return 'bg-danger-600 hover:bg-danger-500 focus:ring-danger-400 dark:bg-danger-800 dark:hover:bg-danger-700 dark:focus:ring-danger-700'
    }
}
</script>
<template>
  <button
    type="button"
    :class="[sizeClass(), colorClass(), 'text-white focus:ring-4 focus:outline-none font-semibold rounded text-center inline-flex items-center']"
  >
    <span :class="icon" class="w-5 h-5 mr-2"></span>
    {{name}}
  </button>
</template>
