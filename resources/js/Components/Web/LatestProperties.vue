<script setup>
import Property from '@/Components/Web/Property.vue';
const props = defineProps({
    properties: {
        type: Array,
        required: true
    },

});
</script>
<template>
    <section class="container px-6 py-12 mx-auto">
        <div class=" text-center">
            <h2 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-primary-web-700 md:text-3xl lg:text-4xl dark:text-white py-8">Últimos inmuebles</h2>
            <template v-if="props.properties && props.properties.length">

                <div class="auto-rows-max col-span-12 min-[1023px]:col-span-8 min-[1279px]:col-span-9 min-[1610px]:col-span-10 mx-auto grid min-[1610px]:grid-cols-4 min-[1279px]:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-y-2 gap-x-2 md:gap-x-4 justify-items-center">
                    <Property
                        v-for="item in props.properties"
                        :key="item.id"
                        :id="item.id"
                        :province="item.province"
                        :imageCover="item.currentImageCover"
                        :status="item.status"
                        :type="item.type"
                        :isPriceDollar="item.is_price_dollar"
                        :price="item.price_property"
                        :priceHidden="item.price_hidden"
                        :address="item.address"
                        :description="item.description"
                        :superficieCubierta="item.superficie_cubierta"
                        :superficieTotal="item.superficie_total"
                        :banos="item.banos"
                        :dormitorios="item.dormitorios"
                        :cochera="item.cochera"
                        :admin="false"
                    />
                </div>
            </template>
        </div>
    </section>
</template>
