<template>
    <div>
        <div class="grid">
            <div class="grid col-12 md:col-6">
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Total Vaccinations'"
                        :value="totalVaccinationsAdministered.value"
                        :backgroundColor="'white'"
                        :additionalInfo="totalVaccinationsAdministered.additionalInfo"
                        :additionalText="'Total vaccinations administered'"
                        :valueSize="'text-2xl'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Vaccination Coverage'"
                        :value="vaccinationCoverage.value"
                        :backgroundColor="'white'"
                        :additionalInfo="vaccinationCoverage.additionalInfo"
                        :additionalText="'of livestock vaccinated'"
                        :valueSize="'text-2xl'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Vaccination Trends'"
                        :value="vaccinationTrends"
                        :backgroundColor="'white'"
                    />
                </div>
                <div class="col-12 md:col-6">
                    <AdminMetricCard
                        :title="'Top Vaccines Used'"
                        :value="topVaccinesUsed"
                        :backgroundColor="'white'"
                    />
                </div>
            </div>
            <div class="col-12 lg:col-6">
                <LivestockLineChart :title="'Livestock Vaccinations'" :chartHeight="'h-14rem'" />
            </div>
            <div class="col-12">
                <LivestockVaccinationManagementDataTable/>
            </div>
        </div>
    </div>
</template>
<script>
import LivestockLineChart from "@/components/general/charts/LivestockLineChart.vue";
import AdminMetricCard from "@/components/admin/AdminMetricCard.vue";
import LivestockVaccinationManagementDataTable from "@/components/general/datatables/LivestockVaccinationManagementDataTable.vue"

export default {
    data() {
        return {
            totalVaccinationsAdministered: {
                value: "300",
                additionalInfo: "",
            },
            vaccinationCoverage: {
                value: "300",
                additionalInfo: "80%",
            },
            vaccinationTrends: [
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
            topVaccinesUsed: [
                {
                    name: "Vax 1",
                    value: "100",
                },
                {
                    name: "Vax 2",
                    value: "50",
                },
                {
                    name: "Vax 3",
                    value: "20",
                },
            ],
        };
    },
    components: {
        AdminMetricCard,
        LivestockLineChart,
        LivestockVaccinationManagementDataTable
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
