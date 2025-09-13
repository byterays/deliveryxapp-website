<?php
session_start();

header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

// If JSON is empty, fall back to POST form data
if (!$data) {
    $data = $_POST;
}

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Username and password required"]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
    $logged_in_user = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role']
                     ];
    $_SESSION['LOGGED_IN_USER'] = $logged_in_user;
    echo json_encode([
        "success" => true,
        "message" => "Login successful",
        "user" => $logged_in_user
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid credentials"]);
}
