<template>
    <v-card class="pa-3">
      <div ref="Pie"></div>
    </v-card>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const Pie = ref(null);
  
  onMounted(() => {
    let PieChart = new ApexCharts(Pie.value, {
      series: [44, 55, 13, 43],
      chart: {
       
        type: 'pie',
        height: '370'
        
      },
      labels: ['Chicken', 'Cattle', 'Sheep', 'Lamb'],
      legend: {
        show: true,
        position: 'bottom',
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
            chart: {
              height: 350,
              
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
  