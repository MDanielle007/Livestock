<template>
    <div class="card">
        <DataTable
            v-model:filters="filters"
            :value="auditTrails"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :loading="loading"
            :globalFilterFields="[
                'action',
                'title',
                'description',
                'entityAffected',
                'timestamp',
            ]"
        >
            <template #header>
                <div class="flex justify-content-between">
                    <Button
                        type="button"
                        icon="pi pi-filter-slash"
                        label="Clear"
                        outlined
                        @click="clearFilter()"
                    />
                    <InputText
                        v-model="filters['global'].value"
                        placeholder="Keyword Search"
                    />
                    <div class="flex gap-3">
                        <Button icon="pi pi-download" label="Import" />
                        <Button icon="pi pi-upload" label="Export" />
                    </div>
                </div>
            </template>
            <template #empty> No Audit Trail found. </template>
            <template #loading>
                Loading audit trail data. Please wait.
            </template>
            <Column field="entityAffected" header="Entity" style="min-width: 12rem">
                <template #body="{ data }">
                    <div class="flex align-items-center gap-2">
                        <img
                            :alt="data.entityAffected"
                            :src="getImagePath(data.entityAffected)"
                            style="width: 32px"
                        />
                        <span>{{ data.entityAffected }}</span>
                    </div>
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Entity"
                    />
                </template>
            </Column>
            <Column field="action" header="Action" style="min-width: 12rem">
                <template #body="{ data }">
                    {{ data.action }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Action"
                    />
                </template>
            </Column>
            <Column field="title" header="Title" style="min-width: 12rem">
                <template #body="{ data }">
                    {{ data.title }}
                </template>
            </Column>
            <Column
                field="description"
                header="Description"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    {{ data.description }}
                </template>
            </Column>
            <Column
                header="Date"
                filterField="timestamp"
                dataType="Time"
                style="min-width: 10rem"
            >
                <template #body="{ data }">
                    {{ formatDate(data.timestamp) }}
                </template>
                <template #filter="{ filterModel }">
                    <Calendar
                        v-model="filterModel.timestamp"
                        dateFormat="mm/dd/yy"
                        showTime
                        placeholder="mm/dd/yyyy"
                        mask="99/99/9999"
                    />
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import { CustomerService } from "@/services/CustomerService";

import { AuditTrailService } from "@/services/AuditTrailService";
import { FilterMatchMode, FilterOperator } from "primevue/api";

export default {
    data() {
        return {
            auditTrails: null,
            customers: null,
            filters: null,
            representatives: [
                { name: "Amy Elsner", image: "amyelsner.png" },
                { name: "Anna Fali", image: "annafali.png" },
                { name: "Asiya Javayant", image: "asiyajavayant.png" },
                { name: "Bernardo Dominic", image: "bernardodominic.png" },
                { name: "Elwin Sharvill", image: "elwinsharvill.png" },
                { name: "Ioni Bowcher", image: "ionibowcher.png" },
                { name: "Ivan Magalhaes", image: "ivanmagalhaes.png" },
                { name: "Onyama Limba", image: "onyamalimba.png" },
                { name: "Stephen Shaw", image: "stephenshaw.png" },
                { name: "XuXue Feng", image: "xuxuefeng.png" },
            ],
            statuses: [
                "unqualified",
                "qualified",
                "new",
                "negotiation",
                "renewal",
                "proposal",
            ],
            loading: true,
        };
    },
    created() {
        this.initFilters();
    },
    mounted() {
        AuditTrailService.getAuditTrail().then((data) => {
            this.auditTrails = this.getAuditTrails(data);
            this.loading = false;
        });
    },
    methods: {
        formatDate(value) {
            return value.toLocaleDateString("en-US", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
            });
        },
        formatCurrency(value) {
            return value.toLocaleString("en-US", {
                style: "currency",
                currency: "USD",
            });
        },
        clearFilter() {
            this.initFilters();
        },
        initFilters() {
            this.filters = {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
                action: {
                    operator: FilterOperator.AND,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                title: {
                    operator: FilterOperator.AND,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                description: {
                    value: null,
                    matchMode: FilterMatchMode.STARTS_WITH,
                },
                entityAffected: {
                    value: null,
                    matchMode: FilterMatchMode.STARTS_WITH,
                },
                timestamp: {
                    operator: FilterOperator.AND,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.DATE_IS },
                    ],
                },
            };
        },
        getCustomers(data) {
            return [...(data || [])].map((d) => {
                d.date = new Date(d.date);

                return d;
            });
        },
        getSeverity(status) {
            switch (status) {
                case "unqualified":
                    return "danger";

                case "qualified":
                    return "success";

                case "new":
                    return "info";

                case "negotiation":
                    return "warning";

                case "renewal":
                    return null;
            }
        },
        getAuditTrails(data) {
            return [...(data || [])].map((d) => {
                d.timestamp = new Date(d.timestamp);
                console.log(d.timestamp);
                return d;
            });
        },
        getImagePath(entity) {
            switch (entity) {
                case "Livestock":
                    return "/icons/history-icons/cow-96.png";
                case "Vaccination":
                    return "/icons/history-icons/vaccine-96.png";
                case "Breeding":
                    return "/icons/history-icons/heart-96.png";
                case "Mortality":
                    return "/icons/history-icons/dead-chicken-96.png";
            }
        },
    },
};
</script>
