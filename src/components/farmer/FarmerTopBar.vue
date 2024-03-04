<template>
    <div
        class="h-5rem"
    >
        <div class="farmer-layout-appbar flex justify-content-between align-items-center w-full shadow-2 px-3 py-1 border-round-bottom-md">
            <div class="flex align-items-center gap-3 text-700">
                <div class="font-bold text-3xl text-white">
                    {{ splitPascalCase(this.$route.name) }}
                </div>
            </div>
            <div class="flex gap-2">
                <Avatar label="U" class="mr-2" size="large" style="background-color: #ece9fc; color: #2a1261" shape="circle" />
            </div>
        </div>
    </div>
</template>
<script>
import { splitPascalCase } from "@/utils/StringFormatters.js";

export default {
    methods: {
        splitPascalCase,
    },
};
</script>
<style></style>
