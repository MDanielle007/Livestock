<template>
    <div class="bg-white border-1 border-300 border-round-lg p-3 mb-0">
        <div class="flex justify-content-between mb-3">
            <div>
                <span class="block text-500 font-bold mb-3">{{ title }}</span>
                <div class="text-900 font-medium text-xl">{{ value }}</div>
            </div>
            <div
                class="flex align-items-center justify-content-center bg-{{ backgroundColor }}-100 border-round"
                style="width: 2.5rem; height: 2.5rem"
            >
                <i class="text-xl" :class="(icon, iconColor)"></i>
            </div>
        </div>
        <span
            class="font-medium"
            :class="additionalInfoColor || 'text-green-500'"
            >{{ additionalInfo }}&nbsp;</span
        >
        <small class="text-500">{{ additionalText }}</small>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        value: String,  
        additionalInfoColor: String,
        additionalInfo: String,
        additionalText: String,
        icon: String,
        iconColor: String,
        backgroundColor: String,
    },
};
</script>

<style>
/* Your component styles */
</style>
