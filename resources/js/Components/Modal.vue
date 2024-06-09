<script setup>
import { Modal } from 'flowbite';
import { onMounted, ref, watch } from 'vue';

const modal = ref(false);

const props = defineProps ({
    size:{
        type: String,
        default: '2xl'
    },
    show:{
        type: Boolean,
        default: false
    },
    persistent:{
        type: Boolean,
        default: false
    }
})
watch(
    () => props.show,
    () => {
        if(props.show){
            modal.value.show()
        }else{
            modal.value.hide()
        }
    }
);

//cerrar modal desde a dentro del componente
const emit = defineEmits(['close']);

const closeModal = () => {
    emit('close');
}

onMounted(() => {
    // set the modal menu element
    const $targetEl = document.getElementById('modalId');
    let backdropOption = props.persistent ? 'static' : 'dynamic';
    // options with default values
    const options = {
        placement: 'top-center',
        backdrop: backdropOption,
        backdropClasses:
            'bg-[#0000008a] fixed inset-0 z-[60]',
        closable: true,
        onHide: () => {
            emit('close');
        },
    };

    // instance options object
    const instanceOptions = {
    id: 'modalId',
    override: true
    };

    modal.value = new Modal($targetEl, options, instanceOptions);

})

const maxWidthClass = (maxWidth) => {
    return {
        md: 'max-w-md',
        lg: 'max-w-lg',
        xl: 'max-w-xl',
        '2xl': 'max-w-2xl',
        '3xl': 'max-w-3xl',
    }[maxWidth];
};
</script>
<template>
    <div
        id="modalId"
        tabindex="-1"
        aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-[70] hidden h-[calc(100%-1rem)] max-h-full w-full p-4 md:inset-0 overflow-y-auto"
    >
    <div :class="[maxWidthClass(props.size), 'relative max-h-full p-4 w-full']">
        <!-- Modal content -->
        <div class="relative rounded bg-white shadow-lg dark:bg-background-semidark" >
            <!-- Modal header -->
            <div
                class="flex items-start justify-between rounded-t border-b p-5 dark:border-gray-600"
            >
                <h3
                    v-if="$slots.header"
                    class="text-xl font-semibold text-gray-900 dark:text-white lg:text-2xl"
                >
                    <slot name="header" />
                </h3>
                <button
                    @click="closeModal"
                    type="button"
                    class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                >
                    <svg
                        class="h-3 w-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-6 p-6">
                <slot name="body" />
            </div>
            <!-- Modal footer -->
            <div
                class="space-x-2 rtl:space-x-reverse rounded-b border-t border-gray-200 p-6 dark:border-gray-600"
            >
                <slot name="footer" />
            </div>
        </div>
    </div>
</div>

</template>
