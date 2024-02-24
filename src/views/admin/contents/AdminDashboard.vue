<template>
    <div>
        <div class="grid">
            <div
                v-for="item in livestockMetricData"
                class="col-12 md:col-6 xl:col-3"
            >
                <AdminMetricCard
                    :title="item.title"
                    :value="item.value"
                    :backgroundColor="'white'"
                    :additionalInfo="item.additionalInfo"
                    :additionalText="item.additionalText"
                    :valueSize="'text-2xl'"
                />
            </div>
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
                    :title="farmerTotalCount.title"
                    :value="farmerTotalCount.value"
                    :backgroundColor="'white'"
                    :additionalInfo="farmerTotalCount.additionalInfo"
                    :additionalText="farmerTotalCount.additionalText"
                    :valueSize="'text-2xl'"
                />
            </div>
            <div class="col-12 lg:col-8">
                <!-- livestock distribution chart by livestock type -->
                <LivestockDistributionChart :title="'Livestock Distribution'"/>
            </div>
            <div class="col-12 lg:col-4">
                <!-- livestock doughnut chart by livestock type -->
                <LivestockDoughnutChart :title="'Livestock Types'" />
            </div>
            <div class="col-12 lg:col-4">
                <!-- top 10 vaccine used and the count of the livestock vaccinated by it -->
                <LivestockMetricsRankingDataTable
                    :title="'Top Vaccines'"
                    :label="'Vaccines'"
                    :value="'Livestocks'"
                    :items="topVaccinations"
                />
            </div>
            <div class="col-12 lg:col-8">
                <!-- livestock vaccination trends line chart -->
                <LivestockLineChart :title="'Livestock Vaccinations'" />
            </div>
            <div class="col-12 lg:col-6">
                <!-- livestock successful breeding trends line chart -->
                <LivestockLineChart :title="'Livestock Successful Breeding'"/>
            </div>
            <div class="col-12 lg:col-6">
                <!-- livestock egg production trend over time line chart -->
                <LivestockLineChart :title="'Egg Prodution'" />
            </div>
            <div class="col-12 lg:col-4">
                <!-- top 10 cause of livestock mortality and number of livestock dead by the cause -->
                <LivestockMetricsRankingDataTable
                    :title="'Top Causes of Death'"
                    :label="'Causes'"
                    :value="'Livestocks'"
                    :items="topCausesOfLivestockMortality"
                />
            </div>
            <div class="col-12 lg:col-8">
                <!-- livestock mortality rate over time -->
                <LivestockBarChart :title="'Livestock Mortality'" />
            </div>
        </div>
    </div>
</template>
<script>
import AdminMetricCard from "@/components/admin/AdminMetricCard.vue";
import LivestockBarChart from "@/components/general/charts/LivestockBarChart.vue";
import LivestockDistributionChart from "@/components/general/charts/LivestockDistributionChart.vue";
import LivestockDoughnutChart from "@/components/general/charts/LivestockDoughnutChart.vue";
import LivestockLineChart from "@/components/general/charts/LivestockLineChart.vue";
import LivestockMetricsRankingDataTable from "@/components/general/datatables/LivestockMetricsRankingDataTable.vue";

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
            farmerTotalCount: {
                title: "Farmers/Care Taker Count",
                value: "20",
                backgroundColor: "white",
                additionalInfo: "25% ",
                additionalText: "increase in registered farmers",
            },
            livestockMetricData: {
                vaccinationMetricData: {
                    title: "Vaccination Status",
                    value: "120",
                    backgroundColor: "white",
                    additionalInfo: "80% ",
                    additionalText: "of livestock vaccinated",
                },
                breedingMetricData: {
                    title: "Breeding Eligibility",
                    value: "70",
                    backgroundColor: "white",
                    additionalInfo: "45% ",
                    additionalText: "livestock eligible for breeding",
                },
                eggProdMetricData: {
                    title: "Egg Production",
                    value: "250",
                    backgroundColor: "white",
                    additionalInfo: "500% ",
                    additionalText: "increase in egg production",
                },
                mortalityMetricData: {
                    title: "Mortality Rate",
                    value: "5",
                    backgroundColor: "white",
                    additionalInfo: "3% ",
                    additionalText: "mortality rate in the last month",
                },
            },
            topVaccinations: [
                {
                    name: "Vax 1",
                    value: "16",
                },
                {
                    name: "Vax 2",
                    value: "12",
                },
                {
                    name: "Vax 3",
                    value: "8",
                },
                {
                    name: "Vax 4",
                    value: "4",
                },
                {
                    name: "Vax 5",
                    value: "2",
                },
            ],
            topCausesOfLivestockMortality: [
                {
                    name: "Disease 1",
                    value: "25",
                },
                {
                    name: "Disease 2",
                    value: "20",
                },
                {
                    name: "Accidents",
                    value: "15",
                },
                {
                    name: "Predation",
                    value: "10",
                },
                {
                    name: "Malnutrition",
                    value: "8",
                },
                {
                    name: "Weather-related",
                    value: "6",
                },
                {
                    name: "Reproductive issues",
                    value: "5",
                },
                {
                    name: "Poisoning",
                    value: "4",
                },
                {
                    name: "Stress",
                    value: "4",
                },
                {
                    name: "Other",
                    value: "3",
                },
            ],
        };
    },
    components: {
        AdminMetricCard,
        LivestockBarChart,
        LivestockDistributionChart,
        LivestockDoughnutChart,
        LivestockMetricsRankingDataTable,
        LivestockLineChart,
    },
};
</script>
<style></style>
