document.addEventListener('DOMContentLoaded', function() {
    const createAccountForm = document.getElementById('createAccountForm');
    const accountCreationToast = new bootstrap.Toast(document.getElementById('accountCreationToast'));
    const toastMessage = document.getElementById('toastMessage');

    createAccountForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        const formData = new FormData(createAccountForm);

        // Log all form data
        console.log('Form Data:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // Manually add the register field if it's missing
        if (!formData.has('register')) {
            formData.append('register', 'Create Account');
        }

        fetch('classes/register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Parsed response:', data);

            // Set toast color and message based on success
            if (data.success) {
                toastMessage.classList.remove('text-danger');
                toastMessage.classList.add('text-success');
                setTimeout(() => {
                    location.reload(); // Reload the page after 1 second.
                }, 1000);
            } else {
                toastMessage.classList.remove('text-success');
                toastMessage.classList.add('text-danger');
            }

            // Set toast message
            toastMessage.textContent = data.message;

            // Show toast
            accountCreationToast.show();

            // Reset form if successful
            if (data.success) {
                createAccountForm.reset();
                // Close the modal
                const modalElement = document.getElementById('createAccountModal');
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();
            }
        })
        .catch(error => {
            console.error('Full error:', error);
            toastMessage.classList.remove('text-success');
            toastMessage.classList.add('text-danger');
            toastMessage.textContent = 'An unexpected error occurred.';
            accountCreationToast.show();
        });
    });
});