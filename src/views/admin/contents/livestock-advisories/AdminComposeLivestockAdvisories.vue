<template>
    <div>
        <Toolbar class="mb-2 bg-white">
            <template v-slot:start>
                <div class="flex gap-3 align-items-center">
                    <router-link :to="{ name: 'AdminLivestockAdvisories' }">
                        <Button icon="pi pi-chevron-left" />
                    </router-link>
                    <div class="text-xl font-bold text-700">
                        Compose Livestock Advisories
                    </div>
                </div>
            </template>
        </Toolbar>
        <div
            class="flex flex-column gap-3 flex-wrap px-5 py-3 border-1 border-200 border-round-md bg-white"
        >
            <div class="flex flex-column gap-2">
                <label for="targetFarmers" class="font-bold text-700">To</label>
                <InputGroup>
                    <InputGroupAddon>
                        <i class="pi pi-user"></i>
                    </InputGroupAddon>
                    <MultiSelect
                        id="targetFarmers"
                        v-model="livestockAdvisory.targetFarmers"
                        :options="farmers"
                        filter
                        optionLabel="name"
                        optionValue="code"
                        placeholder="Select Farmers"
                        :maxSelectedLabels="3"
                        class="w-full md:w-20rem"
                    />
                </InputGroup>
            </div>
            <div class="flex flex-column gap-2">
                <label for="livestockAdvisorySubject" class="font-bold text-700">Subject</label>
                <InputGroup>
                    <InputGroupAddon>
                        <i class="pi pi-envelope"></i>
                    </InputGroupAddon>
                    <InputText
                        id="livestockAdvisorySubject"
                        v-model="livestockAdvisory.subject"
                        placeholder="Subject"
                    />
                </InputGroup>
            </div>
            <Editor
                v-model="livestockAdvisory.content"
                editorStyle="height: 280px"
            />
            <div class="flex justify-content-end">
                <Button @click="sendAdvisory" icon="pi pi-send" label="Send Advisory" />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            livestockAdvisory: {
                targetFarmers: null,
                subject: "",
                content: "",
            },
            farmers: [
                {
                    name: "Farmers 1",
                    code: "1"
                },
                {
                    name: "Farmers 2",
                    code: "2"
                },
                {
                    name: "Farmers 3",
                    code: "3"
                },
                {
                    name: "Farmers 4",
                    code: "4"
                },
            ],
        };
    },
    methods:{
        sendAdvisory(){
            console.log(this.livestockAdvisory);
        }
    }
};
</script>
<style></style>
