
<template>
    <div class="card overflow-x-auto code-container">
        <OrganizationChart :value="data">
            <template #default="slotProps">
                <span>{{ slotProps.node.label }}</span>
            </template>
        </OrganizationChart>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: {
                label: 'Argentina',
                children: [
                    {
                        label: 'Argentina',
                        children: [
                            {
                                label: 'Argentina'
                            },
                            {
                                label: 'Croatia'
                            }
                        ]
                    },
                    {
                        label: 'France',
                        children: [
                            {
                                label: 'France'
                            },
                            {
                                label: 'Morocco'
                            }
                        ]
                    }
                ]
            }
        };
    }
};
</script>
<style scoped>
.code-container {
    /* Adjust the size of the code container */
    width: 100%; /* You can change this to a specific width or use other units like % or em */
    height: 500px; /* You can change this to adjust the height as well */
    /* Add any other styling you need */
}
</style>
