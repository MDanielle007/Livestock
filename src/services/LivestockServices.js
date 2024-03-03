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

    getLivestockMappingData() {
        const livestockMappingData = [
            {
                lat: "13.3241",
                long: "121.1407",
                farmerUserId: "FRM-ABC1231",
                livestocks: [
                    { livestockType: "Cow", livestockCount: 2 },
                    { livestockType: "Chicken", livestockCount: 5 },
                ],
            },
            {
                lat: "13.2056",
                long: "121.0932",
                farmerUserId: "FRM-DEF4562",
                livestocks: [
                    { livestockType: "Pig", livestockCount: 3 },
                    { livestockType: "Goat", livestockCount: 1 },
                ],
            },
            {
                lat: "13.4024",
                long: "121.2587",
                farmerUserId: "FRM-GHI7893",
                livestocks: [
                    { livestockType: "Cow", livestockCount: 4 },
                    { livestockType: "Chicken", livestockCount: 2 },
                    { livestockType: "Pig", livestockCount: 7 },
                ],
            },
            {
                lat: "13.1223",
                long: "121.3025",
                farmerUserId: "FRM-JKL0124",
                livestocks: [
                    { livestockType: "Cow", livestockCount: 6 },
                    { livestockType: "Pig", livestockCount: 4 },
                ],
            },
            {
                lat: "13.2875",
                long: "121.1743",
                farmerUserId: "FRM-MNO3455",
                livestocks: [
                    { livestockType: "Chicken", livestockCount: 3 },
                    { livestockType: "Goat", livestockCount: 2 },
                ],
            },
            {
                lat: "13.1567",
                long: "121.0379",
                farmerUserId: "FRM-PQR6786",
                livestocks: [
                    { livestockType: "Cow", livestockCount: 5 },
                    { livestockType: "Chicken", livestockCount: 6 },
                    { livestockType: "Goat", livestockCount: 3 },
                ],
            },
            {
                lat: "13.4098",
                long: "121.1846",
                farmerUserId: "FRM-STU9017",
                livestocks: [
                    { livestockType: "Pig", livestockCount: 5 },
                    { livestockType: "Goat", livestockCount: 4 },
                ],
            },
            {
                lat: "13.2753",
                long: "121.0632",
                farmerUserId: "FRM-VWX2348",
                livestocks: [
                    { livestockType: "Chicken", livestockCount: 7 },
                    { livestockType: "Pig", livestockCount: 3 },
                ],
            },
            {
                lat: "13.3462",
                long: "121.2269",
                farmerUserId: "FRM-YZAB5679",
                livestocks: [
                    { livestockType: "Cow", livestockCount: 3 },
                    { livestockType: "Pig", livestockCount: 6 },
                ],
            },
            {
                lat: "13.1739",
                long: "121.2821",
                farmerUserId: "FRM-CDEF8910",
                livestocks: [
                    { livestockType: "Cow", livestockCount: 2 },
                    { livestockType: "Chicken", livestockCount: 4 },
                    { livestockType: "Goat", livestockCount: 2 },
                ],
            },
        ];

        return Promise.resolve(livestockMappingData);
    },

    getLivestockForBreeding() {
        const livestocks = [
            {
                id: "1",
                livestockTagId: "CTL-101",
                livestockTypeId: "3",
                sex: "Male",
                farmerId: "1",
                farmerUserId: "FMR-AC12312",
                farmerName: "Aba Cus",
            },
            {
                id: "2",
                livestockTagId: "CTL-102",
                livestockTypeId: "3",
                sex: "Female",
                farmerId: "1",
                farmerUserId: "FMR-AC12312",
                farmerName: "Aba Cus",
            },
            {
                id: "4",
                livestockTagId: "PG-101",
                livestockTypeId: "2",
                sex: "Male",
                farmerId: "2",
                farmerUserId: "FMR-bd12312",
                farmerName: "Ba Doy",
            },
            {
                id: "5",
                livestockTagId: "PG-102",
                livestockTypeId: "2",
                sex: "Female",
                farmerId: "2",
                farmerUserId: "FMR-bd12312",
                farmerName: "Ba Doy",
            },
            {
                id: "6",
                livestockTagId: "PG-102",
                livestockTypeId: "2",
                sex: "Female",
                farmerId: "3",
                farmerUserId: "FMR-CE12312",
                farmerName: "CaK E",
            },
        ];

        return Promise.resolve(livestocks);
    },
};
