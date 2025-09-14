<?php
header('Content-Type: application/json');
require 'db.php'; // contains $pdo connection

$data["data"] = $_POST;

$q = $_POST['tid'] ?? "";

if (empty($q)) {
    echo json_encode([
        "success" => false,
        "message" => "Missing required parameter 'q'"
    ]);
    exit;
}

try {
    // Fetch shipment with consignor + consignee
    $sql = "
        SELECT 
            s.id AS shipment_id,
            s.tracking_number,
            s.internal_lrn,
            s.booking_date,
            s.item_qty,
            s.expected_delivery_date,
            s.pickup_date,
            s.delivery_date,
            s.carrier,
            s.status,
            p1.name AS consignor_name,
            p1.phone AS consignor_phone,
            p1.address AS consignor_address,
            p1.pincode AS consignor_pincode,
            p2.name AS consignee_name,
            p2.phone AS consignee_phone,
            p2.address AS consignee_address,
            p2.pincode AS consignee_pincode
        FROM shipments s
        JOIN parties p1 ON s.consignor_id = p1.id
        JOIN parties p2 ON s.consignee_id = p2.id
        WHERE s.tracking_number = ? OR s.internal_lrn = ?
        LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$q, $q]);
    $shipment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$shipment) {
        echo json_encode([
            "success" => false,
            "message" => "No shipment found for: " . htmlspecialchars($q)
        ]);
        exit;
    }

    // Fetch shipment history
    $sqlHistory = "
        SELECT history_date, history_status, history_location
        FROM shipment_history
        WHERE shipment_id = ?
        ORDER BY history_date ASC
    ";
    $stmt = $pdo->prepare($sqlHistory);
    $stmt->execute([$shipment['shipment_id']]);
    $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Build JSON response
    $response = [
        "success" => true,
        "data" => [
            "consignor" => [
                "name" => $shipment['consignor_name'],
                "phone" => $shipment['consignor_phone'],
                "address" => $shipment['consignor_address'],
                "pincode" => $shipment['consignor_pincode'],
            ],
            "consignee" => [
                "name" => $shipment['consignee_name'],
                "phone" => $shipment['consignee_phone'],
                "address" => $shipment['consignee_address'],
                "pincode" => $shipment['consignee_pincode'],
            ],
            "shipment" => [
                "tracking_number" => $shipment['tracking_number'],
                "internal_lrn" => $shipment['internal_lrn'],
                "booking_date" => $shipment['booking_date'],
                "expected_delivery_date" => $shipment['expected_delivery_date'],
                "pickup_date" => $shipment['pickup_date'],
                "delivery_date" => $shipment['delivery_date'],
                "carrier" => $shipment['carrier'],
                "item_qty" => $shipment["item_qty"],
                "status" => $shipment['status']
            ],
            "history" => $history
        ]
    ];

    echo json_encode($response, JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
