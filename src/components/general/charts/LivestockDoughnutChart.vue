<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <div class="text-700 text-2xl font-bold">{{ title }}</div>

        <div>
            <Chart
                type="doughnut"
                :data="chartData"
                :options="chartOptions"
                class="h-20rem"
            />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            chartData: null,
            chartOptions: {
                cutout: "60%",
            },
        };
    },
    mounted() {
        this.chartData = this.setChartData();
        this.chartOptions = this.setChartOptions();
    },
    methods: {
        setChartData() {
            const documentStyle = getComputedStyle(document.body);

            return {
                labels: ["Pig", "Goat", "Carabao", "Cattle"],
                datasets: [
                    {
                        data: [7, 2, 2, 5],
                        backgroundColor: [
                            "#008FFB",
                            "#00E396",
                            "#FEB019",
                            "#FF4560",
                            "#775DD0",
                            "#546E7A",
                            "#26a69a",
                            "#D10CE8",
                        ],
                        hoverBackgroundColor: [
                            "#008FFB",
                            "#00E396",
                            "#FEB019",
                            "#FF4560",
                            "#775DD0",
                            "#546E7A",
                            "#26a69a",
                            "#D10CE8",
                        ],
                    },
                ],
            };
        },
        setChartOptions() {
            const documentStyle = getComputedStyle(document.documentElement);
            const textColor = documentStyle.getPropertyValue("--text-color");

            return {
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                            cutout: "60%",
                            color: textColor,
                        },
                    },
                },
            };
        },
    },
};
</script>
