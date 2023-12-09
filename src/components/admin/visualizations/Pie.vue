<template>
    <div id="chart">
      <div ref="Pie"></div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const Pie = ref(null);
  
  onMounted(() => {
    let PieChart = new ApexCharts(Pie.value, {
      series: [44, 55, 13, 43],
      chart: {
        width: 360,
        type: 'pie',
        
      },
      labels: ['Chicken', 'Cattle', 'Sheep', 'Lamb'],
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200,
            },
            legend: {
              position: 'bottom',
            },
          },
        },
      ],
      colors:['#F17720', '#FFA630', '#00A7E1', '#0474BA']
    });
  
    PieChart.render();
  });
  </script>
  
  <style>
  /* Your styles go here */
  </style>
  