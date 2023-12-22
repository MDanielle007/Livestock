<template>
  <v-card style="height: 525px;">
    <v-row no-gutters>
            <v-col class="mt-3 ml-2">
              <v-card-title class="text-h4 font-weight-bold">Annually Rate</v-card-title>
            </v-col>
            <v-col cols="4" class="d-flex justify-end ma-5">
                  <v-select
                  v-model="select"
                  :hint="`${select.state}, ${select.abbr}`"
                  :items="items"
                  item-title="state"
                  item-value="abbr"
                  label="Select"
                  return-object
                  single-line
                ></v-select>
          </v-col>
      <v-col >
        <div ref="SplineArea"></div>
      </v-col>  
      
      <div class="mr-10 mt-5">
        <v-col>
          <v-sheet >
            <div class="d-flex">
               <i class="fa-solid fa-circle mt-2 ml-2 mr-2" style="font-size: 6px;"></i>
               <v-card-subtitle class="text-subtitle-2 pa-0 ma-0">Livestock this month</v-card-subtitle>
            </div>
             <v-card-title class="text-h4 ml-2" >233</v-card-title>
           </v-sheet>
           
          <v-sheet class="mr-2 mt-10" >
            <div class="d-flex">
               <i class="fa-solid fa-circle mt-2 ml-2 mr-2" style="font-size: 6px;"></i>
               <v-card-subtitle class="text-subtitle-2 pa-0 ma-0">Livestock this month</v-card-subtitle>
            </div>
             <v-card-title class="text-h4 ml-2" >233</v-card-title>
           </v-sheet>

          <v-sheet class="mr-2 mt-10">
           <div class="d-flex">
              <i class="fa-solid fa-circle mt-2 ml-2 mr-2" style="font-size: 6px;"></i>
              <v-card-subtitle class="text-subtitle-2 pa-0 ma-0">Livestock this month</v-card-subtitle>
           </div>
            <v-card-title class="text-h4 ml-2" >233</v-card-title>
          </v-sheet>
        </v-col>
      </div> 
  </v-row>  
  </v-card>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import ApexCharts from 'apexcharts';

const SplineArea = ref(null);
const select = ref('Municipality');
const items = [
  { state: 'Puerto Galera'},
  { state: 'San Teodoro'},
  { state: 'Baco'},
  { state: 'Calapan City'},
  { state: 'Naujan'},
];

const renderChart = () => {
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
      width: '600',
    },
    dataLabels: {
      enabled: false,
    },
    colors: ['#EB8C00', '#142195'],
    fill: {
      colors: ['', ''],
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
};

onMounted(() => {
  renderChart();
});
</script>
