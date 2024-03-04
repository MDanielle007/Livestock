<template>
    <div
        class="bg-blue-800 h-5rem flex justify-content-between align-items-center w-full shadow-3 px-3 py-2"
    >
        <div class="flex align-items-center gap-3 text-700">
            <a @click="hideSideBar">
                <i class="pi pi-bars text-3xl cursor-pointer text-white"></i>
            </a>
            <div class="font-bold text-3xl text-white">
                {{ splitPascalCase(this.$route.name) }}
            </div>
        </div>
        <div class="flex gap-2">
            <div>
                <Button
                    icon="pi pi-bell text-xl text-white"
                    text
                    rounded
                    aria-label="Filter"
                    @click="toggle"
                />

                <OverlayPanel ref="op">
                    <div class="flex flex-column gap-3 h-30rem w-25rem">
                        <AdminNotificationDataView/>
                    </div>
                </OverlayPanel>
            </div>
            <Avatar
                label="U"
                class="mr-2"
                size="large"
                style="background-color: #ece9fc; color: #2a1261"
                shape="circle"
            />
        </div>
    </div>
</template>
<script>
import { splitPascalCase } from "@/utils/StringFormatters.js";
import AdminNotificationDataView from "@/components/admin/AdminNotificationDataView.vue"

export default {
    data() {
        return {
            members: [
                { name: 'Amy Elsner', image: 'amyelsner.png', email: 'amy@email.com', role: 'Owner' },
                { name: 'Bernardo Dominic', image: 'bernardodominic.png', email: 'bernardo@email.com', role: 'Editor' },
                { name: 'Ioni Bowcher', image: 'ionibowcher.png', email: 'ioni@email.com', role: 'Viewer' }
            ]
        }
    },
    methods: {
        splitPascalCase,
        hideSideBar() {
            this.$emit("hideSideBar");
        },
        toggle(event) {
            this.$refs.op.toggle(event);
        }
    },
    components:{
        AdminNotificationDataView
    }
};
</script>
<style></style>
