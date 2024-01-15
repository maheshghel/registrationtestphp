<?php

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function register($name, $email, $phone, $password, $confirmPassword, $file)
    {
        // Validate input data
        $validationErrors = $this->validateInput($name, $email, $phone, $password, $confirmPassword, $file);

        if (!empty($validationErrors)) {
            return ['success' => false, 'message' => 'Validation failed', 'errors' => $validationErrors];
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Process file upload (save file to server, database, etc.)
        $uploadPath = 'uploads/' . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $uploadPath);

        // Save user data and file path to the database

        return ['success' => true, 'message' => 'Registration successful'];
    }

    private function validateInput($name, $email, $phone, $password, $confirmPassword, $file)
    {
        $errors = [];

        if (empty($name)) {
            $errors['name'] = 'Name is required';
        }

        if (empty($email)) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }

        if (empty($phone)) {
            $errors['phone'] = 'Phone is required';
        }

        if (empty($password)) {
            $errors['password'] = 'Password is required';
        }

        if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = 'Passwords do not match';
        }

        // Additional file validation can be added here

        return $errors;
    }
}

?>
