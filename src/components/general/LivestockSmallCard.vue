<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-2 flex align-items-center justify-content-between"
    >
        <div class="font-semibold text-700">
            <i :class="[icon, iconColor]" style="font-size: 1rem"></i> {{ title }}
        </div>
        <div class="text-700 text-xl">
            {{ value }}
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {};
    },
    props: {
        icon:{
            type:String,
            default:''
        },
        iconColor:{
            type:String,
            default:''
        },
        title: {
            type: String,
            required: true,
        },
        value: {
            type: String,
            required: true,
        },
    },
};
</script>
<style></style>
