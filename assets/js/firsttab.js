// Sample data structure for different types and time intervals
const salesData = {
    motorparts: {
        daily: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            Main: [1500, 1800, 1600, 1900, 2100, 1700, 1400],
            'Branch 1': [1200, 1400, 1300, 1600, 1800, 1500, 1100],
            'Branch 2': [1000, 1200, 1100, 1400, 1600, 1300, 900]
        },
        weekly: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            Main: [10500, 11200, 12000, 11500],
            'Branch 1': [9000, 9500, 10000, 9800],
            'Branch 2': [8000, 8500, 9000, 8800]
        },
        monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            Main: [45000, 48000, 50000, 47000, 52000, 49000],
            'Branch 1': [38000, 40000, 42000, 39000, 43000, 41000],
            'Branch 2': [32000, 34000, 36000, 33000, 37000, 35000]
        },
        yearly: {
            labels: ['2020', '2021', '2022', '2023'],
            Main: [540000, 580000, 600000, 620000],
            'Branch 1': [450000, 480000, 500000, 520000],
            'Branch 2': [380000, 400000, 420000, 440000]
        }
    },
    accessories: {
        daily: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            Main: [800, 900, 850, 950, 1000, 900, 750],
            'Branch 1': [600, 700, 650, 750, 800, 700, 550],
            'Branch 2': [500, 600, 550, 650, 700, 600, 450]
        },
        weekly: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            Main: [5800, 6200, 6500, 6000],
            'Branch 1': [4500, 4800, 5000, 4700],
            'Branch 2': [3800, 4000, 4200, 3900]
        },
        monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            Main: [25000, 27000, 28000, 26000, 29000, 27500],
            'Branch 1': [20000, 21000, 22000, 20500, 23000, 21500],
            'Branch 2': [17000, 18000, 19000, 17500, 20000, 18500]
        },
        yearly: {
            labels: ['2020', '2021', '2022', '2023'],
            Main: [300000, 320000, 340000, 360000],
            'Branch 1': [250000, 270000, 290000, 310000],
            'Branch 2': [200000, 220000, 240000, 260000]
        }
    },
    consumables: {
        daily: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            Main: [2000, 2200, 2100, 2300, 2400, 2200, 1900],
            'Branch 1': [1700, 1900, 1800, 2000, 2100, 1900, 1600],
            'Branch 2': [1400, 1600, 1500, 1700, 1800, 1600, 1300]
        },
        weekly: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            Main: [15000, 16000, 16500, 15500],
            'Branch 1': [12500, 13000, 13500, 12800],
            'Branch 2': [10000, 10500, 11000, 10300]
        },
        monthly: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            Main: [60000, 63000, 65000, 62000, 67000, 64000],
            'Branch 1': [50000, 52000, 54000, 51000, 55000, 53000],
            'Branch 2': [40000, 42000, 44000, 41000, 45000, 43000]
        },
        yearly: {
            labels: ['2020', '2021', '2022', '2023'],
            Main: [720000, 750000, 780000, 800000],
            'Branch 1': [600000, 620000, 640000, 660000],
            'Branch 2': [480000, 500000, 520000, 540000]
        }
    }
};

// Initialize chart
let salesChart = null;

// Function to update the chart
function updateChart() {
    const selectedType = document.getElementById('selectTypeDropdown').value;
    const selectedInterval = document.getElementById('timeIntervalDropdown').value;
    const selectedData = salesData[selectedType][selectedInterval];
    
    // Get checked branches
    const checkedBranches = Array.from(document.getElementsByClassName('branch-checkbox'))
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);

    // Prepare datasets
    const datasets = checkedBranches.map((branch, index) => ({
        label: branch,
        data: selectedData[branch],
        borderColor: getColor(index),
        backgroundColor: getColor(index, 0.1),
        tension: 0.4,
        fill: true
    }));

    // Destroy existing chart if it exists
    if (salesChart) {
        salesChart.destroy();
    }

    // Create new chart
    const ctx = document.getElementById('salesTrendsChart').getContext('2d');
    salesChart = new Chart(ctx, {
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
                    text: `${selectedType.charAt(0).toUpperCase() + selectedType.slice(1)} Sales - ${selectedInterval.charAt(0).toUpperCase() + selectedInterval.slice(1)}`
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

// Helper function to get colors for different branches
function getColor(index, alpha = 1) {
    const colors = [
        `rgba(75, 192, 192, ${alpha})`,  // Teal
        `rgba(255, 99, 132, ${alpha})`,  // Pink
        `rgba(255, 205, 86, ${alpha})`   // Yellow
    ];
    return colors[index];
}

// Event listeners
document.getElementById('selectTypeDropdown').addEventListener('change', updateChart);
document.getElementById('timeIntervalDropdown').addEventListener('change', updateChart);
document.querySelectorAll('.branch-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateChart);
});

// Initialize chart with default values
window.addEventListener('load', () => {
    // Set default checked state for branches
    document.querySelectorAll('.branch-checkbox').forEach(checkbox => {
        checkbox.checked = true;
    });
    updateChart();
});