document.addEventListener('DOMContentLoaded', () => {
    const categoryLinks = document.querySelectorAll('.category-link');

    categoryLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const category = this.getAttribute('data-category');
            const modalTitle = document.getElementById('categoryHistoryModalLabel');
            const modalContent = document.getElementById('categoryHistoryContent');

            // Set modal title
            modalTitle.textContent = `Distribution History: ${category}`;

            // Define dummy data
            const dummyData = {
                Laptops: [
                    { Transfer_ID: 'D101', Item_ID: 'L001', Item_Name: 'Laptop A', Quantity: 10, Transfer_From: 'Warehouse 1', Transfer_To: 'Branch 2', Status: 'Completed' },
                    { Transfer_ID: 'D102', Item_ID: 'L002', Item_Name: 'Laptop B', Quantity: 5, Transfer_From: 'Warehouse 3', Transfer_To: 'Branch 1', Status: 'Pending' },
                ],
                Phones: [
                    { Transfer_ID: 'D103', Item_ID: 'P001', Item_Name: 'Phone A', Quantity: 15, Transfer_From: 'Warehouse 2', Transfer_To: 'Branch 4', Status: 'Completed' },
                    { Transfer_ID: 'D104', Item_ID: 'P002', Item_Name: 'Phone B', Quantity: 8, Transfer_From: 'Warehouse 1', Transfer_To: 'Branch 3', Status: 'Pending' },
                ],
                Default: [
                    { Transfer_ID: 'D105', Item_ID: 'X001', Item_Name: 'Misc Item', Quantity: 20, Transfer_From: 'Warehouse 5', Transfer_To: 'Branch 6', Status: 'In Progress' },
                ]
            };

            // Select the relevant data or use default
            const records = dummyData[category] || dummyData.Default;

            // Build table
            const table = `
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Distribution ID</th>
                            <th>Item ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${records.map(record => `
                            <tr>
                                <td>${record.Transfer_ID}</td>
                                <td>${record.Item_ID}</td>
                                <td>${record.Item_Name}</td>
                                <td>${record.Quantity}</td>
                                <td>${record.Transfer_From}</td>
                                <td>${record.Transfer_To}</td>
                                <td><span class="badge bg-${record.Status === 'Completed' ? 'success' : record.Status === 'Pending' ? 'warning' : 'primary'}">${record.Status}</span></td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;

            // Update modal content
            modalContent.innerHTML = table;

            // Show the modal
            const categoryHistoryModal = new bootstrap.Modal(document.getElementById('categoryHistoryModal'));
            categoryHistoryModal.show();
        });
    });
});
