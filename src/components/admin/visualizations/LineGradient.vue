<template>
    <div id="chart">
      <div ref="LineGradient"></div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref, defineProps } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const props = defineProps(['chartHeight']); // Introduce a prop for chart height
  const LineGradient = ref(null);
  
  onMounted(() => {
    // Chart data
    const seriesData = [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5];
  
    // Chart options
    const options = {
      series: [{
        name: 'Sales',
        data: seriesData,
      }],
      chart: {
        height: 'auto', // Use the prop value or default to 350
        type: 'line',
      },
      stroke: {
        width: 5,
        curve: 'smooth',
      },
      xaxis: {
        type: 'datetime',
        categories: [
          '1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000',
          '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000',
          '1/11/2001', '2/11/2001', '3/11/2001', '4/11/2001', '5/11/2001', '6/11/2001'
        ],
        labels: {
          show: false, // Hide x-axis labels
        },
      },
      grid: {
        show: false, // Hide grid lines
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          gradientToColors: ['#FDD835'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100, 100, 100],
        },
      },
      yaxis: {
        show: false, // Hide y-axis labels and lines
        min: -10,
        max: 40,
      },
      tooltip: {
        enabled: false, // Hide tooltip
      },
      dataLabels: {
        enabled: false, // Hide data labels
      },
      toolbar: {
        show: false, // Hide toolbar options
      },
      zoom: {
        enabled: false, // Disable zooming
      },
    };
  
    // Initialize and render the chart
    let GradientChart = new ApexCharts(LineGradient.value, options);
    GradientChart.render();
  });
  </script>
  
  <style>
  /* Your styles go here */
  </style>
  