<?php
header('Content-Type: application/json');
require 'db.php'; // contains $pdo connection

// Get search parameters
$internal_lrn      = $_GET['internal_lrn']   ?? '';
$tracking_number   = $_GET['tracking_number']   ?? '';
$consignor_name    = $_GET['consignor_name']    ?? '';
$consignor_phone   = $_GET['consignor_phone']   ?? '';
$consignor_address = $_GET['consignor_address'] ?? '';
$consignee_name    = $_GET['consignee_name']    ?? '';
$consignee_phone   = $_GET['consignee_phone']   ?? '';
$consignee_address = $_GET['consignee_address'] ?? '';

try {
    $sql = "
        SELECT *
    FROM (
        SELECT 
            s.internal_lrn,
            s.tracking_number,
            s.booking_date,
            s.expected_delivery_date,
            s.pickup_date,
            s.delivery_date,
            s.carrier,
            s.status,
            p1.name AS consignor_name,
            p1.phone AS consignor_phone,
            p1.address AS consignor_address,
            p1.pincode as consignor_pincode,
            p2.name AS consignee_name,
            p2.phone AS consignee_phone,
            p2.address AS consignee_address,
            p2.pincode as consignee_pincode,
            h.history_date,
            h.history_status,
            h.history_location,
            ROW_NUMBER() OVER (
                PARTITION BY s.internal_lrn 
                ORDER BY h.history_date DESC
            ) AS rn
        FROM shipments s
        JOIN parties p1 ON s.consignor_id = p1.id
        JOIN parties p2 ON s.consignee_id = p2.id
        LEFT JOIN shipment_history h ON s.id = h.shipment_id
        WHERE 1=1
    ) t
    WHERE t.rn = 1
    ";

    $params = [];

    if (!empty($internal_lrn)) {
        $sql .= " AND s.internal_lrn = ? ";
        $params[] = $internal_lrn;
    }
    if (!empty($tracking_number)) {
        $sql .= " AND s.tracking_number = ? ";
        $params[] = $tracking_number;
    }
    if (!empty($consignor_name)) {
        $sql .= " AND p1.name LIKE ? ";
        $params[] = "%$consignor_name%";
    }
    if (!empty($consignor_phone)) {
        $sql .= " AND p1.phone LIKE ? ";
        $params[] = "%$consignor_phone%";
    }
    if (!empty($consignor_address)) {
        $sql .= " AND p1.address LIKE ? ";
        $params[] = "%$consignor_address%";
    }
    if (!empty($consignee_name)) {
        $sql .= " AND p2.name LIKE ? ";
        $params[] = "%$consignee_name%";
    }
    if (!empty($consignee_phone)) {
        $sql .= " AND p2.phone LIKE ? ";
        $params[] = "%$consignee_phone%";
    }
    if (!empty($consignee_address)) {
        $sql .= " AND p2.address LIKE ? ";
        $params[] = "%$consignee_address%";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
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
