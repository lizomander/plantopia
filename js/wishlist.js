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
                    } else {
                        this.dataset.action = 'add';
                        this.textContent = 'Add to Wishlist';
                    }
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});