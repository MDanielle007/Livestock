<template>
    <div id="chart" >
      <div ref="RadialBar"></div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import ApexCharts from 'apexcharts';
  
  const RadialBar = ref(null);
  
  onMounted(() => {
    let RadialBarChart = new ApexCharts(RadialBar.value, {
      series: [76, 67, 61, 90, 80],
      chart: {
        height: 180,
        type: 'radialBar',
      },
      plotOptions: {
        radialBar: {
          offsetY: 0,
          startAngle: 0,
          endAngle: 270,
          hollow: {
            margin: 5,
            size: '30%',
            background: 'transparent',
            image: undefined,
          },
          dataLabels: {
            name: {
              show: false,
            },
            value: {
              show: false,
            },
          },
        },
      },
      colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5', '#0077B5'],
      labels: ['chicks', 'pullets', 'hens', 'cockerel', 'rosster'],
      legend: {
        show: true,
        floating: true,
        fontSize: '8px',
        position: 'right',
        offsetX: 200,
        offsetY: 3,
        labels: {
          useSeriesColors: true,
        },
        markers: {
          size: 0,
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
              show: false,
            },
          },
        },
      ],
    });
  
    RadialBarChart.render();
  });
  </script>
  
 
  