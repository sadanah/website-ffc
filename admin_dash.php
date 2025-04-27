<?php
session_start();

// Check if the user is logged in and has the correct role (admin)
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // Redirect to another page if the user is not an admin
    header("Location: index.html"); // Redirect to the homepage
    exit();
}

// If the user is an admin, display the page content
echo "Welcome to the Admin Dashboard, " . $_SESSION['username'];
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

        <!--Admin Dashboard Section-->
        <section id="admin-dash">
            <div class="dash-body">
                <h1>Admin Dashboard</h1>
                <div class="admin-actions">
                    <button id="addUserBtn" class="btn btn-danger">Add User</button>
                </div>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody> <!--Table body will be displayed by JavaScript--> 
                </table>
                <div id="contactPagination" class="pagination"></div>
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
                            <th>Username</th>
                            <th>Program</th>
                            <th>Duration</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody> <!--Table body will be displayed by JavaScript--> 
                </table>
                <div id="registrationPagination" class="pagination"></div>
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

        <!--MODALS-->
        <!-- Add User Modal -->
        <div id="addUserModal" class="modal">
            <div class="modal-content px-5">
                <div class="modal-header mb-4">
                    <p id="modal-text">Add New User</p>
                    <span class="close" id="closeAddModal">&times;</span>
                </div>
                <form id="addUserForm" action="add_user.php" method="POST">
                    <div class="mb-4">
                        <label for="addName" class="form-label">Name</label>
                        <div class="col d-flex gap-2">
                            <input type="text" class="form-control" id="addFName" name="addFName" placeholder="First Name" required>
                            <input type="text" class="form-control" id="addLName" name="addLName" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="addEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="addEmail" name="addEmail" required>
                    </div>
                    <div class="mb-4">
                        <label for="addName" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="addPhoneNo" name="addPhoneNo" required>
                    </div>
                    <div class="mb-4">
                        <label for="addUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="addUsername" name="addUsername" required>
                    </div>
                    <div class="mb-4">
                        <label for="addPassword" class="form-label">Password</label>
                        <div class="col d-flex gap-2">
                            <input type="password" class="form-control" id="addPassword" name="addPassword" placeholder="Password" required>
                            <input type="password" class="form-control" id="conPassword" name="conPassword" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="addRole" class="form-label">Role: *leave empty for customer accounts</label>
                        <select class="form-select" id="addRole" name="addRole" required>
                            <option value="" selected disabled>Select a role</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>  
                    <div class="mb-4">
                        <label for="addProgram" class="form-label">Program: *leave empty for admin/staff accounts.</label>
                        <select class="form-select" id="addProgram" name="addProgram">
                            <option value="" selected disabled>Select a program</option>
                            <option value="personal-training">Personal Training</option>
                            <option value="group-training">Group Training</option>
                            <option value="functional-training">Functional Training</option>
                            <option value="general-access">General Access</option>
                        </select>
                        </div>
                        
                        <div class="mb-4">
                        <label for="addDuration" class="form-label">Membership Duration: *leave empty for admin/staff accounts.</label>
                        <select class="form-select" id="addDuration" name="addDuration">
                            <option value="" selected disabled>Select duration</option>
                            <option value="1-month">1 Month</option>
                            <option value="3-months">3 Months</option>
                            <option value="6-months">6 Months</option>
                            <option value="1-year">1 Year</option>
                        </select>
                        </div>
                    <button type="submit" class="btn btn-danger mt-5">Add New User</button>
                </form>
            </div>
        </div>

        <!-- Modify User Modal -->
        <div id="editUserModal" class="modal">
            <div class="modal-content px-5">
                <div class="modal-header mb-4">
                    <p id="modal-text">Modify User</p>
                    <span class="close" id="closeEditModal">&times;</span>
                </div>
                <form id="editUserForm" action="update_user.php" method="POST">
                    <!-- Hidden ID field -->
                    <input type="hidden" id="regID" name="regID">

                    <div class="mb-4">
                        <label for="editName" class="form-label">Name</label>
                        <div class="col d-flex gap-2">
                            <input type="text" class="form-control" id="editFName" name="fName" placeholder="First Name" required>
                            <input type="text" class="form-control" id="editLName" name="lName" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="editPhoneNo" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="editPhoneNo" name="phoneNo" required>
                    </div>

                    <div class="mb-4">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="username" required>
                    </div>

                    <div class="mb-4">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" id="editRole" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="editProgram" class="form-label">Program</label>
                        <select class="form-select" id="editProgram" name="program">
                            <option value="">None</option>
                            <option value="personal-training">Personal Training</option>
                            <option value="group-training">Group Training</option>
                            <option value="functional-training">Functional Training</option>
                            <option value="general-access">General Access</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="editDuration" class="form-label">Membership Duration</label>
                        <select class="form-select" id="editDuration" name="duration">
                            <option value="">None</option>
                            <option value="1-month">1 Month</option>
                            <option value="3-months">3 Months</option>
                            <option value="6-months">6 Months</option>
                            <option value="1-year">1 Year</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Update User</button>
                </form>
            </div>
        </div>
        <!-- End of Modify User Modal -->

        <!-- Delete User Modal -->
        <div id="deleteUserModal" class="modal">
        </div>
        <!-- End of Delete User Modal -->
        <!-- END OF MODALS -->


        <!--SCRIPTS-->
        <!--Javascript and Bootstrap Libraries-->
        <script src="jquery.min.js_2.1.3/cdnjs/jquery.min.js"></script>
        <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script> 

        <!--Role based navigation script-->
        <script src="nav.js" defer></script> 

        <!--Pagination Script-->
        <script>
function paginateTable(tableId, paginationId, rowsPerPage) {
    const table = document.getElementById(tableId);
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));
    const pagination = document.getElementById(paginationId);
    let currentPage = 1;
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? "" : "none";
        });

        [...pagination.children].forEach(btn => btn.classList.remove("active"));
        if (pagination.children[page - 1]) pagination.children[page - 1].classList.add("active");
    }

    function createPagination() {
        pagination.innerHTML = "";
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.classList.add("page-btn");
            if (i === currentPage) btn.classList.add("active");

            btn.addEventListener("click", () => {
                currentPage = i;
                showPage(currentPage);
            });

            pagination.appendChild(btn);
        }
    }

    createPagination();
    showPage(currentPage);
}

paginateTable("contactTable", "contactPagination", 5); // show 5 rows per page
paginateTable("registrationTable", "registrationPagination", 5);
</script>


        <!--Modals Script-->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Modal logic for Add User
                const addUserBtn = document.getElementById("addUserBtn");
                const addUserModal = document.getElementById("addUserModal");
                const closeAddModal = document.getElementById("closeAddModal");

                // Show Add User modal
                addUserBtn.onclick = () => addUserModal.style.display = "block";
                // Close Add User modal
                closeAddModal.onclick = () => addUserModal.style.display = "none";
                
                // Modal logic for Edit User
                const editUserModal = document.getElementById("editUserModal");
                const closeEditModal = document.getElementById("closeEditModal");
                closeEditModal.onclick = () => editUserModal.style.display = "none"; // Close Edit User modal

                // Close modals when clicking the close button or outside the modal
                window.onclick = e => {
                    if (e.target == addUserModal) addUserModal.style.display = "none"; // Close Add User modal if clicked outside
                    if (e.target == editUserModal) editUserModal.style.display = "none"; // Close Edit User modal if clicked outside
                };

                // Function to fetch user data and populate the modal for editing
                function populateModal(regID) {
                    console.log("regID passed to populateModal:", regID); // Log regID
                    // Fetch user data from get_user.php using the regID
                    fetch(`get_user.php?regID=${regID}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                console.error(data.error);
                                return;
                            }
                            // Check if modal elements exist before setting their values
                            const editFName = document.getElementById('editFName');
                            const editLName = document.getElementById('editLName');
                            const editEmail = document.getElementById('editEmail');
                            const editPhoneNo = document.getElementById('editPhoneNo');
                            const editUsername = document.getElementById('editUsername');
                            const editProgram = document.getElementById('editProgram');
                            const editDuration = document.getElementById('editDuration');
                            const editRole = document.getElementById('editRole');

                            if (editFName && editLName && editEmail && editPhoneNo && editUsername && editProgram && editDuration && editRole) {
                                editFName.value = data.fName;
                                editLName.value = data.lName;
                                editEmail.value = data.email;
                                editPhoneNo.value = data.phoneNo || ""; // Handle empty values
                                editUsername.value = data.username || ""; 
                                editProgram.value = data.program || "";
                                editDuration.value = data.duration || "";
                                editRole.value = data.role || "";
                            } else {
                                console.error('Modal elements not found!');
                            }

                            // Also update the hidden regID field
                            const regIDField = document.getElementById('regID');
                            if (regIDField) {
                                regIDField.value = data.regID; // Hidden input to store regID for submission
                            }
                        })
                        .catch(error => console.error('Error fetching user data:', error));
                }

                // When the "edit" button is clicked, open the modal and populate it
                document.querySelectorAll('.edit-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const regID = this.getAttribute('data-id');
                        populateModal(regID);
                        editUserModal.style.display = "block";  // Show the edit user modal
                    });
                });
            });
        </script>

        <!--load data to tables script-->
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
                                <td><button class="btn" id="respond-button">Respond</button> <!-- Edit button with data-reg-id -->
                                <button class="btn" id="respond-button">Delete</button>
                            </td> <!-- Edit button with data-reg-id -->
                        `;
                        contactTableBody.appendChild(row);
                    });

                    // Add event listeners for the "Edit Con" buttons
                    // Direct to gmail page
                    

                    // Load Registrations
                    const regTableBody = document.querySelector("#registrationTable tbody");
                    data.registrations.forEach(reg => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${reg.regID}</td>
                            <td>${reg.fName}</td>
                            <td>${reg.lName}</td>
                            <td>${reg.email}</td>
                            <td>${reg.phoneNo}</td>
                            <td>${reg.username}</td>
                            <td>${reg.program}</td>
                            <td>${reg.duration}</td>
                            <td>${reg.role}</td>
                            <td>
                                <button class="editBtn" data-reg-id="${reg.regID}">Edit</button>
                                <button class="btn" id="respond-button">Delete</button>
                            </td> <!-- Edit button with data-reg-id -->
                        `;
                        regTableBody.appendChild(row);
                    });

                    // Add event listeners for the "Edit" buttons
                    const editUserBtns = document.querySelectorAll(".editBtn");
                    function populateModal(regID) {
                    console.log("regID passed to populateModal:", regID); // Log regID

                    // Fetch user data from get_user.php using the regID
                    fetch(`get_user.php?regID=${regID}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                console.error(data.error);
                                return;
                            }

                            // Populate the modal with the fetched user data
                            document.getElementById('editFName').value = data.fName;
                            document.getElementById('editLName').value = data.lName;
                            document.getElementById('editEmail').value = data.email;
                            document.getElementById('editPhoneNo').value = data.phoneNo || ""; // Handle empty values
                            document.getElementById('editUsername').value = data.username || ""; 
                            document.getElementById('editProgram').value = data.program || "";
                            document.getElementById('editDuration').value = data.duration || "";
                            document.getElementById('editRole').value = data.role || "";
                            document.getElementById('regID').value = data.regID; // Hidden input to store regID for submission
                        })
                        .catch(error => console.error('Error fetching user data:', error));
                    }
                    editUserBtns.forEach(btn => {
                        btn.onclick = function () {
                            const regID = btn.getAttribute("data-reg-id"); // Get the regID from the data attribute
                            editUserModal.style.display = "block"; // Show the modal
                            populateModal(regID); // Fetch and populate the data for the selected user
                        };
                    });
                })
                .catch(error => {
                    console.error("Failed to load data:", error);
                });
        </script>
        
        <!--Logout Login scripts-->
        <script src="login.js" defer></script>
        <script src="logout.js" defer></script>
    </body>
</html>