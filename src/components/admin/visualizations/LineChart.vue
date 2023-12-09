<template>
    <div id="chart">
      <div ref="LineChart"></div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const LineChart = ref(null);
  
  onMounted(() => {
    const options = {
      series: [{
        name: "Desktops",
        data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
      }],
      chart: {
        height: 350,
        type: 'line',
        zoom: {
          enabled: false,
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        curve: 'straight',
      },
      title: {
        text: 'Product Trends by Month',
        align: 'left',
      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'],
          opacity: 0.5,
        },
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
      },
    };
  
    let LineBasicCHart = new ApexCharts(LineChart.value, options);
    LineBasicCHart.render();
  });
  </script>
  
  <style>
  /* Your styles go here */
  </style>
  