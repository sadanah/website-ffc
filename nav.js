// This script handles the navigation bar functionality, including login/logout and displaying the username.
// It checks if the user is logged in by checking localStorage for a username and role.
window.addEventListener('DOMContentLoaded', function () {
    const loginBtn = document.getElementById('loginBtn');
    const profileDropdown = document.getElementById('profileDropdown');
    const usernameDisplay = document.getElementById('usernameDisplay');
    const username = localStorage.getItem("username");

    // If the user is logged in
    if (username) {
        if (loginBtn) loginBtn.style.display = "none"; // Hide Login Button
        if (profileDropdown) profileDropdown.style.display = "block"; // Show Profile Dropdown
        if (usernameDisplay) usernameDisplay.textContent = username; // Display Username
    } else {
        if (loginBtn) loginBtn.style.display = "block"; // Show Login Button
        if (profileDropdown) profileDropdown.style.display = "none"; // Hide Profile Dropdown
    }

    // Adding correct links for dashboard and logout
    const dashboardLink = document.getElementById('dashboardLink');
    const logoutLink = document.getElementById('logoutLink');
    const role = localStorage.getItem("role");

    if (dashboardLink) {
        // Redirect based on user role
        if (role === 'customer') {
            dashboardLink.href = "customer_dash.php"; // Redirect to customer dashboard
        } else if (role === 'staff') {
            dashboardLink.href = "staff_dash.php"; // Redirect to staff dashboard
        } else if (role === 'admin') {
            dashboardLink.href = "admin_dash.php"; // Redirect to admin dashboard
        } else {
            // Fallback if no valid role is found
            dashboardLink.href = "index.html"; // Or any default page
        }
    }

    if (logoutLink) {
        logoutLink.addEventListener('click', function () {
            // Clear localStorage
            localStorage.removeItem("username");
            localStorage.removeItem("role");

            // Redirect to the login page
            window.location.href = "index.html"; // Redirect to login page
        });
    }
});
