<?php
session_start();

session_destroy();

// 4. Return API response
header('Content-Type: application/json');
echo json_encode([
    "success" => true,
    "message" => "Session destroyed. Logged out successfully."
]);