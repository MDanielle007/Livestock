<template>
    <v-table theme="dark" class="rounded-lg">
        <thead>
            <tr>
                <th class="text-left" v-for="key in tableHeaders" :key="key">
                    {{ key }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="account in userAccounts"
            :key="account.User_ID"
            >
            <td>{{ account.Firstname}} {{ account.Lastname }}</td>
            <td>{{ account.User_Role === "DAP" ? "DA Personnel" : "Farmer"}}</td>
            <td>{{ account.User_Status }}</td>
            <td width="320">{{ account.Image }}</td>
            </tr>
        </tbody>
    </v-table>
</template>
<script>
import axios from 'axios';

export default {
    name:'UserAccountsTable',
    data () {
        return {
            userAccounts:[],
            tableHeaders:['Full Name','Role','Status','Image'],
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
            } catch (error) {
                console.log(error);
            }
        }
    },
}
</script>