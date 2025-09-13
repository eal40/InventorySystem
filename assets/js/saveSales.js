document.getElementById('salesForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form from submitting traditionally

    const formData = new FormData(this);

    fetch('classes/save_sales.php', {  // Update path if necessary
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success toast
                const toast = new bootstrap.Toast(document.getElementById('toastSuccess'));
                toast.show();

                // Reset the form
                this.reset();

                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('logSalesModal'));
                modal.hide();
            } else {
                alert(data.message); // Handle errors (optional)
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
