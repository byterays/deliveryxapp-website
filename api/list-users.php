<?php
header('Content-Type: application/json');
require 'db.php'; // contains $pdo connection

try {
    $sql = "select  `id`,
                    `name`,
                    `username`,
                    `email`,  
                    `role`,
                    `status`,
                    `created_at`,
                    `updated_at`
                from users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "count"   => count($rows),
        "data"    => $rows
    ], JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
