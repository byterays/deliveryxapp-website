<?php
header('Content-Type: application/json');

require 'db.php';

$requiredHeaders = [
    'internal_lrn',
    'tracking_number',
    'booking_date',
    'item_qty',
    'expected_delivery_date',
    'delivery_date',
    'carrier',
    'consignor_name',
    'consignor_phone',
    'consignor_email',
    'consignor_address',
    'consignor_pincode',
    'consignee_name',
    'consignee_phone',
    'consignee_email',
    'consignee_address',
    'consignee_pincode',
    'update_date',
    'update_status',
    'update_location'
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Only POST allowed"]);
    exit;
}

if (!isset($_FILES['csv_file'])) {
    http_response_code(400);
    echo json_encode(["error" => "No CSV file uploaded"]);
    exit;
}


// Get file info
$fileName = $_FILES['csv_file']['name'];
$fileTmpPath = $_FILES['csv_file']['tmp_name'];
$fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

// Allow only CSV
$allowedTypes = ['csv'];
if (!in_array($fileType, $allowedTypes)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid file type. Only CSV files are allowed."]);
    exit;
}

// Optional: also check MIME type (extra security)
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $fileTmpPath);
finfo_close($finfo);

$allowedMimes = ['text/csv', 'text/plain', 'application/csv'];
if (!in_array($mimeType, $allowedMimes)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid file MIME type. Only CSV files are allowed."]);
    exit;
}

$fileTmpPath = $_FILES['csv_file']['tmp_name'];

if (!file_exists($fileTmpPath)) {
    http_response_code(400);
    echo json_encode(["error" => "Uploaded file not found"]);
    exit;
}

$handle = fopen($fileTmpPath, "r");
if ($handle === false) {
    http_response_code(400);
    echo json_encode(["error" => "Unable to open uploaded CSV"]);
    exit;
}

$header = fgetcsv($handle);
if ($header === false) {
    http_response_code(400);
    echo json_encode(["error" => "CSV header missing"]);
    exit;
}


$missingColumns = array_diff($requiredHeaders, $header);
$extraColumns = array_diff($header, $requiredHeaders);

if (!empty($missingColumns)) {
    die(json_encode([
        'success' => false,
        'message' => 'Missing required columns: ' . implode(', ', $missingColumns)
    ]));
}

if (!empty($extraColumns)) {
    die(json_encode([
        'success' => false,
        'message' => 'Unexpected extra columns: ' . implode(', ', $extraColumns)
    ]));
}

$inserted = 0;
$updated = 0;
$success = true;
while (($row = fgetcsv($handle)) !== false) {
    $data = array_combine($header, $row);

    if (!$data || empty($data['tracking_number'])) {
        continue;
    }

    $tracking_number = $data['tracking_number'];
    $internal_lrn = $data['internal_lrn'];

    try {
        // 🚀 Start transaction for this row
        $pdo->beginTransaction();

        // Check if shipment exists
        $stmt = $pdo->prepare("SELECT id FROM shipments WHERE tracking_number = ?");
        $stmt->execute([$tracking_number]);
        $shipment = $stmt->fetch();

        if ($shipment) {
            // Shipment exists → update history only
            $shipment_id = $shipment['id'];

            // Check if history already exists
            $sql = "SELECT id FROM shipment_history WHERE shipment_id = :shipment_id AND history_status = :status";

            $params = [
                ':shipment_id' => $shipment_id,
                ':status' => $data['update_status'] ?? null,
            ];

            if ($data['update_date'] === null || normalizeDate($data['update_date']) === null) {
                $sql .= " AND history_date IS NULL";
            } else {
                $sql .= " AND history_date = :date";
                $params[':date'] = normalizeDate($data['update_date']);
            }

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $history = $stmt->fetch();
            if (!$history) {
                $stmt = $pdo->prepare("INSERT INTO shipment_history 
                (shipment_id, history_date, history_status, history_location) 
                VALUES (?, ?, ?, ?)");
                $stmt->execute([
                    $shipment_id,
                    normalizeDate($data['update_date'] ?? null),
                    $data['update_status'] ?? null,
                    $data['update_location'] ?? null
                ]);
                
                $stmt = $pdo->prepare("UPDATE shipments SET status = ? WHERE id = ?");
                $stmt->execute([                   
                    $data['update_status'] ?? null,
                    $shipment_id
                ]);

                $updated++;
            }
        } else {
            // Insert consignor
            $stmt = $pdo->prepare("INSERT INTO parties (name, phone, email, address, pincode) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $data['consignor_name'] ?? null,
                $data['consignor_phone'] ?? null,
                $data['consignor_email'] ?? null,
                $data['consignor_address'] ?? null,
                $data['consignor_pincode'] ?? null
            ]);
            $consignor_id = $pdo->lastInsertId();

            // Insert consignee
            $stmt = $pdo->prepare("INSERT INTO parties (name, phone, email, address, pincode) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $data['consignee_name'] ?? null,
                $data['consignee_phone'] ?? null,
                $data['consignee_email'] ?? null,
                $data['consignee_address'] ?? null,
                $data['consignee_pincode'] ?? null
            ]);
            $consignee_id = $pdo->lastInsertId();

            // Insert shipment
            $stmt = $pdo->prepare("INSERT INTO shipments 
                (internal_lrn, tracking_number, booking_date, item_qty, expected_delivery_date, pickup_date, delivery_date, 
                 carrier, status, consignor_id, consignee_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $internal_lrn,
                $tracking_number,
                normalizeDate($data['booking_date'] ?? null),
                $data['item_qty'] ?? null,
                normalizeDate($data['expected_delivery_date'] ?? null),
                normalizeDate($data['update_date'] ?? null),
                normalizeDate($data['delivery_date'] ?? null),
                $data['carrier'] ?? null,
                $data['update_status'] ?? null,
                $consignor_id,
                $consignee_id
            ]);
            $shipment_id = $pdo->lastInsertId();

            // Insert history
            $stmt = $pdo->prepare("INSERT INTO shipment_history 
                (shipment_id, history_date, history_status, history_location) 
                VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $shipment_id,
                normalizeDate($data['update_date'] ?? null),
                $data['update_status'] ?? null,
                $data['update_location'] ?? null
            ]);

            $inserted++;
        }

        //Commit if everything succeeded
        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Failed processing tracking_number {$tracking_number}: " . $e->getMessage());
        $success = false;
    }
}

fclose($handle);

echo json_encode([
    "success" => true,
    "message" => "CSV processed successfully",
    "inserted_shipments" => $inserted,
    "updated_shipments" => $updated
]);

function normalizeDate(?string $dateStr, int $windowDays = 15, string $fallbackDateFormat = "dmyyyy"): ?string
{
    if (empty($dateStr)) {
        return null;
    }

    try {
        $today = new DateTime();

        // Normalize separators to "/"
        $dateStr = preg_replace('/[-\s]+/', '/', trim($dateStr));

        // All supported formats
        $formats = [
            'Y/m/d',
            'd/m/Y',
            'm/d/Y'
        ];

        $candidates = [];
        foreach ($formats as $format) {
            $dt = DateTime::createFromFormat($format, $dateStr);
            if ($dt !== false) {
                $diff = abs($today->diff($dt)->days);
                if ($diff <= $windowDays) {
                    $candidates[] = $dt;
                }
            }
        }

        if (!empty($candidates)) {
            // Pick the closest to today
            if (count($candidates) > 1) {
                usort($candidates, function($a, $b) use ($today) {
                    $diffA = abs($today->getTimestamp() - $a->getTimestamp());
                    $diffB = abs($today->getTimestamp() - $b->getTimestamp());
                    return $diffA <=> $diffB;
                });
            }
            return $candidates[0]->format('Y-m-d');
        }

        // --- Fallback logic ---
        if (strtolower($fallbackDateFormat) === "dmyyyy") {
            $fallbacks = ['d/m/Y'];
        } elseif (strtolower($fallbackDateFormat) === "mdyyyy") {
            $fallbacks = ['m/d/Y'];
        } else {
            $fallbacks = ['d/m/Y']; // default
        }

        foreach ($fallbacks as $fallback) {
            $dt = DateTime::createFromFormat($fallback, $dateStr);
            if ($dt !== false) {
                return $dt->format('Y-m-d');
            }
        }

        return null;
    } catch (Exception $e) {
        return null;
    }
}


