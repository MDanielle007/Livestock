<template>
  <div class="max-w-screen">
    <div class="m-0 flex flex-wrap gap-3 justify-content-between">
      <div class="w-6rem" v-for="livestock in livestocks">
        <LivestockCard
          :cardSubtitle="livestock.livestockType"
          :cardTitle="livestock.livestockAgeClass"
          :cardContent="livestock.livestockCount"
        />
      </div>
      <div class="flex-grow-1">
        <LivestockCard :cardTitle="'Total Livestocks'" :cardContent="`${16} Livestocks`" :contentHeight="'6.4rem'" />
      </div>
    </div>
  </div>
</template>
<script>
import LivestockCard from "@/components/farmer/LivestockCard.vue";

export default {
  data() {
    return {
      livestocks: [
        {
          livestockType: "Pig",
          livestockAgeClass: "Piglet",
          livestockCount: "7",
        },
        {
          livestockType: "Cattle",
          livestockAgeClass: "Calf",
          livestockCount: "5",
        },
        {
          livestockType: "Goat",
          livestockAgeClass: "Kid",
          livestockCount: "2",
        },
        {
          livestockType: "Carabao",
          livestockAgeClass: "Calf",
          livestockCount: "2",
        },
      ],
    };
  },
  components: {
    LivestockCard,
  },
};
</script>
<style></style>
