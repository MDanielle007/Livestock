<template>
    <div class="max-w-screen">
        <div class="flex flex-column gap-3">
            <div class="grid no-gridgutters">
                <div class="col-4 lg:col-3" v-for="livestock in livestocks">
                    <LivestockCard
                        :cardSubtitle="livestock.livestockType"
                        :cardTitle="livestock.livestockAgeClass"
                        :cardContent="livestock.livestockCount"
                    />
                </div>
                <div class="col">
                    <LivestockCard
                        :cardTitle="'Total Livestocks'"
                        :cardContent="`${16} Livestocks`"
                        :contentHeight="'6.4rem'"
                    />
                </div>
                <div class="col-12 lg:col-6">
                    <LivestockPopulationBarChart />
                </div>
                <div class="col-12 lg:col-6">
                    <LivestockTypePopulationDoughnutChart/>
                </div>
            </div>
            
        </div>
    </div>
</template>
<script>
import LivestockCard from "@/components/farmer/LivestockCard.vue";
import LivestockPopulationBarChart from "@/components/general/charts/LivestockPopulationBarChart.vue";
import LivestockTypePopulationDoughnutChart from "@/components/general/charts/LivestockTypePopulationDoughnutChart.vue";

export default {
    data() {
        return {
            livestocks: [
                {
                    livestockType: "Pig",
                    livestockAgeClass: "Piglet",
                    livestockCount: "7",
                },
                {
                    livestockType: "Cattle",
                    livestockAgeClass: "Calf",
                    livestockCount: "5",
                },
                {
                    livestockType: "Goat",
                    livestockAgeClass: "Kid",
                    livestockCount: "2",
                },
                {
                    livestockType: "Carabao",
                    livestockAgeClass: "Calf",
                    livestockCount: "2",
                },
            ],
        };
    },
    components: {
        LivestockCard,
        LivestockPopulationBarChart,
		LivestockTypePopulationDoughnutChart
    },
};
</script>
<style></style>
