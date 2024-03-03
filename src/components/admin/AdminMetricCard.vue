<template>
    <div class="bg-white border-1 border-300 border-round-lg p-3">
        <div class="flex justify-content-between" :class="[{'mb-2':!Array.isArray(value)},{'mb-1':Array.isArray(value)}]">
            <div>
                <span class="block text-500 font-bold" :class="[{'mb-2':!Array.isArray(value)},{'mb-1':Array.isArray(value)}]">{{ title }}</span>
                <div
                    v-if="typeof this.value === 'string'"
                    class="text-900 font-medium h-2rem"
                    :class="valueSize"
                >
                    {{ value }}
                </div>
                <div v-if="Array.isArray(value)" class="w-full">
                    <div
                        class="flex flex-row flex-wrap gap-2"
                    >
                        <Chip class="text-sm" v-for="(item, index) in value"
                        :key="index" :label="`${item.name} : ${item.value}`" />
                    </div>
                </div>
            </div>
            <div
                class="flex align-items-center justify-content-center bg-{{ backgroundColor }}-100 border-round"
                style="width: 2.5rem; height: 2.5rem"
            >
                <i class="text-xl" :class="(icon, iconColor)"></i>
            </div>
        </div>
        <span
            v-if="additionalInfo"
            class="font-medium"
            :class="additionalInfoColor || 'text-green-500'"
            >{{ additionalInfo }}&nbsp;</span
        >
        <small v-if="additionalText" class="text-500">{{
            additionalText
        }}</small>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        value: [String, Array],
        additionalInfoColor: String,
        additionalInfo: String,
        additionalText: String,
        icon: String,
        iconColor: String,
        backgroundColor: String,
        valueSize: String,
    },
    computed: {
        formattedValue() {
            if (typeof this.value === "string") {
                return this.value; // Return the value as is if it's a string
            } else if (Array.isArray(this.value)) {
                // If it's an array, generate a list of items
                return `<ul>
                        ${this.value
                            .map(
                                (item) => `<li>${item.name}: ${item.value}</li>`
                            )
                            .join("")}
                    </ul>`;
            } else {
                return ""; // Return an empty string for unsupported types
            }
        },
    },
};
</script>

<style>
/* Your component styles */
</style>
