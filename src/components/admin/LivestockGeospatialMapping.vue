<template>
    <div class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center">
        <div class="text-700 text-2xl font-bold">Livestock Geospatial Mapping</div>
        <div class="map-container">
            <div id="map"></div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import "leaflet/dist/leaflet.css";
import "leaflet.markercluster/dist/MarkerCluster.css";
import "leaflet.markercluster/dist/MarkerCluster.Default.css";
import L from "leaflet";
import "leaflet.markercluster";
import { LivestockService } from "@/services/LivestockServices";

export default {
    name: "LivestockHeatmap",
    setup() {
        const map = ref(null);
        const markers = ref([]);

        onMounted(() => {
            map.value = L.map("map").setView([13.1939, 121.0263], 10); // Center the map on Oriental Mindoro
            L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            ).addTo(map.value);

            // Create a marker cluster group
            const markerClusterGroup = L.markerClusterGroup();
            map.value.addLayer(markerClusterGroup);

            // Fetch livestock data from your CodeIgniter backend using Axios
            // axios
            //     .get("/admin/livestock-mapping-data")
            //     .then((response) => {
            //         const livestockData = response.data;
            //         plotLivestockData(livestockData, markerClusterGroup);
            //     })
            //     .catch((error) => {
            //         console.error("Error fetching livestock data:", error);
            //     });

            LivestockService.getLivestockMappingData().then((data) => {
                const livestockData = data;
                plotLivestockData(livestockData, markerClusterGroup);
            });
        });

        const plotLivestockData = (livestockData, markerClusterGroup) => {
            // Process livestock data and plot it on the map
            livestockData.forEach((data) => {
                const { lat, long, farmerUserId, livestocks } = data;

                // Create circle markers for each livestock type
                livestocks.forEach(({ livestockType, livestockCount }) => {
                    // Calculate the radius of the circle based on the livestock count
                    const radius = Math.sqrt(livestockCount) * 5;

                    // Define colors based on livestock type
                    // Define colors based on livestock type
                    const colors = {
                        Cow: "blue",
                        Pig: "pink",
                        Carabao: "purple",
                        Sheep: "green",
                        Goat: "brown",
                        Chicken: "yellow",
                        // Add more livestock types and corresponding colors here if needed
                    };

                    // Determine the color based on the livestock type
                    const color = colors[livestockType] || "black"; // Default to black if no matching color found

                    // Create a circle marker
                    const marker = L.circleMarker([parseFloat(lat), parseFloat(long)], {
                        radius: radius,
                        fillColor: color,
                        fillOpacity: 0.5,
                        color: color,
                    })
                    .bindPopup(
                        `<b>Location:</b> Latitude: ${lat}, Longitude: ${long}<br>
                         <b>Farmer User ID:</b> ${farmerUserId}<br>
                         <b>Livestock Type:</b> ${livestockType}<br>
                         <b>Livestock Count:</b> ${livestockCount}`
                    );

                    // Add the marker to the marker array
                    markers.value.push(marker);

                    // Add the marker to the marker cluster group
                    markerClusterGroup.addLayer(marker);
                });
            });
        };

        return { map };
    },
};

</script>
<style>
.map-container {
    height: 600px;
}

.geospatial-map-container {
    background: white;
    border: 1px solid rgb(209, 213, 219);
    border-radius: 8px;
    padding: 1rem;
}
#map {
    height: 100%;
}
</style>
