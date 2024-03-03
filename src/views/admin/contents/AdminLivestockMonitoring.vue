<template>
    <div>
        <div class="grid">
            <div class="grid col-12 md:col-6">
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="totalLivestockCount.title"
                        :value="totalLivestockCount.value"
                        :backgroundColor="'white'"
                        :additionalInfo="totalLivestockCount.additionalInfo"
                        :additionalText="totalLivestockCount.additionalText"
                        :valueSize="'text-2xl'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Livestock Distribution'"
                        :value="livestockTypeDistribution"
                        :backgroundColor="'white'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Livestock Age Distribution'"
                        :value="livestockAgeDistribution"
                        :backgroundColor="'white'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Health Status Overview'"
                        :value="livestockHealthStatusOverview"
                        :backgroundColor="'white'"
                    />
                </div>
            </div>
            <div class="col-12 lg:col-6">
                <!-- livestock distribution chart by livestock type -->
                <LivestockDistributionChart :title="'Livestock Distribution'" :chartHeight="'h-14rem'"/>
            </div>
            <div class="col-12">
                <router-view></router-view>
            </div>
            <div class="col-12">
                <LivestockGeospatialMapping/>
            </div>
        </div>
    </div>
</template>
<script>
import LivestockDistributionChart from "@/components/general/charts/LivestockDistributionChart.vue";
import LivestockGeospatialMapping from "@/components/admin/LivestockGeospatialMapping.vue";
import AdminMetricCard from "@/components/admin/AdminMetricCard.vue";

export default {
    data() {
        return {
            totalLivestockCount: {
                title: "Total Livestock Count",
                value: "150",
                backgroundColor: "white",
                additionalInfo: "100% ",
                additionalText: "livestocks currently monitored",
            },
            livestockTypeDistribution: [
                {
                    name: "Cattle",
                    value: "50",
                },
                {
                    name: "Sheep",
                    value: "30",
                },
                {
                    name: "Chicken",
                    value: "20",
                },
                {
                    name: "Cattle",
                    value: "50",
                },
            ],
            livestockAgeDistribution: [
                {
                    name: "Rooster",
                    value: "50",
                },
                {
                    name: "Hen",
                    value: "30",
                },
                {
                    name: "Cow",
                    value: "20",
                },
                {
                    name: "Boar",
                    value: "50",
                },
            ],
            livestockHealthStatusOverview: [
                {
                    name: "Healthy",
                    value: "50",
                },
                {
                    name: "Sick",
                    value: "30",
                },
                {
                    name: "Deceased",
                    value: "20",
                },
            ],
        };
    },
    components: {
        LivestockGeospatialMapping,
        AdminMetricCard,
        LivestockDistributionChart
    },
    methods: {
        formattedValue(value) {
            if (typeof value === "string") {
                return value; // Return the value as is if it's a string
            } else if (Array.isArray(value)) {
                // If it's an array, concatenate the values of objects within the array
                return value
                    .map((item) => `${item.name}: ${item.value}`)
                    .join(", ");
            } else {
                return ""; // Return an empty string for unsupported types
            }
        },
    },
};
</script>
<style></style>
