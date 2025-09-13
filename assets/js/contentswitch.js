document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".nav-link[data-target]");
    const sections = document.querySelectorAll(".content-section");

    // Function to handle sidebar link styles
    function updateActiveLink(activeLink) {
        navLinks.forEach(nav => {
            nav.classList.remove("active"); // Remove active class from all links
            const icon = nav.querySelector("i");
            if (icon) {
                icon.classList.remove("bg-secondary", "p-2", "shadow"); // Remove bg-secondary and reset icon box shadow
            }
        });
        activeLink.classList.add("active"); // Add active class to clicked link

        // Add the bg-secondary box and shadow to the icon of the active link
        const icon = activeLink.querySelector("i");
        if (icon) {
            icon.classList.add("bg-secondary", "p-2", "shadow"); // Add lighter dark box and shadow to the icon
        }
    }

    // Function to set up branch switching
    function setupBranchSwitching() {
        const branchSelector = document.getElementById("branchSelector");
        const tables = {
            main: document.getElementById("mainBranchTable"),
            branch1: document.getElementById("branch1Table"),
            branch2: document.getElementById("branch2Table")
        };

        // Handle branch selection changes
        branchSelector.addEventListener("change", function () {
            const selectedBranch = branchSelector.value;

            // Hide all tables
            for (const tableKey in tables) {
                tables[tableKey].classList.add("d-none");
            }

            // Show the selected branch's table
            tables[selectedBranch].classList.remove("d-none");
        });
    }

    // Initialize branch switching
    setupBranchSwitching();
});
