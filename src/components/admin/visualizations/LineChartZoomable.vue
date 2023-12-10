<template>
    <div id="chart">
      <div ref="LineChartZoomable"></div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const LineChartZoomable = ref(null);
  
  onMounted(() => {
    const dates = [/* Your date values here */]; // Add your date values here
  
    const options = {
      series: [{
        name: 'XYZ MOTORS',
        data: dates,
      }],
      chart: {
        type: 'area',
        stacked: false,
        height: 250,
        zoom: {
          type: 'x',
          enabled: true,
          autoScaleYaxis: true,
        },
        toolbar: {
          autoSelected: 'zoom',
        },
        animations: {
          enabled: false, // Disable animations for smoother initialization
        },
      },
      dataLabels: {
        enabled: false,
      },
      markers: {
        size: 0,
      },
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 1,
          inverseColors: false,
          opacityFrom: 0.5,
          opacityTo: 0,
          stops: [0, 90, 100],
        },
      },
      yaxis: {
        show: false, // Hide y-axis
        labels: {
          formatter: function (val) {
            return (val / 1000000).toFixed(0);
          },
        },
        title: {
          text: 'Price',
        },
      },
      xaxis: {
        type: 'datetime',
        axisBorder: {
          show: false, // Hide x-axis border
        },
      },
      tooltip: {
        shared: false,
        y: {
          formatter: function (val) {
            return (val / 1000000).toFixed(0);
          },
        },
      },
    };
  
    let ZoomableChart = new ApexCharts(LineChartZoomable.value, options);
    ZoomableChart.render();
  });
  </script>
  
  <style>
  /* Your styles go here */
  </style>
  