<template>
    <div class="p-2">
        <div class="bg-white border-1 border-300 border-round-lg p-3 mb-0">
            <div>
                <Chart
                    type="bar"
                    :data="chartData"
                    :options="chartOptions"
                    class="h-20rem"
                />
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        labels: Array,
        datasets: Array,
        chartDataProp: Object,
    },
    data() {
        return {
            chartOptions: null,
        };
    },
    computed: {
        chartData() {
            return this.setChartData();
        }
    },
    mounted() {
        this.chartOptions = this.setChartOptions();
    },
    methods: {
        async setChartData() {
            const documentStyle = getComputedStyle(document.documentElement);

            return {
                labels: this.labels,
                datasets: this.datasets.map(category => ({
                    label: category,
                    backgroundColor: this.getRandomColor(),
                    borderColor: this.getRandomColor(),
                    data: this.labels.map(() => randomData())
                }))
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
        getRandomColor() {
            // Generate random color for chart elements
            return `rgb(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255})`;
        },
    },
};
</script>
