<template>
    <v-card class="pa-3">
        <div ref="chartEl"></div>
    </v-card>
</template>
    
<script setup>
import { onMounted, ref, defineProps, watch } from 'vue';
import ApexCharts from 'apexcharts';

const props = defineProps(['chartData', 'chartTitle', 'height', 'seriesName', 'seriesColors']);
const chartEl = ref(null);

onMounted(() => {
    renderChart();
});

watch(() => props.chartData, () => {
    renderChart();
});

const renderChart = () => {
    if (!props.chartData) {
        console.error('Invalid chart data:', props.chartData);
        return;
    }

    let chart = new ApexCharts(chartEl.value, {
        series: [
            {
                name: props.seriesName,
                data: props.chartData.data,
            },
        ],
        title: {
            text: props.chartTitle,
            align: 'left'
        },
        colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A', '#26a69a', '#D10CE8'],
        legend: {
            show: false,
            showForSingleSeries: true,
            showForNullSeries: true,
            showForZeroSeries: true,
            position: 'bottom',
            onItemClick: {
                toggleDataSeries: true
            },
            onItemHover: {
                highlightDataSeries: true
            },
            position: 'bottom',
        },
        chart: {
            height: props.height,
            type: 'bar',
            toolbar: {
                show: true,
            },
        },
        plotOptions: {
            bar: {
                columnWidth: '45%',
                distributed: true,
            },
        },
        grid: {
            show: false,
            padding: {
                left: 0,
                right: 0,
            },
        },
        dataLabels: {
            enabled: false,
        },
        xaxis: {
            categories: props.chartData.labels,
            labels: {
                style: {
                    colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A', '#26a69a', '#D10CE8'],
                },
            },
        },
    });

    chart.render();
};
</script>
    