document.addEventListener('DOMContentLoaded', function () {
    // Handle wishlist item removal
    document.querySelectorAll('.remove-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent any default behavior

            const pid = this.dataset.pid; // Get the product ID

            // Send a request to remove the item
            fetch('wishlist.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `pid=${pid}&action=remove`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the item from the page
                    const parentItem = this.closest('.wishlist-item');
                    if (parentItem) parentItem.remove();
                } else {
                    console.error('Error removing item from wishlist:', data.message);
                }
            })
            .catch(err => {
                console.error('Network error:', err);
            });
        });
    });

    // Handle heart toggle (for the product page)
    document.querySelectorAll('.wishlist-btn').forEach(button => {
        button.addEventListener('click', function () {
            const pid = this.dataset.pid;
            const action = this.dataset.action;

            fetch('wishlist.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `pid=${pid}&action=${action}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const img = this.querySelector('img');
                    if (action === 'add') {
                        this.dataset.action = 'remove';
                        img.src = 'img/heart-filled.png';
                    } else {
                        this.dataset.action = 'add';
                        img.src = 'img/heart-empty.png';
                    }
                } else {
                    console.error('Error updating wishlist:', data.message);
                }
            })
            .catch(err => {
                console.error('Network error:', err);
            });
        });
    });
});