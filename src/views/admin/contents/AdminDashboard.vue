<template>
    <div>
        <div class="grid">
            <div v-for="item in metricsData" class="col-12 md:col-6 xl:col-3">
                <AdminMetricCard
                    :title="item.title"
                    :value="item.value"
                    :backgroundColor="'white'"
                    :additionalInfo="item.additionalInfo"
                    :additionalText="item.additionalText"
                />
            </div>
        </div>
        <div class="grid">
            <LivestockDistributionChart
                :labels="livestockDistributionData.livestockTypes"
                :datasets="livestockDistributionData.ageCategories"
                :chartDataProp="livestockDistributionData.livestockData"
                class="col-8"
            />
        </div>
    </div>
</template>
<script>
import AdminMetricCard from "@/components/admin/AdminMetricCard.vue";

export default {
    data() {
        return {
            metricsData: [
                {
                    title: "Total Livestock Count",
                    value: "150",
                    backgroundColor: "white",
                    additionalInfo: "100% ",
                    additionalText: "livestocks currently monitored",
                },
                {
                    title: "Farmers/Care Taker Count",
                    value: "20",
                    backgroundColor: "white",
                    additionalInfo: "25% ",
                    additionalText: "increase in registered farmers",
                },
                {
                    title: "Vaccination Status",
                    value: "120",
                    backgroundColor: "white",
                    additionalInfo: "80% ",
                    additionalText: "of livestock vaccinated",
                },
                {
                    title: "Breeding Eligibility",
                    value: "70",
                    backgroundColor: "white",
                    additionalInfo: "45% ",
                    additionalText: "livestock eligible for breeding",
                },
                {
                    title: "Mortality Rate",
                    value: "5",
                    backgroundColor: "white",
                    additionalInfo: "3% ",
                    additionalText: "mortality rate in the last month",
                },
            ],
            livestockDistributionData: {
                livestockTypes: ["Cattle", "Poultry", "Swine"],
                ageCategories: ["Young", "Adult", "Elderly"],
                livestockData: {
                    Cattle: {
                        Young: [25, 35, 40], // Random data for cattle of different age categories
                        Adult: [30, 45, 50],
                        Elderly: [20, 30, 25],
                    },
                    Poultry: {
                        Young: [45, 55, 60], // Random data for poultry of different age categories
                        Adult: [50, 60, 65],
                        Elderly: [35, 40, 45],
                    },
                    Swine: {
                        Young: [30, 40, 45], // Random data for swine of different age categories
                        Adult: [35, 45, 50],
                        Elderly: [25, 30, 35],
                    },
                },
            },
        };
    },
    components: {
        AdminMetricCard,
    },
};
</script>
<style></style>
