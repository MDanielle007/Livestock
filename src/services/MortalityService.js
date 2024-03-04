export const MortalityService = {
    getLivestockMortality() {
        const mortalityData = [
            {
                id: "2",
                livestockId: "1",
                livestockTagId: "CRB-102",
                livestockTypeId: "4",
                farmerId: "1",
                farmerUserId: "FMR-MC3980",
                farmerName: "Aba Cus",
                causeOfDeath: "Pneumonia",
                additionalDeathNotes: "",
                dateOfDeath: "2024-02-07",
            },
        ];

        return Promise.resolve(mortalityData);
    },
};
