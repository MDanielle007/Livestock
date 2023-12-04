<template>
    <v-card class="pa-3">
      <div ref="RadialBar"></div>
    </v-card>
  </template>
  
  <script setup>
  import { onMounted, ref, defineProps, watch } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const props = defineProps(['chartData','chartTitle','height','seriesName']);
  const RadialBar = ref(null);
  
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

    let RadialBarChart = new ApexCharts(RadialBar.value, {
      series: props.chartData.data,
      chart: {
        height: props.height || 'auto',
        type: 'donut',
      },
      labels: props.chartData.labels,
      legend: {
        show: true,
        position: 'right',
        labels: {
          useSeriesColors: true,
        },
        formatter: function (seriesName, opts) {
          return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
        },
        itemMargin: {
          vertical: 3,
        },
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            legend: {
              show: true,
              position: 'bottom'
            },
            chart: {
                height: 350
            },
          },
        },
      ],
    });
  
    RadialBarChart.render();
  }
  </script>
  
 
  