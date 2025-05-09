<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Redirect to login if not logged in
    header("Location: index.html");
    exit();
}

$regID = $_SESSION['regID']; // Use regID from session
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

        <div class="container mt-5">
            <h2 class="mb-4">My Account Settings</h2>
            <form id="settingsForm" method="POST" action="update_user.php">
                <!-- Hidden regID -->
                <input type="hidden" name="regID" value="<?php echo $regID; ?>">

                <table class="table table-bordered settings-table">
                    <tr>
                        <th>First Name</th>
                        <td><input type="text" name="fName" id="fName" required></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><input type="text" name="lName" id="lName" required></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="email" name="email" id="email" required></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><input type="text" name="phoneNo" id="phoneNo" required></td>
                    </tr>
                </table>

                <button type="submit" class="btn btn-danger">Save Changes</button>
            </form>

            <!-- Hidden regID input for JS fetch -->
            <input type="hidden" id="regID" value="<?php echo $regID; ?>">
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const regID = document.getElementById("regID").value;

                fetch(`get_user.php?regID=${regID}`)
                    .then(response => response.json())
                    .then(user => {
                        if (!user.error) {
                            document.getElementById("fName").value = user.fName;
                            document.getElementById("lName").value = user.lName;
                            document.getElementById("email").value = user.email;
                            document.getElementById("phoneNo").value = user.phoneNo;
                        } else {
                            alert("Error: " + user.error);
                        }
                    })
                    .catch(err => console.error("Fetch error:", err));
            });
        </script>
         <!--SCRIPTS-->
        <!--Javascript and Bootstrap Libraries-->
        <script src="jquery.min.js_2.1.3/cdnjs/jquery.min.js"></script>
        <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script> 

        <!--Role based navigation script-->
        <script src="nav.js" defer></script> 
        <!--Logout Login scripts-->
        <script src="login.js" defer></script>
        <script src="logout.js" defer></script>
    </body>
</html>