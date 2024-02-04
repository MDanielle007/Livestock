<template>
    <Card
        style="width: 16rem; overflow: hidden"
        :pt="{
            root: {
                class: 'shadow-none border-200 border-1',
            },
            content: { class: 'p-1' },
        }"
    >
        <template #header>
            <img
                class="h-7rem"
                alt="user header"
                src="https://primefaces.org/cdn/primevue/images/usercard.png"
            />
        </template>
        <template #title>{{ user.farmerId }}</template>
        <template #subtitle>{{ user.name }}</template>
        <template #content>
            <div class="h-7rem overflow-y-auto">
                <span class="mb-1 flex font-medium">Livestock Owned</span>
                <ul class="list-none p-0 m-0 overflow-hidden">
                    <li
                        v-for="(livestock, index) in user.livestocks"
                        :key="index"
                        class="mb-1"
                    >
                        <Chip
                            :label="`${livestock.livestockType}: ${livestock.livestockCount}`"
                        />
                    </li>
                </ul>
            </div>
        </template>
        <template #footer>
            <Button
                icon="pi pi-pencil"
                label="Edit Info"
                severity="secondary"
                outlined
                class="w-full"
            />
        </template>
    </Card>
</template>

<script>
export default {
    props: ["user"],
};
</script>
