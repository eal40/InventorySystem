// Sample data structure organized by branch
const branchSalesData = {
    main: {
        daily: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            motorparts: [1500, 1800, 1600, 1900, 2100, 1700, 1400],
            accessories: [800, 900, 850, 950, 1000, 900, 750],
            consumables: [2000, 2200, 2100, 2300, 2400, 2200, 1900]
        },
        weekly: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            motorparts: [10500, 11200, 12000, 11500],
            accessories: [5800, 6200, 6500, 6000],
            consumables: [15000, 16000, 16500, 15500]
        },
        monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            motorparts: [45000, 48000, 50000, 47000, 52000, 49000],
            accessories: [25000, 27000, 28000, 26000, 29000, 27500],
            consumables: [60000, 63000, 65000, 62000, 67000, 64000]
        },
        yearly: {
            labels: ['2020', '2021', '2022', '2023'],
            motorparts: [540000, 580000, 600000, 620000],
            accessories: [300000, 320000, 340000, 360000],
            consumables: [720000, 750000, 780000, 800000]
        }
    },
    branch1: {
        daily: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            motorparts: [1200, 1400, 1300, 1600, 1800, 1500, 1100],
            accessories: [600, 700, 650, 750, 800, 700, 550],
            consumables: [1700, 1900, 1800, 2000, 2100, 1900, 1600]
        },
        weekly: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            motorparts: [9000, 9500, 10000, 9800],
            accessories: [4500, 4800, 5000, 4700],
            consumables: [12500, 13000, 13500, 12800]
        },
        monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            motorparts: [38000, 40000, 42000, 39000, 43000, 41000],
            accessories: [20000, 21000, 22000, 20500, 23000, 21500],
            consumables: [50000, 52000, 54000, 51000, 55000, 53000]
        },
        yearly: {
            labels: ['2020', '2021', '2022', '2023'],
            motorparts: [450000, 480000, 500000, 520000],
            accessories: [250000, 270000, 290000, 310000],
            consumables: [600000, 620000, 640000, 660000]
        }
    },
    branch2: {
        daily: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            motorparts: [1000, 1200, 1100, 1400, 1600, 1300, 900],
            accessories: [500, 600, 550, 650, 700, 600, 450],
            consumables: [1400, 1600, 1500, 1700, 1800, 1600, 1300]
        },
        weekly: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            motorparts: [8000, 8500, 9000, 8800],
            accessories: [3800, 4000, 4200, 3900],
            consumables: [10000, 10500, 11000, 10300]
        },
        monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            motorparts: [32000, 34000, 36000, 33000, 37000, 35000],
            accessories: [17000, 18000, 19000, 17500, 20000, 18500],
            consumables: [40000, 42000, 44000, 41000, 45000, 43000]
        },
        yearly: {
            labels: ['2020', '2021', '2022', '2023'],
            motorparts: [380000, 400000, 420000, 440000],
            accessories: [200000, 220000, 240000, 260000],
            consumables: [480000, 500000, 520000, 540000]
        }
    }
};

// Initialize chart
let branchSalesChart = null;

// Function to update the chart
function updateBranchChart() {
    const selectedBranch = document.getElementById('selectBranchDropdown').value;
    const selectedInterval = document.getElementById('branchTimeIntervalDropdown').value;
    const selectedData = branchSalesData[selectedBranch][selectedInterval];
    
    // Get checked product types
    const checkedTypes = ['motorparts', 'accessories', 'consumables'].filter(type => 
        document.getElementById(type).checked
    );

    // Prepare datasets
    const datasets = checkedTypes.map((type, index) => ({
        label: type.charAt(0).toUpperCase() + type.slice(1),
        data: selectedData[type],
        borderColor: getTypeColor(index),
        backgroundColor: getTypeColor(index, 0.1),
        tension: 0.4,
        fill: true
    }));

    // Destroy existing chart if it exists
    if (branchSalesChart) {
        branchSalesChart.destroy();
    }

    // Create new chart
    const ctx = document.getElementById('salesByTypeChart').getContext('2d');
    branchSalesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: selectedData.labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: `Sales by Product Type - ${selectedBranch.charAt(0).toUpperCase() + selectedBranch.slice(1)} (${selectedInterval.charAt(0).toUpperCase() + selectedInterval.slice(1)})`
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Sales Amount ($)'
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    });
}

// Helper function to get colors for different product types
function getTypeColor(index, alpha = 1) {
    const colors = [
        `rgba(54, 162, 235, ${alpha})`,   // Blue for Motorparts
        `rgba(255, 159, 64, ${alpha})`,   // Orange for Accessories
        `rgba(75, 192, 192, ${alpha})`    // Teal for Consumables
    ];
    return colors[index];
}

// Event listeners
document.getElementById('selectBranchDropdown').addEventListener('change', updateBranchChart);
document.getElementById('branchTimeIntervalDropdown').addEventListener('change', updateBranchChart);
document.querySelectorAll('#motorparts, #accessories, #consumables').forEach(checkbox => {
    checkbox.addEventListener('change', updateBranchChart);
});

// Initialize chart with default values
window.addEventListener('load', () => {
    // Set default checked state for product types
    document.querySelectorAll('#motorparts, #accessories, #consumables').forEach(checkbox => {
        checkbox.checked = true;
    });
    updateBranchChart();
});