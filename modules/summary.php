
    
    
    <div class="col-12 mb-2">
        <div class="card">
            <div class="card-body">
                <h2>Welcome back,<?php echo ' ' . $_SESSION['FName']; ?>!</h2>
                <small class="text-muted">View the daily summary of inbound and outbound data to track inventory changes and trends.</small>
            </div>
        </div>
    </div>

    <div class="container mt-5">
    <div class="row">
      <!-- Left Card for Inbound/Outbound Summary -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Inbound and Outbound Summary</h5>
            <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                  <th>Type</th>
                  <th>Quantity</th>
                  <th>Value</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Inbound</td>
                  <td id="inbound-quantity">50</td>
                  <td id="inbound-value">₱5000</td>
                </tr>
                <tr>
                  <td>Outbound</td>
                  <td id="outbound-quantity">30</td>
                  <td id="outbound-value">₱3000</td>
                </tr>
              </tbody>
            </table>
            <div class="d-flex justify-content-end">
            <button class="btn me-2" id="printSummary" style="background-color: #bf1c2c; border-color: #bf1c2c; color: white;">Print</button>
            <button class="btn" id="saveSummary" style="background-color: #bf1c2c; border-color: #bf1c2c; color: white;">Save Summary</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Card for Summary Archive -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Summary Archive</h5>
            <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                  <th>Date</th>
                  <th>Inbound</th>
                  <th>Outbound</th>
                </tr>
              </thead>
              <tbody id="archiveTable">
                <!-- Archive Dates and Summaries will be populated here -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Sample data for the current month
    const sampleData = [
      { date: '2024-12-01', inbound: { quantity: 40, value: '$4000' }, outbound: { quantity: 25, value: '$2500' }},
      { date: '2024-12-02', inbound: { quantity: 45, value: '$4500' }, outbound: { quantity: 20, value: '$2000' }},
      { date: '2024-12-03', inbound: { quantity: 50, value: '$5000' }, outbound: { quantity: 30, value: '$3000' }},
      // Add more sample data for the rest of the month...
    ];

    // Populate the archive table with the dates of the current month
    const archiveTable = document.getElementById('archiveTable');
    sampleData.forEach(item => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td><a href="#" class="archive-date" data-date="${item.date}">${item.date}</a></td>
        <td>${item.inbound.quantity}</td>
        <td>${item.outbound.quantity}</td>
      `;
      archiveTable.appendChild(row);
    });

    // Function to update the inbound and outbound summary based on the clicked date
    function updateSummary(date) {
      const selectedData = sampleData.find(item => item.date === date);
      if (selectedData) {
        document.getElementById('inbound-quantity').textContent = selectedData.inbound.quantity;
        document.getElementById('inbound-value').textContent = selectedData.inbound.value;
        document.getElementById('outbound-quantity').textContent = selectedData.outbound.quantity;
        document.getElementById('outbound-value').textContent = selectedData.outbound.value;
      }
    }

    // Add event listener to archive dates
    archiveTable.addEventListener('click', function(event) {
      if (event.target.classList.contains('archive-date')) {
        const selectedDate = event.target.dataset.date;
        updateSummary(selectedDate);
      }
    });

    // Print functionality (for now it logs to console)
    document.getElementById('printSummary').addEventListener('click', function() {
      console.log('Printing the summary...');
      // You can implement actual printing functionality here
    });

    // Save Summary functionality (for now it logs to console)
    document.getElementById('saveSummary').addEventListener('click', function() {
      console.log('Saving the summary...');
      // Implement saving functionality (e.g., make an AJAX call to save the data)
    });
  </script>