export const BreedingService = {
    getBreedingParentOffspringData() {
        const breedingData = [
            {
                id: "7",
                parentMaleLivestockTagId: "CRB-101",
                parentFemaleLivestockTagId: "CRB-102",
                offspringLivestockTagId: "CRB-103",
                livestockTypeId: "1",
                outcome: "Success",
                pregnancyStartDate: "2024-02-24",
                actualDeliveryDate: "2024-02-24",
                farmerName: "Marc Danielle Cabatay",
                farmerUserId: "FMR-MC3980",
            },
        ];

        return Promise.resolve(breedingData);
    },
    getLivestockBreedingData() {
        const breedingData = [
            {
                id: "1",
                farmerId: "1",
                farmerName: "Aba Cus",
                farmerUserId: "FMR-AB3980",
                livestockTypeId: "3",
                maleLivestockTagId: "CTL-101",
                femaleLivestockTagId: "CTL-102",
                breedResult: "Unsuccessful Breeding",
                breedAdditionalNotes: "",
                breedDate: "2024-02-20",
            },
            {
                id: "2",
                farmerId: "1",
                farmerName: "Aba Cus",
                farmerUserId: "FMR-AB3980",
                livestockTypeId: "3",
                maleLivestockTagId: "CTL-101",
                femaleLivestockTagId: "CTL-102",
                breedResult: "Unsuccessful Breeding",
                breedAdditionalNotes: "",
                breedDate: "2024-02-20",
            },
        ];

        return Promise.resolve(breedingData);
    },
    getLivestockPregnancyData() {
        const pregnancyData = [
            {
                id: "1",
                breedingId: "1",
                livestockId: "6",
                livestockTagId: "CRB-102",
                livestockTypeId: "4",
                outcome: "Successful",
                pregnancyStartDate: "2024-02-24",
                expectedDeliveryDate: null,
                actualDeliveryDate: "2024-02-24",
                farmerId: "1",
                farmerName: "Aba Cus",
                farmerUserId: "FMR-AB3980",
            },
            {
                id: "2",
                breedingId: "2",
                livestockId: "6",
                livestockTagId: "CRB-102",
                livestockTypeId: "4",
                outcome: "Successful",
                pregnancyStartDate: "2024-02-25",
                expectedDeliveryDate: null,
                actualDeliveryDate: "2024-02-25",
                farmerId: "1",
                farmerName: "Aba Cus",
                farmerUserId: "FMR-AB3980",
            },
        ];

        return Promise.resolve(pregnancyData);
    },
    getLivestockOffspringRecordData() {
        const livestockOffspringData = [
            {
                id: "1",
                livestockId: "1",
                livestockTypeId: "4",
                birthDate: "2024-02-24",
                sex: "Male",
                offspringNotes: null,
                parentMaleLivestockTagId: "CRB-101",
                parentFemaleLivestockTagId: "CRB-102",
                farmerId: "1",
                farmerUserId: "FMR-MC3980",
                farmerName: "Marc Danielle Cabatay",
            },
        ];

        return Promise.resolve(livestockOffspringData);
    },
};
