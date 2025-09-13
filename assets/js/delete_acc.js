document.addEventListener("DOMContentLoaded", function() {
    // Check if there's a session message for delete status
    if (typeof deleteStatus !== 'undefined') {
        const status = deleteStatus;
        const statusMessage = status === 'success' 
            ? 'Account successfully deleted.' 
            : 'Failed to delete the account. Please try again.';

        document.getElementById('statusMessage').textContent = statusMessage;
        $('#statusModal').modal('show'); // Show the modal
    }
});
