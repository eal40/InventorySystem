<div class="row">

    <!-- Welcome Message -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h2>Analytics Overview</h2>
                <small class="text-muted">Explore the latest data insights and gain a comprehensive overview of key metrics to stay informed and make data-driven decisions. </small>
            </div>
        </div>
    </div>

    <!-- Chart Tabs -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <ul class="nav nav-tabs card-header-tabs" id="analyticsTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="by-type-tab" data-bs-toggle="tab" href="#byType" role="tab" aria-controls="byType" aria-selected="true">By Type</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="by-branch-tab" data-bs-toggle="tab" href="#byBranch" role="tab" aria-controls="byBranch" aria-selected="false">By Branch</a>
                    </li>
                </ul>
            </div>

            <!-- Trend Chart -->
            <div class="card-body">
                <div class="tab-content" id="analyticsTabsContent">
                    <!-- By Type Tab -->
                    <div class="tab-pane fade show active" id="byType" role="tabpanel" aria-labelledby="by-type-tab">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Dropdown Group -->
                            <div class="d-flex align-items-center">
                                <!-- Select Type Dropdown -->
                                <div class="me-3">
                                    <label for="selectTypeDropdown" class="form-label me-2">Select Type:</label>
                                    <select id="selectTypeDropdown" class="form-select form-select-sm d-inline-block w-auto">
                                        <option value="motorparts">Motorparts</option>
                                        <option value="accessories">Accessories</option>
                                        <option value="consumables">Consumables</option>
                                    </select>
                                </div>
                                <!-- Time Interval Dropdown -->
                                <div>
                                    <label for="timeIntervalDropdown" class="form-label me-2">Time Interval:</label>
                                    <select id="timeIntervalDropdown" class="form-select form-select-sm d-inline-block w-auto">
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Branch Checkboxes -->
                            <div class="d-flex align-items-center">
                                <span class="me-2">Branch:</span>
                                <div class="form-check me-2">
                                    <input class="form-check-input branch-checkbox" type="checkbox" id="mainBranch" value="Main">
                                    <label class="form-check-label" for="mainBranch">Main</label>
                                </div>
                                <div class="form-check me-2">
                                    <input class="form-check-input branch-checkbox" type="checkbox" id="branch1" value="Branch 1">
                                    <label class="form-check-label" for="branch1">Branch 1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input branch-checkbox" type="checkbox" id="branch2" value="Branch 2">
                                    <label class="form-check-label" for="branch2">Branch 2</label>
                                </div>
                            </div>
                        </div>
                        <canvas id="salesTrendsChart" height="135"></canvas>
                    </div>

                    <!-- By Branch Tab -->
                    <div class="tab-pane fade" id="byBranch" role="tabpanel" aria-labelledby="by-branch-tab">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Dropdown Group -->
                            <div class="d-flex align-items-center">
                                <!-- Select Branch Dropdown -->
                                <div class="me-3">
                                    <label for="selectBranchDropdown" class="form-label me-2">Select Branch:</label>
                                    <select id="selectBranchDropdown" class="form-select form-select-sm d-inline-block w-auto">
                                        <option value="main">Main</option>
                                        <option value="branch1">Branch 1</option>
                                        <option value="branch2">Branch 2</option>
                                    </select>
                                </div>
                                <!-- Time Interval Dropdown -->
                                <div>
                                    <label for="branchTimeIntervalDropdown" class="form-label me-2">Time Interval:</label>
                                    <select id="branchTimeIntervalDropdown" class="form-select form-select-sm d-inline-block w-auto">
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Type Checkboxes -->
                            <div class="d-flex align-items-center">
                                <span class="me-2">Type:</span>
                                <div class="form-check me-2">
                                    <input class="form-check-input" type="checkbox" id="motorparts" value="motorparts">
                                    <label class="form-check-label" for="motorparts">Motorparts</label>
                                </div>
                                <div class="form-check me-2">
                                    <input class="form-check-input" type="checkbox" id="accessories" value="accessories">
                                    <label class="form-check-label" for="accessories">Accessories</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consumables" value="consumables">
                                    <label class="form-check-label" for="consumables">Consumables</label>
                                </div>
                            </div>
                        </div>
                        <canvas id="salesByTypeChart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Custom Styles -->
<style>
   /* Tabs active state */
   .nav-tabs .nav-link.active {
        color: #fff !important;
        background-color: #bf1c2c !important;
        border-color: #bf1c2c !important;
    }

    /* Inactive tabs */ 
    .nav-tabs .nav-link {
        color: #bf1c2c !important;
    }

    .nav-tabs .nav-link:hover {
        color: #bf1c2c !important;
    }

    /* Checkbox styles */
    .form-check-input:checked {
        background-color: #bf1c2c !important;
        border-color: #bf1c2c !important;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(191, 28, 44, 0.25) !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/firsttab.js"></script>
<script src="assets/js/secondtab.js"></script>
