<template>
  <div id="leafletMap"></div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import L from "leaflet";

export default {
  props: {
    onClickMap: {
      type: Function,
      required: true,
    },
    render: {
      type: Boolean,
      required: true,
    },
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
  watch: {
    render() {
      this.initMap();
    },
    latLng() {
      this.setMarker();
    },
  },
  methods: {
    renderMap() {
      if (this.map) {
        this.map.remove();
      }
      this.map = L.map("leafletMap").setView(this.latLng, 13);

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "",
      }).addTo(this.map);
    },
    initMap() {
      this.renderMap();

      this.map.on("click", (event) => {
        //limpiamos el marcador
        if (this.marker) {
          this.map.removeLayer(this.marker);
        }
        //obtenemos coordenadas
        //las enviamos afuera
        this.onClickMap(event.latlng);

      });
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
  height: 400px;
}
</style>
