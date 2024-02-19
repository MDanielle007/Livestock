<template>
    <div class="card">
        <TabMenu :model="filteredItems">
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
            withChickens: true,
            items: [
                {
                    label: "Livestocks",
                    route: { name: "FarmerLivestock" },
                },
                {
                    label: "Vaccinations",
                    route: { name: "FarmerLivestockVaccinations" },
                },
                {
                    label: "Breedings",
                    route: { name: "FarmerLivestockBreedings" },
                },
                {
                    label: "Egg Production",
                    route: { name: "FarmerEggProduction" },
                },
                {
                    label: "Mortalities",
                    route: { name: "FarmerLivestockMortalities" },
                },
            ],
        };
    },
    computed: {
        filteredItems() {
            if (this.withChickens) {
                return this.items;
            } else {
                // Filter out the "Egg Production" item when withChickens is false
                return this.items.filter(item => item.label !== "Egg Production");
            }
        }
    }
};
</script>
