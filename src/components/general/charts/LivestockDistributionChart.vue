<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center"
    >
        <div class="text-700 text-2xl font-bold">{{ title }}</div>

        <div>
            <Chart
                type="bar"
                :data="chartData"
                :options="chartOptions"
                :class="[chartHeight || 'h-20rem']"
            />
        </div>
    </div>
</template>

<script>
export default {
    props:{
        title:{
            type:String,
            required:true
        },
        chartHeight:String
    },
    data() {
        return {
            chartData: null,
            chartOptions: null,
        };
    },
    mounted() {
        this.chartData = this.setChartData();
        this.chartOptions = this.setChartOptions();
    },
    methods: {
        setChartData() {
            const documentStyle = getComputedStyle(document.documentElement);

            return {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                ],
                datasets: [
                    {
                        label: "My First dataset",
                        backgroundColor:
                            documentStyle.getPropertyValue("--cyan-500"),
                        borderColor:
                            documentStyle.getPropertyValue("--cyan-500"),
                        data: [65, 59, 80, 81, 56, 55, 40],
                    },
                    {
                        label: "My Second dataset",
                        backgroundColor:
                            documentStyle.getPropertyValue("--gray-500"),
                        borderColor:
                            documentStyle.getPropertyValue("--gray-500"),
                        data: [28, 48, 40, 19, 86, 27, 90],
                    },
                ],
            };
        },
        setChartOptions() {
            const documentStyle = getComputedStyle(document.documentElement);
            const textColor = documentStyle.getPropertyValue("--text-color");
            const textColorSecondary = documentStyle.getPropertyValue(
                "--text-color-secondary"
            );
            const surfaceBorder =
                documentStyle.getPropertyValue("--surface-border");

            return {
                maintainAspectRatio: false,
                aspectRatio: 0.8,
                plugins: {
                    legend: {
                        labels: {
                            color: textColor,
                        },
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            color: textColorSecondary,
                            font: {
                                weight: 500,
                            },
                        },
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                    },
                    y: {
                        ticks: {
                            color: textColorSecondary,
                        },
                        grid: {
                            color: surfaceBorder,
                            drawBorder: false,
                        },
                    },
                },
            };
        },
    },
};
</script>
