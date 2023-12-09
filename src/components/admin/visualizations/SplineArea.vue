<template>
    <div id="chart">
      <div ref="SplineArea"></div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const SplineArea = ref(null);
  
  onMounted(() => {
    let SplineChart = new ApexCharts(SplineArea.value, {
      series: [
        {
          name: 'Population Rate',
          data: [31, 40, 28, 51, 42, 109, 100],
        },
        {
          name: 'Mortality Rate',
          data: [11, 32, 45, 32, 34, 52, 41],
        },
      ],
      chart: {
        height: '350',
      },
      title: {
          text: 'Dynamic Updating Chart',
          align: 'left'
        },
      dataLabels: {
        enabled: false,
      },
      colors:['#EB8C00', '#142195'],
      fill: {
      colors: ['', '']
      },
      stroke: {
        curve: 'smooth',
      },
      xaxis: {
        type: 'datetime',
        categories: [
          '2018-09-19T00:00:00.000Z',
          '2018-09-19T01:30:00.000Z',
          '2018-09-19T02:30:00.000Z',
          '2018-09-19T03:30:00.000Z',
          '2018-09-19T04:30:00.000Z',
          '2018-09-19T05:30:00.000Z',
          '2018-09-19T06:30:00.000Z',
        ],
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm',
        },
      },
    });
  
    SplineChart.render();
  });
  </script>