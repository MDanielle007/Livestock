<template>
    <v-card class="pa-3">
        <div ref="Column"></div>
    </v-card>
</template>

<script setup>
import { onMounted, ref, defineProps, watch} from 'vue';
import ApexCharts from 'apexcharts';

const props = defineProps(['chartData','chartTitle','height','seriesName'])
const Column = ref(null);

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

    let columnChart = new ApexCharts(Column.value, {
      series: [
        {
          name: props.seriesName || 'series1',
          data: props.chartData.data,
        },
      ],
      chart: {
        height: props.height || 'auto',
        type: 'bar',
      },
      fill: {
        colors: ['#142195', '#E91E63', '#9C27B0']
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: 'top', // top, center, bottom
          },
        },
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val + "%";
        },
        offsetY: -20,
        style: {
          fontSize: '10px',
          colors: ["#142195"],
        },
      },
      xaxis: {
        type: 'datetime',
        categories: props.chartData.labels,
        position: 'bottom',
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
        crosshairs: {
          fill: {
            type: 'gradient',
            gradient: {
              colorFrom: '#142195',
              colorTo: '#142195',
              stops: [0, 100],
              opacityFrom: 0.4,
              opacityTo: 0.5,
            },
          },
        },
        tooltip: {
          enabled: true,
        },
      },
      yaxis: {
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
        labels: {
          show: false,
          formatter: function (val) {
            return val + "%";
          },
        },
      },
      title: {
        text: props.chartTitle,
        floating: true,
        offsetY: 230,
        align: 'center',
        style: {
          color: '#142195',
        },
      },
    });
  
    columnChart.render();
  }

</script>

