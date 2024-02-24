<template>
    <div class="bg-white border-round-lg border-1 border-300 flex flex-column gap-1 p-3">
        <div class="text-700 text-2xl font-bold">{{title?? 'Ranking List' }}</div>
        <DataTable :value="items" class="h-20rem overflow-y-auto">
            <template #empty> No Data Fetched</template>
            <Column field="name" :header="label ?? 'label'"></Column>
            <Column
                field="value"
                :header="value ?? 'value'"
            ></Column>
        </DataTable>
    </div>
</template>

<script>
export default {
    props:{
        title:{
            type:String,
            required:true
        },
        label:{
            type:String,
            required:true
        },
        value:{
            type:String,
            required:true
        },
        items:{
            type:Array,
            required:true
        }
    },
    data() {
        return {
        };
    },
};
</script>
