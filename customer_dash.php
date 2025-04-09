<?php
session_start();

// Check if the user is logged in and has the correct role (admin)
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'customer') {
    // Redirect to another page if the user is not a customer
    header("Location: index.html"); // Redirect to the homepage
    exit();
}

// If the user is an admin, display the page content
echo "Welcome to the Customer Dashboard, " . $_SESSION['username'];
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
        <!--Customer Dashboard Section-->
        <section id="customer-dash">
            <div class="dash-body">
                <h1>Customer Dashboard</h1>
                <!-- Profile details Section -->
                <h3>Profile Details</h3>
                <table id="profileTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Program</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody></tbody> <!--Table body will be displayed by JavaScript--> 
                </table>
                <!-- Schedule Section -->
                <h3>Schedule</h3>
                <table id="scheduleTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Trainer</th>
                            <th>Info</th>
                        </tr>
                    </thead>
                    <tbody></tbody> <!--Table body will be displayed by JavaScript--> 
                </table>
            </div>
        </section>
        <!--End of Customer Dashboard Section-->
        <!--footer-->
        <footer>
            <div class="footer-content container pt-5">
                <div class="row mx-auto">
                    <!-- Link Container 1 -->
                    <div class="col-6 col-md-3 mb-4">
                        <h1>Links</h1>
                        <ul class="list-unstyled">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Memberships</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- Link Container 2 -->
                    <div class="col-6 col-md-3 mb-4">
                        <h1>Links</h1>
                        <ul class="list-unstyled">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Memberships</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- Map Container -->
                    <div class="col-12 col-md-5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d905.262346816871!2d80.35995476953639!3d7.481267629222137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae33b1832d262e9%3A0xed51c18e5a92717e!2sJail%20Fitness!5e1!3m2!1sen!2slk!4v1743825430210!5m2!1sen!2slk" width="300px" height="200px" style="border: solid 1px; border-radius: 5px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="text-center p-3">
                <p>&copy; 2025 Fitzone Fitness Center. All rights reserved.</p>
                <a href="#" class="text-dark">Privacy Policy</a> | 
                <a href="#" class="text-dark">Terms of Service</a>
            </div>
        </footer>
        <!--end of footer-->
        <!--JavaScript and Bootstrap JS-->
        <script src="jquery.min.js_2.1.3/cdnjs/jquery.min.js"></script>
        <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script> 
        <!--Script for dislaying login and profile dropdown-->
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
        <!--Script for loading data into tables-->
        <script>
            fetch('load_customer_data.php')
                .then(response => response.json())
                .then(data => {
                    // Load User Details
                    const userTableBody = document.querySelector("#profileTable tbody");
                    data.users.forEach(user => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${user.fName}</td>
                            <td>${user.lName}</td>
                            <td>${user.email}</td>
                            <td>${user.program}</td>
                            <td>${user.duration}</td>
                        `;
                        userTableBody.appendChild(row);
                    });

                    // Load Schedule Details
                    const scheduleTableBody = document.querySelector("#scheduleTable tbody");
                    data.schedule.forEach(sched => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${sched.date}</td>
                            <td>${sched.time}</td>
                            <td>${sched.trainer}</td>
                            <td>${sched.info}</td>
                        `;
                        scheduleTableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error("Failed to load data:", error);
                });
        </script>
        <!--Script for login and logout functionality-->
        <script src="login.js" defer></script>
        <script src="logout.js" defer></script>
    </body>
</html>