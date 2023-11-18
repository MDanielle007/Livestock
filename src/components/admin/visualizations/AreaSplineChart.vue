<template>
    <div id="chart">
        <div ref="salesChartEl"></div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import ApexCharts from 'apexcharts';

const salesChartEl = ref(null)

onMounted(() => {
    let salesChart = new ApexCharts(salesChartEl.value, {
        series: [
            {
                name: 'series1',
                data: [31, 40, 28, 51, 42, 109, 100],
            },
        ],
        legend: {
            position: 'bottom',
        },
        chart: {
            height:'auto',
            type: 'area',
            toolbar: {
                show: true,
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
        stroke: {
            curve: 'smooth',
        },
        xaxis: {
            type: 'datetime',
            categories: [
                "2018-09-19T00:00:00.000Z",
                "2018-09-19T01:30:00.000Z",
                "2018-09-19T02:30:00.000Z",
                "2018-09-19T03:30:00.000Z",
                "2018-09-19T04:30:00.000Z",
                "2018-09-19T05:30:00.000Z",
                "2018-09-19T06:30:00.000Z",
            ],
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm',
            },
        },
    })

    salesChart.render()
    

})

</script>

<style>
/* Your styles go here */
</style>