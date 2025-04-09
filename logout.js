document.addEventListener("DOMContentLoaded", function () {
    const logoutLink = document.getElementById("logoutLink");

    if (logoutLink) {
        logoutLink.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default link behavior

            fetch("process_logout.php")
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Clear login-related data
                        localStorage.removeItem("username"); // Remove username from localStorage
                        sessionStorage.clear();  // Optionally clear sessionStorage
                        
                        // Optionally show a success message
                        alert("You have successfully logged out.");

                        // Redirect to home or login page
                        window.location.href = "index.html"; 
                    } else {
                        alert("Logout failed.");
                    }
                })
                .catch(error => {
                    console.error("Logout error:", error);
                });
        });
    }
});
