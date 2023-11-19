<template>
    <v-data-table-server
        v-model:items-per-page="itemsPerPage"
        :headers="headers"
        :items-length="totalItems"
        :items="serverItems"
        :loading="loading"
        :search="search"
        item-value="name"
        @update:options="loadItems"
    >

        <template v-slot:item.User_Status="{ item }">
            <v-row justify="end">
                <v-chip
                    :color="item.User_Status === 'Active' ? 'green' : 'red'"
                    class="text-uppercase"
                    label
                    size="small"
                >{{ item.User_Status }}</v-chip>
            </v-row>
        </template>

        <template v-slot:item.Image="{ item }">
        <v-row>
            <v-img 
            :src="item.Image" 
            aspect-ratio="1"
            cover
            class="ma-5"
            ></v-img>
        </v-row>
        </template>
    </v-data-table-server>
</template>
<script>
import axios from 'axios';

export default {
    name:'UserAccountsTable',
    data () {
        return {
            userAccounts:[],
            headers: [
                {
                    title: 'Full Name',
                    align: 'start',
                    sortable: true,
                    key: 'fullname',
                },
                { 
                    title: 'Role', 
                    key: 'User_Role', 
                    align: 'end' 
                },
                { 
                    title: 'Status', 
                    key: 'User_Status', 
                    align: 'end' 
                },
                { 
                    title: 'Image', 
                    key: 'Image', 
                    src: 'Image',
                    align: 'end' 
                },
            ],
            search: '',
            serverItems: [],
            loading: true,
            totalItems: 0,
        }
    },
    created() {
        this.getUserAccounts();
    },
    methods: {
        async getUserAccounts(){
            try {
                const accounts = await axios.get('admin/getUserAccounts');
                this.userAccounts = accounts.data;
                console.log(accounts.data);
            } catch (error) {
                console.log(error);
            }
        },
        loadItems ({ page, itemsPerPage, sortBy }) {
            this.loading = true
            this.FakeAPI({ page, itemsPerPage, sortBy }).then(({ items, total }) => {
                this.serverItems = items
                this.totalItems = total
                this.loading = false
            })
        },
        async FakeAPI({ page, itemsPerPage, sortBy }) {
            return new Promise(resolve => {
                setTimeout(() => {
                    const start = (page - 1) * itemsPerPage
                    const end = start + itemsPerPage
                    const items = this.userAccounts.slice()

                    if (sortBy.length) {
                        const sortKey = sortBy[0].key
                        const sortOrder = sortBy[0].order
                        items.sort((a, b) => {
                            const aValue = a[sortKey]
                            const bValue = b[sortKey]
                            return sortOrder === 'desc' ? bValue - aValue : aValue - bValue
                        })
                    }

                    const paginated = items.slice(start, end)

                    resolve({ items: paginated, total: items.length })
                }, 500)
            })
        },
    },
}
</script>