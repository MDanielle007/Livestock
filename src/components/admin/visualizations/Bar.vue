<template>
  <v-card style="height: 420px;">
    <v-card-title>Annually Rate</v-card-title>
   <div id="chart" >
      <div ref="Bar"></div>
    </div> 
  </v-card>
    
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const Bar = ref(null);
  
  onMounted(() => {
    let BarChart = new ApexCharts(Bar.value, {
      series: [
        {
          name: 'Cattle',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
        },
        {
          name: 'Chicken',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
        },
        {
          name: 'Sheep',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
        },
        {
          name: 'Lamb',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
        },
      ],
      chart: {
        type: 'bar',
        height: 350,
        
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded',
          
          
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent'],
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
      },
      yaxis: {
        title: {
          text: '',
        },
      },
      fill: {
        opacity: 1,
      },
      colors:['#4269E2', '#2337C6', '#0604AB', '#021273'],
      tooltip: {
        y: {
          formatter: function (val) {
            return '$ ' + val + ' thousands';
          },
        },
      },
    });
  
    BarChart.render();
  });
  </script>
  
  <style>
  /* Your styles go here */
  </style>
  