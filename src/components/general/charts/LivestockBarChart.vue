
<template>
    <div class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center">
        <div class="text-700 text-2xl font-bold">{{title}}</div>
        <div>
            <Chart type="bar" :data="chartData" :options="chartOptions" class="w-full" :class="[chartHeight || 'h-20rem']" />
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
            chartOptions: null
        };
    },
    mounted() {
        this.chartData = this.setChartData();
        this.chartOptions = this.setChartOptions();
    },
    methods: {
        setChartData() {
            return {
                labels: ['Pig', 'Goat', 'Carabao', 'Cattle'],
                datasets: [
                    {
                        label: 'Livestocks',
                        data: [7, 2, 2, 5],
                        backgroundColor: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A', '#26a69a', '#D10CE8'],
                        // '#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A', '#26a69a', '#D10CE8'
                        borderColor: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A', '#26a69a', '#D10CE8'],
                        borderWidth: 1
                    }
                ]
            };
        },
        setChartOptions() {
            const documentStyle = getComputedStyle(document.documentElement);
            const textColor = documentStyle.getPropertyValue('--text-color');
            const textColorSecondary = documentStyle.getPropertyValue('--text-color-secondary');
            const surfaceBorder = documentStyle.getPropertyValue('--surface-border');

            return {
                maintainAspectRatio: false,
                aspectRatio: 0.8,
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                            color: textColor
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: textColorSecondary
                        },
                        grid: {
                            color: surfaceBorder
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: textColorSecondary
                        },
                        grid: {
                            color: surfaceBorder
                        }
                    }
                }
            };
        }
    }
};
</script>
