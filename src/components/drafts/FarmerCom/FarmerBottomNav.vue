<template>
    <v-bottom-navigation
        class="d-flex d-sm-none pb-8 w-100"
        height="120"
        v-model="value"
        :bg-color="color"
    >
        <v-btn class="nav-button">
        <v-icon>mdi-home-variant</v-icon>

        <span>Home</span>
        </v-btn>

        <v-btn class="nav-button">
        <v-icon>mdi-barn</v-icon>

        <span>Livestock</span>
        </v-btn>

        <v-btn class="nav-button">
        <v-icon>mdi-cart</v-icon>

        <span>Sales</span>
        </v-btn>

        <v-btn class="nav-button">
        <v-icon>mdi-bell</v-icon>

        <span>Notification</span>
        </v-btn>
    </v-bottom-navigation>
</template>
<script>
export default {
    data: () => ({ value: 1 }),

    computed: {
        color () {
        switch (this.value) {
            case 0: return 'blue-grey'
            case 1: return 'teal'
            case 2: return 'brown'
            case 3: return 'indigo'
            default: return 'blue-grey'
        }
        },
    },
}
</script>
<style>
.nav-button {
    max-width: 88px; /* Set your desired fixed width */
    max-height: 88px; /* Set your desired fixed height */
}
</style>