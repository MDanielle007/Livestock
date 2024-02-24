<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Toolbar class="mb-2 surface-100 w-full">
            <template v-slot:start>
                <span class="block p-input-icon-left">
                    <i class="pi pi-search" />
                    <InputText placeholder="Search..." />
                </span>
            </template>
            <template v-slot:end>
                <div class="my-1">
                    <router-link :to="{ name: 'AdminRegisterUser' }">
                        <Button
                            label="New User"
                            icon="pi pi-user-plus"
                            class="p-button-success mr-2"
                        />
                    </router-link>
                </div>
            </template>
        </Toolbar>
        <DataTable
            v-model:filters="filters"
            :value="customers"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :loading="loading"
            :globalFilterFields="[
                'name',
                'country.name',
                'representative.name',
                'balance',
                'status',
            ]"
        >
            <template #header>
                <div class="flex justify-content-between align-items-center">
                    <div class="text-3xl">Livestocks</div>
                    <InputText
                        v-model="filters['global'].value"
                        placeholder="Keyword Search"
                    />
                </div>
            </template>
            <template #empty> No customers found. </template>
            <template #loading> Loading customers data. Please wait. </template>
            <Column field="name" header="Name" style="min-width: 12rem">
                <template #body="{ data }">
                    {{ data.name }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by name"
                    />
                </template>
            </Column>
            <Column
                header="Country"
                filterField="country.name"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    <div class="flex align-items-center gap-2">
                        <img
                            alt="flag"
                            src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png"
                            :class="`flag flag-${data.country.code}`"
                            style="width: 24px"
                        />
                        <span>{{ data.country.name }}</span>
                    </div>
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by country"
                    />
                </template>
                <template #filterclear="{ filterCallback }">
                    <Button
                        type="button"
                        icon="pi pi-times"
                        @click="filterCallback()"
                        severity="secondary"
                    ></Button>
                </template>
                <template #filterapply="{ filterCallback }">
                    <Button
                        type="button"
                        icon="pi pi-check"
                        @click="filterCallback()"
                        severity="success"
                    ></Button>
                </template>
                <template #filterfooter>
                    <div class="px-3 pt-0 pb-3 text-center">
                        Customized Buttons
                    </div>
                </template>
            </Column>
            <Column
                header="Agent"
                filterField="representative"
                :showFilterMatchModes="false"
                :filterMenuStyle="{ width: '14rem' }"
                style="min-width: 14rem"
            >
                <template #body="{ data }">
                    <div class="flex align-items-center gap-2">
                        <img
                            :alt="data.representative.name"
                            :src="`https://primefaces.org/cdn/primevue/images/avatar/${data.representative.image}`"
                            style="width: 32px"
                        />
                        <span>{{ data.representative.name }}</span>
                    </div>
                </template>
                <template #filter="{ filterModel }">
                    <MultiSelect
                        v-model="filterModel.value"
                        :options="representatives"
                        optionLabel="name"
                        placeholder="Any"
                        class="p-column-filter"
                    >
                        <template #option="slotProps">
                            <div class="flex align-items-center gap-2">
                                <img
                                    :alt="slotProps.option.name"
                                    :src="`https://primefaces.org/cdn/primevue/images/avatar/${slotProps.option.image}`"
                                    style="width: 32px"
                                />
                                <span>{{ slotProps.option.name }}</span>
                            </div>
                        </template>
                    </MultiSelect>
                </template>
            </Column>
            <Column
                header="Date"
                filterField="date"
                dataType="date"
                style="min-width: 10rem"
            >
                <template #body="{ data }">
                    {{ formatDate(data.date) }}
                </template>
                <template #filter="{ filterModel }">
                    <Calendar
                        v-model="filterModel.value"
                        dateFormat="mm/dd/yy"
                        placeholder="mm/dd/yyyy"
                        mask="99/99/9999"
                    />
                </template>
            </Column>
            <Column
                header="Balance"
                filterField="balance"
                dataType="numeric"
                style="min-width: 10rem"
            >
                <template #body="{ data }">
                    {{ formatCurrency(data.balance) }}
                </template>
                <template #filter="{ filterModel }">
                    <InputNumber
                        v-model="filterModel.value"
                        mode="currency"
                        currency="USD"
                        locale="en-US"
                    />
                </template>
            </Column>
            <Column
                header="Status"
                field="status"
                :filterMenuStyle="{ width: '14rem' }"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    <Tag
                        :value="data.status"
                        :severity="getSeverity(data.status)"
                    />
                </template>
                <template #filter="{ filterModel }">
                    <Dropdown
                        v-model="filterModel.value"
                        :options="statuses"
                        placeholder="Select One"
                        class="p-column-filter"
                        showClear
                    >
                        <template #option="slotProps">
                            <Tag
                                :value="slotProps.option"
                                :severity="getSeverity(slotProps.option)"
                            />
                        </template>
                    </Dropdown>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import { CustomerService } from "@/services/CustomerService";
import { FilterMatchMode, FilterOperator } from "primevue/api";

export default {
    data() {
        return {
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
        CustomerService.getCustomersMedium().then((data) => {
            this.customers = this.getCustomers(data);
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
                name: {
                    operator: FilterOperator.AND,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                "country.name": {
                    operator: FilterOperator.AND,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                representative: { value: null, matchMode: FilterMatchMode.IN },
                date: {
                    operator: FilterOperator.AND,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.DATE_IS },
                    ],
                },
                balance: {
                    operator: FilterOperator.AND,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.EQUALS },
                    ],
                },
                status: {
                    operator: FilterOperator.OR,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.EQUALS },
                    ],
                },
                activity: {
                    value: [0, 100],
                    matchMode: FilterMatchMode.BETWEEN,
                },
                verified: { value: null, matchMode: FilterMatchMode.EQUALS },
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
    },
};
</script>
