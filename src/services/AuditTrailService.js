export const AuditTrailService = {
    getAuditTrail() {
        const data = [
            {
                id: "1",
                livestockId: "6",
                farmerId: "4",
                action: "Add",
                title: "Add New Livestock",
                description: "Add New Carabao Livestock, CRB-102",
                entityAffected: "Livestock",
                timestamp: "2024-02-22 14:23:02",
            },
            {
                id: "2",
                livestockId: "6",
                farmerId: "4",
                action: "Add",
                title: "Report Mortality Livestock",
                description:
                    "Report Livestock Carabao Mortality Record, CRB-102",
                entityAffected: "Mortality",
                timestamp: "2024-02-25 14:26:19",
            },
        ];

        return Promise.resolve(data);
    },
};
