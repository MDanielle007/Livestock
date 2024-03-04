<template>
    <div>
        <div class="grid">
            <div class="grid col-12 md:col-6">
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Total Deaths'"
                        :value="totalLivestockDeaths.value"
                        :backgroundColor="'white'"
                        :additionalInfo="totalLivestockDeaths.additionalInfo"
                        :additionalInfoColor="'text-orange-500'"
                        :additionalText="'of livestocks have died'"
                        :valueSize="'text-2xl'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Mortality Distribution'"
                        :value="mortalityDistribution.value"
                        :backgroundColor="'white'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Mortality Trends'"
                        :value="mortalityTrends"
                        :backgroundColor="'white'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Top Mortality Causes'"
                        :value="topMortalityCauses"
                        :backgroundColor="'white'"
                    />
                </div>
            </div>
            <div class="col-12 lg:col-6">
                <LivestockBarChart :title="'Livestock Mortality'" :chartHeight="'h-14rem'" />
            </div>
            <div class="col-12">
                <LivestockMortalityManagementDataTable/>
            </div>
        </div>
    </div>
</template>
<script>
import LivestockBarChart from "@/components/general/charts/LivestockBarChart.vue";
import AdminMetricCard from "@/components/admin/AdminMetricCard.vue";
import LivestockMortalityManagementDataTable from "@/components/general/datatables/LivestockMortalityManagementDataTable.vue";

export default {
    data() {
        return {
            totalLivestockDeaths: {
                value: "300",
                additionalInfo: "10%",
            },
            mortalityDistribution: {
                value: [
                    {
                        name: "Carabao",
                        value: 15,
                    },
                    {
                        name: "Chicken",
                        value: 10,
                    },
                    {
                        name: "Carabao",
                        value: 5,
                    },
                ]
            },
            mortalityTrends: [
                {
                    name: "Jan",
                    value: "50",
                },
                {
                    name: "Feb",
                    value: "30",
                },
                {
                    name: "March",
                    value: "20",
                },
                {
                    name: "April",
                    value: "10",
                },
            ],
            topMortalityCauses: [
                {
                    name: "disease 1",
                    value: "100",
                },
                {
                    name: "disease 2",
                    value: "50",
                },
                {
                    name: "disease 3",
                    value: "20",
                },
            ],
        };
    },
    components: {
        AdminMetricCard,
        LivestockBarChart,
        LivestockMortalityManagementDataTable
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
