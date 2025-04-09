<?php
session_start();
session_unset();
session_destroy();

// Redirect to the homepage or login page after logout
echo json_encode(["success" => true]);
header("Location: index.html");
exit();
?>
