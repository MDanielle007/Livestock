export const LivestockService = {
    getLivestockData(){
        const livestocks = [
            {
                id: "1",
                livestockTagId: "CTL-101",
                livestockTypeId: "3",
                livestockBreedId: "7",
                livestockAgeClassId: "12",
                ageDays: "4 Days",
                sex: "Male",
                breedingEligibility: "Not Age-Suited",
                dateOfBirth: "2024-2-6",
                livestockHealthStatus: "Alive",
                farmerId: "1",
                farmerUserId:"FMR-AC12312",
                farmerName: "Aba Ca"
            },
            {
                id: "2",
                livestockTagId: "PG-101",
                livestockTypeId: "2",
                livestockBreedId: "5",
                livestockAgeClassId: "6",
                ageDays: "10 Days",
                sex: "Male",
                breedingEligibility: "Not Age-Suited",
                dateOfBirth: "2024-1-31",
                livestockHealthStatus: "Alive",
            },
            {
                id: "3",
                livestockTagId: "PG-102",
                livestockTypeId: "2",
                livestockBreedId: "5",
                livestockAgeClassId: "6",
                ageDays: "10 Days",
                sex: "Female",
                breedingEligibility: "Not Age-Suited",
                dateOfBirth: "2024-1-31",
                livestockHealthStatus: "Alive",
            },
        ];

        return Promise.resolve(livestocks);
    }
};