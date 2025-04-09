document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from reloading the page
    
        // Get the username and password from the form inputs
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
    
        console.log("Username: " + username);  // Log username to see if it's undefined
        console.log("Password: " + password);  // Log password to see if it's undefined
    
        if (!username || !password) {
            alert("Username or Password is missing.");
            return;
        }

        // Create a FormData object to send the form data
        const formData = new FormData(); // Initialize formData here
        formData.append('username', username);
        formData.append('password', password);
        
        // Send the data to process_login.php using AJAX
        fetch('process_login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Parse JSON response
        .then(data => {
            console.log(data);  // Check the response data
            if (data.success) {
                // Handle success based on user role
                if (data.role === 'customer') {
                    window.location.href = 'customer_dash.html'; // Redirect to customer dashboard
                } else if (data.role === 'staff') {
                    window.location.href = 'staff_dash.html'; // Redirect to staff dashboard
                } else if (data.role === 'admin') {
                    window.location.href = 'admin_dash.html'; // Redirect to admin dashboard
                }
            } else {
                alert(data.message || 'Login failed! Please check your credentials.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        });
    });
});