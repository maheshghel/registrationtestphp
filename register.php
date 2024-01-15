<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once 'User.php';

// Simulate database connection
$db = new stdClass();

// Create a User instance
$user = new User($db);

// Process registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $file = $_FILES['file'];

    $registrationResult = $user->register($name, $email, $phone, $password, $confirmPassword, $file);
    echo json_encode($registrationResult);
} else {
    header('Location: index.html');
}

?>
