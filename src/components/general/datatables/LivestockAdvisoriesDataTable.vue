<template>
    <div class="card">
        <DataTable
            v-model:filters="filters"
            :value="livestockAdvisories"
            paginator
            :rows="10"
            :rowsPerPageOptions="[5, 10, 20, 50]"
            tableStyle="min-width: 50rem"
            :globalFilterFields="[
                'advisoryType',
                'subject',
                'content',
                'datePublished',
            ]"
             selectionMode="single" dataKey="id" :metaKeySelection="false"
            @rowSelect="onRowSelect" @rowUnselect="onRowUnselect"
        >
            <template #header>
                <div class="flex justify-content-between">
                    <InputText
                        v-model="filters['global'].value"
                        placeholder="Keyword Search"
                    />
                    <router-link
                        :to="{ name: 'AdminComposeLivestockAdvisories' }"
                    >
                        <Button icon="pi pi-envelope" label="Compose" />
                    </router-link>
                </div>
            </template>
            <template #empty> No livestock advisories found. </template>
            <Column header="Type">
                <template #body="{ data }">
                    <div class="flex align-items-center">
                        <Avatar :image="getImagePath(data.advisoryType)" class="mr-2" shape="circle" />
                        <div class="text-700 font-semibold">{{ data.advisoryType }}</div>
                    </div>
                </template>
            </Column>
            <Column header="Advisory">
                <template #body="{ data }">
                    <div>
                        <span class="font-bold text-700">{{
                            data.subject
                        }}</span>
                        <span
                            >&nbsp;-
                            {{ formatAdvisoryDetails(data.content) }}</span
                        >
                    </div>
                </template>
            </Column>
            <Column field="datePublished" header="Date">
                <template #body="{ data }">
                    <div>
                        {{ formatDateTime(data.datePublished) }}
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import { FilterMatchMode } from "primevue/api";
import { formatDateTime } from '@/utils/StringFormatters';

export default {
    data() {
        return {
            livestockAdvisories: [
                {
                    id: "1",
                    advisoryType: "General",
                    subject: "Livestock 1",
                    content:
                        "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem cumque quaerat voluptas ratione, odit a amet. Esse, aliquam necessitatibus? Facere nostrum sit sapiente necessitatibus et nihil doloremque! Sit, consequatur voluptate.",
                    datePublished: "2024-02-21 19:18:02",
                    targetFarmerId: null,
                },
                {
                    id: "2",
                    advisoryType: "Farmer",
                    subject: "Livestock 2",
                    content:
                        "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem cumque quaerat voluptas ratione, odit a amet. Esse, aliquam necessitatibus? Facere nostrum sit sapiente necessitatibus et nihil doloremque! Sit, consequatur voluptate.",
                    datePublished: "2024-02-10 17:33:11",
                    targetFarmerId: ["1", "2", "3"],
                },
            ],
            filters: null,
            columns: null,
            maxWidthPercentage: 100,
        };
    },
    mounted() {
        // Listen to window resize event to update maxWidthPercentage
        window.addEventListener("resize", this.updateMaxWidthPercentage);
        // Initial call to update maxWidthPercentage
        this.updateMaxWidthPercentage();
    },
    beforeUnmount() {
        // Remove event listener when component is unmounted
        window.removeEventListener("resize", this.updateMaxWidthPercentage);
    },
    created() {
        this.columns = [
            { field: "advisoryType", header: "Advisory Type" },
            { field: "content", header: "Advisory" },
            { field: "datePublished", header: "Date" },
        ];
        this.initFilters();
    },
    methods: {
        formatDateTime,
        clearFilter() {
            this.initFilters();
        },
        initFilters() {
            this.filters = {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            };
        },
        formatAdvisoryDetails(content) {
            const maxWidth = (window.innerWidth * this.maxWidthPercentage) / 200;
            const maxLength = Math.floor(maxWidth / 8); // Maximum length for the combined subject and content
            let details = content;
            if (details.length > maxLength) {
                // If combined length exceeds maxLength, truncate and add ellipsis
                details = details.substring(0, maxLength - 3) + "...";
            }
            return details;
        },
        updateMaxWidthPercentage() {
            // Update maxWidthPercentage based on current viewport width
            this.maxWidthPercentage = window.innerWidth >= 768 ? 100 : 50; // Change 768 to your desired breakpoint
        },
        onRowSelect(event) {    
            this.$router.push({
                name: "AdminAdvisory",
                params: { id: event.data.id },
            });
        },
        onRowUnselect(event) {
            this.$toast.add({ severity: 'warn', summary: 'Product Unselected', detail: 'Name: ' + event.data.subject, life: 3000 });
        },
        getImagePath(type) {
            switch (type) {
                case "General":
                    return "/icons/user-icons/earth-planet-96.png";
                case "Farmer":
                    return "/icons/user-icons/farmer-96.png";
            }
        },
    },
};
</script>
