<template>
    <div>
        <div class="grid">
            <div class="grid col-12 md:col-6">
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Total Breedings'"
                        :value="totalLivestockBreedings.value"
                        :backgroundColor="'white'"
                        :additionalInfo="totalLivestockBreedings.additionalInfo"
                        :additionalText="totalLivestockBreedings.additionalText"
                        :valueSize="'text-2xl'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Pregnancy Coverage'"
                        :value="livestockPregnancy.value"
                        :backgroundColor="'white'"
                        :additionalInfo="livestockPregnancy.additionalInfo"
                        :additionalText="livestockPregnancy.additionalText"
                        :valueSize="'text-2xl'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Breeding Trends'"
                        :value="livestockBreedingTrends"
                        :backgroundColor="'white'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Breeding Distribution'"
                        :value="livestockBreedingDistribution"
                        :backgroundColor="'white'"
                    />
                </div>
            </div>
            <div class="col-12 lg:col-6">
                <LivestockLineChart
                    :title="'Livestock Successful Breeding'"
                    :chartHeight="'h-14rem'"
                />
            </div>
            <div class="col-12">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
import AdminMetricCard from "@/components/admin/AdminMetricCard.vue";
import LivestockLineChart from "@/components/general/charts/LivestockLineChart.vue";

export default {
    components: {
        AdminMetricCard,
        LivestockLineChart,
    },
    data() {
        return {
            totalLivestockBreedings: {
                value: "300",
                additionalInfo: "80%",
                additionalText: "successful livestock breeding",
            },
            livestockBreedingTrends: [
                {
                    name: "Jan",
                    value: "20",
                },
                {
                    name: "Feb",
                    value: "50",
                },
                {
                    name: "March",
                    value: "70",
                },
            ],
            livestockPregnancy: {
                value: "300",
                additionalInfo: "80%",
                additionalText: "successful pregnancy",
            },
            livestockBreedingDistribution: [
                {
                    name: "Cattle",
                    value: "20",
                },
                {
                    name: "Pig",
                    value: "15",
                },
                {
                    name: "Carabao",
                    value: "10",
                },
            ],
        };
    },
};
</script>
<style></style>
