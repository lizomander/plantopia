
document.addEventListener('DOMContentLoaded', function () {
    // Attach event listeners to all wishlist buttons
    document.querySelectorAll('.wishlist-btn').forEach(button => {
        button.addEventListener('click', function () {
            const pid = this.dataset.pid; // Product ID
            const action = this.dataset.action; // Current action (add/remove)

            // Make a POST request to wishlist.php
            fetch('wishlist.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `pid=${pid}&action=${action}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update button state dynamically
                    if (action === 'add') {
                        this.dataset.action = 'remove';
                        this.textContent = 'Remove from Wishlist';
                    } else if (action === 'remove') {
                        this.dataset.action = 'add';
                        this.textContent = 'Add to Wishlist';
                    }

                    // Show success notification
                    showToast(data.message, 'success');
                } else {
                    // Show error notification
                    showToast(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.', 'error');
            });
        });
    });

    // Function to show toast notifications
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
});
