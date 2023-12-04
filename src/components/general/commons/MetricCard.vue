<template>
    <v-card height="150" width="auto" class="pa-2">
      <div class="text-h6">{{ cardTitle }}</div>
      <div class="text-caption">{{ cardDescription }}</div>
      <div class="text-subtitle-2">{{ cardMetrics }}</div>
    </v-card>
</template>
  
  <script>
  export default {
    props: {
      cardTitle: String,
      cardDescription: String,
      cardMetrics: String,
    },
  };
  </script>