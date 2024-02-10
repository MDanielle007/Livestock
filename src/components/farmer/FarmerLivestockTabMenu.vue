<template>
    <div class="card">
        <TabMenu :model="items">
            <template #item="{ item, props }">
                <router-link
                    v-if="item.route"
                    v-slot="{ href, navigate }"
                    :to="item.route"
                    custom
                >
                    <a
                        v-ripple
                        :href="href"
                        v-bind="props.action"
                        @click="navigate"
                    >
                        <span v-bind="props.label">{{ item.label }}</span>
                    </a>
                </router-link>
                <a
                    v-else
                    v-ripple
                    :href="item.url"
                    :target="item.target"
                    v-bind="props.action"
                >
                    <span v-bind="props.icon" />
                    <span v-bind="props.label">{{ item.label }}</span>
                </a>
            </template>
        </TabMenu>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [
                {
                    label: "Livestocks",
                    icon: "pi pi-home",
                    route: { name: "FarmerLivestock" },
                },
                {
                    label: "Vaccinations",
                    icon: "pi pi-home",
                    route: { name: "FarmerLivestockVaccinations" },
                },
                {
                    label: "Breedings",
                    icon: "pi pi-home",
                    route: { name: "FarmerLivestockBreedings" },
                },
                {
                    label: "Mortalities",
                    icon: "pi pi-home",
                    route: { name: "FarmerLivestockMortalities" },
                },
            ],
        };
    },
};
</script>
