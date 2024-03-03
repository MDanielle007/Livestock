export const VaccinationService = {
    getVaccinationData() {
        const vaccinationData = [
            {
                id: "1",
                vaccineAdministratorId: "4",
                livestockId: "6",
                vaccinationName: "Vaxxxx1",
                vaccinationDescription: "Vaccine 1",
                vaccinationDate: "2024-02-17",
                recordStatus: "Accessible",
                livestockTagId: "CRB-102",
                livestockTypeId: "1",
                livestockAgeClassId: "1",
                administratorName: "Marc Danielle Cabatay",
            },
            {
                id: "2",
                vaccineAdministratorId: "4",
                livestockId: "8",
                vaccinationName: "Vaxxxx2",
                vaccinationDescription: "Vaccine 2",
                vaccinationDate: "2024-02-26",
                recordStatus: "Accessible",
                livestockTagId: "CHK-101",
                livestockTypeId: "3",
                livestockAgeClassId: "4",
                administratorName: "Marc Danielle Cabatay",
            },
        ];

        return Promise.resolve(vaccinationData);
    },
};
