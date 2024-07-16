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
      icon: null,
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
      this.icon = L.icon({
            iconUrl: '/images/markers/marker-icon.png',
            shadowUrl: '/images/markers/marker-shadow.png',

            iconSize:     [25, 41], // size of the icon
            shadowSize:   [45, 64], // size of the shadow
            iconAnchor:   [18, 46], // point of the icon which will correspond to marker's location
            shadowAnchor: [15, 74],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
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
        this.marker = L.marker(this.latLng, { icon:this.icon, draggable: false }).addTo(
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
