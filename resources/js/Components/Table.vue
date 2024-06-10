<script setup>
const props = defineProps ({
    headers: {
        type: Object,
        required: true
    },
})
</script>
<template>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-primary-600 dark:bg-primary-800">
                        <tr>
                            <th
                                scope="col"
                                class="px-2 py-3 dark:border-gray-500 w-0"
                            >Opc.</th>
                            <th
                                scope="col"
                                class="px-4 py-3 dark:border-gray-500"
                                v-for="(header, index) in headers"
                                :key="index"
                            >{{header}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <slot />
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                <slot name="showing"/>
                <slot name="pagination" />
            </nav>
</template>
<style scope>

</style>
