<template>
    <div class="map-container">
        <div id="map"></div>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import "leaflet/dist/leaflet.css";
import L from "leaflet";

export default {
    name: "LivestockHeatmap",
    setup() {
        const map = ref(null);

        onMounted(() => {
            map.value = L.map("map").setView([13.1939, 121.0263], 10); // Center the map on Oriental Mindoro
            L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            ).addTo(map.value);

            // Fetch livestock data from your CodeIgniter backend using Axios
            axios
                .get("/admin/livestock-mapping-data")
                .then((response) => {
                    const livestockData = response;
                    plotLivestockData(livestockData.data.farmers);
                })
                .catch((error) => {
                    console.error("Error fetching livestock data:", error);
                });
        });

        const plotLivestockData = (livestockData) => {
            // Process livestock data and plot it on the map
            livestockData.forEach((farmer) => {
                const { barangay, city, province, livestocks } = farmer;
                const livestockCounts = {};

                livestocks.forEach(({ livestockType, livestockCount }) => {
                    livestockCounts[livestockType] = parseInt(livestockCount);
                });

                const popupContent = `
                <b>Location:</b> ${barangay}, ${city}, ${province}<br>
                <b>Livestock Counts:</b><br>
                ${Object.entries(livestockCounts)
                    .map(([type, count]) => `- ${type}: ${count}`)
                    .join("<br>")}
            `;

                L.marker(getCoordinates(barangay, city, province))
                    .bindPopup(popupContent)
                    .addTo(map.value);
            });
        };

        const getCoordinates = (barangay, city, province) => {
            // Replace this function with one that retrieves coordinates for the given location
            // For simplicity, assume coordinates are hard-coded or fetched from a separate API
            // You can use Geocoding APIs like Google Maps Geocoding or OpenStreetMap Nominatim for this purpose
            return [13.2744,	121.2387]; // Default coordinates for Oriental Mindoro
        };

        return { map };
    },
};
</script>

<style>
.map-container {
    background: white;
    border: 1px solid rgb(209, 213, 219);
    border-radius: 8px;
    padding: 1rem;
    height: 600px;
}
#map {
    height: 100%;
}
</style>
