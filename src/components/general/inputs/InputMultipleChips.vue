<template>
  <v-combobox
    v-model="selectedItemNames"
    :items="itemsNames"
    chips
    clearable
    :label="label"
    multiple
    :prepend-icon="icon"
    variant="outlined"
    density="compact"
  >
    <template v-slot:selection="{ attrs, item, select, selected }">
      <v-chip
        v-bind="attrs"
        :model-value="selected"
        closable
        @click="select"
        @click:close="remove(item)"
      >
        <strong>{{ item }}</strong>&nbsp;
      </v-chip>
    </template>
  </v-combobox>
</template>

<script>
export default {
  props: {
    icon: String,
    label: String,
    itemsProps: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      itemsNames: this.itemsProps,
      selectedItemNames: [],
    };
  },

  watch: {
    selectedItemNames(newChips) {
      this.$emit("chips-updated", this.selectedItemNames);
    },
  },

  methods: {
    remove(item) {
      this.selectedItemNames.splice(this.selectedItemNames.indexOf(item), 1);
    },
  },
};
</script>
