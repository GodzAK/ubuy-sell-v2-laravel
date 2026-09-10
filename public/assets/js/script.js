
window.onload = function() {
    var modal = document.getElementById("notificationModal");
    if (modal) {
        modal.style.display = "block"; // Show the modal

        // Automatically close the modal after 5 seconds
        setTimeout(function() {
            closeModal();
        }, 5000);  // Close after 5 seconds
    }
}

// Function to close the modal
function closeModal() {
    var modal = document.getElementById("notificationModal");
    modal.style.display = "none";  // Hide the modal
}
function scrollLeft(containerId) {
    var container = document.getElementById(containerId);
    container.scrollLeft -= 200; // Scroll left by 200px
}

function scrollRight(containerId) {
    var container = document.getElementById(containerId);
    container.scrollLeft += 200; // Scroll right by 200px
}
window.onload = function() {
                const notification = document.getElementById('no-items-notification');
                notification.classList.add('show');
                setTimeout(function() {
                    notification.classList.remove('show');
                }, 4000); // Remove notification after 4 seconds
            };
   