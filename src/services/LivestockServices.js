export const LivestockService = {
    getLivestockData() {
        const livestocks = [
            {
                id: "1",
                livestockTagId: "CTL-101",
                livestockTypeId: "3",
                livestockBreedId: "7",
                livestockAgeClassId: "12",
                age: "4 Days",
                sex: "Male",
                breedingEligibility: "Not Age-Suited",
                dateOfBirth: "2024-2-6",
                livestockHealthStatus: "Alive",
                farmerId: "1",
                farmerUserId: "FMR-AC12312",
                farmerName: "Aba Cus",
            },
            {
                id: "2",
                livestockTagId: "PG-101",
                livestockTypeId: "2",
                livestockBreedId: "5",
                livestockAgeClassId: "6",
                age: "10 Days",
                sex: "Male",
                breedingEligibility: "Not Age-Suited",
                dateOfBirth: "2024-1-31",
                livestockHealthStatus: "Alive",
                farmerId: "2",
                farmerUserId: "FMR-bd12312",
                farmerName: "Ba Doy",
            },
            {
                id: "3",
                livestockTagId: "PG-102",
                livestockTypeId: "2",
                livestockBreedId: "5",
                livestockAgeClassId: "6",
                age: "10 Days",
                sex: "Female",
                breedingEligibility: "Not Age-Suited",
                dateOfBirth: "2024-1-31",
                livestockHealthStatus: "Alive",
                farmerId: "3",
                farmerUserId: "FMR-CE12312",
                farmerName: "CaK E",
            },
        ];

        return Promise.resolve(livestocks);
    },
    getLivestockTypes() {
        const livestockTypes = [
            {
                name: "Chicken",
                code: "1",
            },
            {
                name: "Pig",
                code: "2",
            },
            {
                name: "Cattle",
                code: "3",
            },
        ];

        return Promise.resolve(livestockTypes);
    },

    getLivestockAgeClasses() {
        const livestockAgeClasses = [
            {
                id: "1",
                livestockAgeClassification: "Chick",
                ageClassRange: "0-4 weeks",
                livestockTypeId: "1",
            },
            {
                id: "2",
                livestockAgeClassification: "Pullet",
                ageClassRange: "2-4 months",
                livestockTypeId: "1",
            },
            {
                id: "3",
                livestockAgeClassification: "Cockerel",
                ageClassRange: "3-6 weeks",
                livestockTypeId: "1",
            },
            {
                id: "4",
                livestockAgeClassification: "Rooster",
                ageClassRange: "6 months and above",
                livestockTypeId: "1",
            },
            {
                id: "5",
                livestockAgeClassification: "Hen",
                ageClassRange: "6 months and above",
                livestockTypeId: "1",
            },
            {
                id: "6",
                livestockAgeClassification: "Piglet",
                ageClassRange: "0-6 weeks",
                livestockTypeId: "2",
            },
            {
                id: "7",
                livestockAgeClassification: "Weaner",
                ageClassRange: "6 weeks - 3 months",
                livestockTypeId: "2",
            },
            {
                id: "8",
                livestockAgeClassification: "Grower",
                ageClassRange: "3-6 months",
                livestockTypeId: "2",
            },
            {
                id: "9",
                livestockAgeClassification: "Finisher",
                ageClassRange: "6 months and above",
                livestockTypeId: "2",
            },
            {
                id: "10",
                livestockAgeClassification: "Sow",
                ageClassRange: "8-18 months and above",
                livestockTypeId: "2",
            },
            {
                id: "11",
                livestockAgeClassification: "Boar",
                ageClassRange: "8-18 months and above",
                livestockTypeId: "2",
            },
            {
                id: "12",
                livestockAgeClassification: "Calf",
                ageClassRange: "6 months",
                livestockTypeId: "3",
            },
            {
                id: "13",
                livestockAgeClassification: "Yearling",
                ageClassRange: "6-12 months",
                livestockTypeId: "3",
            },
            {
                id: "14",
                livestockAgeClassification: "Heifer",
                ageClassRange: "1-3 years",
                livestockTypeId: "3",
            },
            {
                id: "15",
                livestockAgeClassification: "Steer",
                ageClassRange: "1-3 years",
                livestockTypeId: "3",
            },
            {
                id: "16",
                livestockAgeClassification: "Cow",
                ageClassRange: "3 years and above",
                livestockTypeId: "3",
            },
            {
                id: "17",
                livestockAgeClassification: "Bull",
                ageClassRange: "3 years and above",
                livestockTypeId: "3",
            },
        ];

        return Promise.resolve(livestockAgeClasses);
    },
    getLivestockBreeds() {
        const livestockBreeds = [
            {
                id: "1",
                livestockBreedName: "Native Chicken",
                livestockBreedDescription:
                    "Native dual purpose chicken breed in Philippines",
                livestockTypeId: "1",
            },
            {
                id: "2",
                livestockBreedName: "Rhode Island Red",
                livestockBreedDescription:
                    "Dual purpose chicken breed imported from US",
                livestockTypeId: "1",
            },
            {
                id: "3",
                livestockBreedName: "Leghorn",
                livestockBreedDescription:
                    "Egg laying chicken breed imported from Italy",
                livestockTypeId: "1",
            },
            {
                id: "4",
                livestockBreedName: "Duroc",
                livestockBreedDescription: "Lean meat pig breed from US",
                livestockTypeId: "2",
            },
            {
                id: "5",
                livestockBreedName: "Landrace",
                livestockBreedDescription:
                    "White pig breed from Denmark used for pork",
                livestockTypeId: "2",
            },
            {
                id: "6",
                livestockBreedName: "Berk shire",
                livestockBreedDescription:
                    "Black pig breed known for quality pork",
                livestockTypeId: "2",
            },
            {
                id: "7",
                livestockBreedName: "Holstein Friesian",
                livestockBreedDescription:
                    "High milk producing dairy cow imported from US and Europe",
                livestockTypeId: "3",
            },
            {
                id: "8",
                livestockBreedName: "Brahman",
                livestockBreedDescription:
                    "Beef cattle breed adapted to tropics from India",
                livestockTypeId: "3",
            },
            {
                id: "9",
                livestockBreedName: "Philippine Native Carabao",
                livestockBreedDescription:
                    "Native Philippine carabao breed used for plowing and hauling",
                livestockTypeId: "4",
            },
        ];

        return Promise.resolve(livestockBreeds);
    },
};
