<?php
session_start();
header('Content-Type: application/json');

if (!empty($_SESSION['LOGGED_IN_USER'])) {
    echo json_encode([
        "success" => true,
        "user" => $_SESSION['LOGGED_IN_USER']
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Not logged in"
    ]);
}
