<template>
  <div id="leafletMap" class="border border-primary-web-700"></div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import "leaflet/dist/images/layers-2x.png";
import "leaflet/dist/images/layers.png";
import "leaflet/dist/images/marker-icon-2x.png";
import "leaflet/dist/images/marker-icon.png";
import "leaflet/dist/images/marker-shadow.png";
import L from "leaflet";

export default {
  props: {
    latLng: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      map: null,
      marker: null,
    };
  },
  mounted() {
    this.renderMap();
  },
  methods: {
    renderMap() {
      if (this.map) {
        this.map.remove();
      }
      this.map = L.map("leafletMap").setView(this.latLng, 15);

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "",
      }).addTo(this.map);

      this.setMarker();
    },
    setMarker() {
      if (this.map !== null) {
        //limpiamos el marcador
        if (this.marker) {
          this.map.removeLayer(this.marker);
        }
        //agregamos el marcador
        this.marker = L.marker(this.latLng, { draggable: false }).addTo(
          this.map
        );
        this.map.setView(this.latLng, this.map.getZoom());
      }
    },
  },
};
</script>

<style>
#leafletMap {
  height: 250px;
}
</style>
