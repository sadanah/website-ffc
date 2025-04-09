<?php
session_start();

// Check if the user is logged in and has the correct role (admin)
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    // Redirect to another page if the user is not an staff
    header("Location: index.html"); // Redirect to the homepage
    exit();
}

// If the user is an admin, display the page content
echo "Welcome to the Staff Dashboard, " . $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="styles.css"/>
        <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <style>
        .navbar-nav .dropdown-menu {
            position: static; /* Make the dropdown menu static */
        }
        </style>
    </head>
    <body>
        <!--Navigation Start-->
        <nav class="navbar navbar-light bg-light navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">
                    <img src="res/FFC_Logo.png" alt="Logo" style="height: 40px;"> <!--FFC Logo-->
                </a>
                <!--Creating responsive navigation toggle-->
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--Navigation bar links (collapses according to screen sizes)-->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="about.html" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About Us
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item" href="about.html#our-story">Our Story</a></li>
                                <li><a class="dropdown-item" href="about.html#vision-mission">Vision & Mission</a></li>
                                <li><a class="dropdown-item" href="about.html#our-team">Our Trainers</a></li>
                                <li><a class="dropdown-item" href="about.html#facilities">Our Facilities</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Memberships
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item" href="memberships.html#personal">Personal Training</a></li>
                                <li><a class="dropdown-item" href="memberships.html#group">Group Training</a></li>
                                <li><a class="dropdown-item" href="memberships.html#functional">Functional Training</a></li>
                                <li><a class="dropdown-item" href="memberships.html#general">General Access</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="registration.html">Register</a></li>
                    </ul>
                    <!-- Updated Navbar with Profile Section -->
                    <!-- Placeholder for Login Button and Profile Dropdown -->
                    <ul class="navbar-nav ms-auto" id="authNav">
                        <!-- Login Button -->
                        <li class="nav-item" id="loginBtn" style="display: none;">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Login <img src="res/profilee.svg" style="height: 40px; border-radius: 50%;">
                            </a>
                        </li>
                        <!-- Profile Section for Logged-in Users -->
                        <li class="nav-item dropdown" id="profileDropdown" style="display: none;">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- Display Username before Profile Icon -->
                                <span id="usernameDisplay" class="me-2"></span>
                                <img src="res/profilee.svg" style="height: 40px; border-radius: 50%;">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdownMenuLink">
                                <a class="dropdown-item" href="#" id="dashboardLink">Dashboard</a>
                                <a class="dropdown-item" href="#" id="settingsLink">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="logoutLink">Logout</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!--End of Navigation Bar-->
        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <button type="submit" class="btn btn-danger px-4 mt-2">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Login Modal -->
        <section id="staff-dash">
            <div class="dash-body">
                <h1>Staff Dashboard</h1>
                <!-- Contact Requests Section -->
                <h3>Contact Requests</h3>
                <table id="contactTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody></tbody> <!--Table body will be displayed by JavaScript--> 
                </table>
                <!-- Registration Requests Section -->
                <h3>Registration Requests</h3>
                <table id="registrationTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Program</th>
                            <th>Duration</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody></tbody> <!--Table body will be displayed by JavaScript--> 
                </table>
            </div>
        </section>
        <!--End of Admin Dashboard Section-->
        <!--Footer Section-->
        <footer class="footer text-center text-lg-start bg-light text-muted">
            <div class="text-center p-4">
                © 2025 Fitzone Fitness. All rights reserved.
            </div>
        </footer>
        <!--End of Footer Section-->
        <!--JavaScript and Bootstrap JS-->
        <script src="jquery.min.js_2.1.3/cdnjs/jquery.min.js"></script>
        <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script> 
        <script>
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
        </script> 
        
        <script>
            fetch('load_data.php')
                .then(response => response.json())
                .then(data => {
                    // Load Contact Requests
                    const contactTableBody = document.querySelector("#contactTable tbody");
                    data.contacts.forEach(contact => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${contact.conID}</td>
                            <td>${contact.fName}</td>
                            <td>${contact.lName}</td>
                            <td>${contact.email}</td>
                            <td>${contact.message}</td>
                        `;
                        contactTableBody.appendChild(row);
                    });

                    // Load Registration Requests
                    const regTableBody = document.querySelector("#registrationTable tbody");
                    data.registrations.forEach(reg => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${reg.regID}</td>
                            <td>${reg.fName}</td>
                            <td>${reg.lName}</td>
                            <td>${reg.email}</td>
                            <td>${reg.phoneNo}</td>
                            <td>${reg.program}</td>
                            <td>${reg.duration}</td>
                            <td>${reg.role}</td>
                        `;
                        regTableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error("Failed to load data:", error);
                });
        </script>
        <script src="login.js" defer></script>
        <script src="logout.js" defer></script>
    </body>
</html>