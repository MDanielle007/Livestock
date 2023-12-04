<template>
  <v-card class="pa-3">
    <div ref="chartEl"></div>
  </v-card>
</template>
  
  <script setup>
  import { onMounted, ref, defineProps, watch } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const props = defineProps(['chartData','chartTitle','height','seriesName']);
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
      legend: {
        show: true,
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
        categories: props.chartData.labels,
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy',
        },
      },
    });
  
    chart.render();
  };
  </script>
  