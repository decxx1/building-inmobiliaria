<script setup>
import Property from "@/Components/Web/Property.vue";
const props = defineProps({
  properties: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <template v-if="props.properties && props.properties.length">
      <Property
        v-for="item in props.properties"
        :key="item.id"
        :id="item.id"
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
  </template>
  <div v-else class="ml-4 border-b dark:border-gray-700 h-72">
    <p class="whitespace-nowrap">No hay inmuebles cargados</p>
  </div>
</template>
