<?php
if (!$_POST) {
    header("Location: ../");
    die();
}

$data["success"] = true;
$data["data"] = $_POST;

$tid = $_POST['tid'] ?? "";


// Build your HTML snippet
$html = "No result";
if ($tid == "53596880352") {



    $obj = new stdClass();
    $obj->tracking_number = $tid;
    $obj->booking_date = "04-09-2025";
    $obj->expected_delivery_date = "10-09-2025";
    $obj->pickup_date = "04-09-2025";
    $obj->delivery_date = "09-09-2025";

    $obj->carrier = "DeliveryX";
    $obj->status = "IN_TRANSIT";
    $obj->history = [
        (object) [
            "date" => "04-09-2025",
            "status" => "ACCEPTED",
            "location" => "New Delhi, India"
        ],

        (object) [
            "date" => "04-09-2025",
            "status" => "MANIFESTED",
            "location" => "New Delhi, India"
        ],
        (object) [
            "date" => "04-09-2025",
            "status" => "IN_TRANSIT"
        ],
        // (object) [
        //     "date" => "04-09-2025",
        //     "status" => "DELIVERED",
        //     "location" => "Kerala, India"
        // ]
    ];

    $obj->consignor = new stdClass();
    $obj->consignor->name = "Rana Tyre";
    $obj->consignor->phone = "";
    $obj->consignor->address = "New Delhi, India";

    $obj->consignee = new stdClass();
    $obj->consignee->name = "Punalur Tyres";
    $obj->consignee->phone = "";
    $obj->consignee->address = "Kerela, India";

    $statusClass = ($obj->status == 'IN_TRANSIT') ? 'active' : '';

    $html =
        "<div class='row'>
            <div class='col-md-7 col-md-offset-1'>
               
                <div class='text-center'>
                    <h3><span class='grey'>TRACKING NUMBER:</span>{$obj->tracking_number}</h3>
                </div>
               
                <div class='wrapper-line padding40 rounded10'>";

    $steps = ['RECEIVED', 'PICKED_UP', 'IN_TRANSIT', 'OUT_FOR_DELIVERY', 'DELIVERED'];
    $display_steps = ['Received', 'Picked Up', 'In Transit', 'Out for Delivery', 'Delivered'];
    $activeIndex = array_search($obj->status, $steps); // find which step is active

    $html .= "<ul class='progress'>";
    foreach ($steps as $i => $step) {
        if ($i < $activeIndex) {
            $class = "";
        } elseif ($i === $activeIndex) {
            $class = "active";
        } else {
            $class = "";
        }
        $html .= "<li class='{$class}'>" . htmlspecialchars($display_steps[$i]) . "</li>";
    }
    $html .= "</ul>";
    $html .= "<div class='divider-double'></div>
                    <ul class='timeline custom-tl'>";


    $history = $obj->history ?? [];

    // mapping of status → badge/icon/message
    $statusMap = [
        "RECEIVED" => [
            "badge" => "info",
            "icon" => "fa-check",
            "message" => "The order has been received"
        ],
        "PICKED UP" => [
            "badge" => "primary",
            "icon" => "fa-archive",
            "message" => "The package has been picked up"
        ],
        "IN_TRANSIT" => [
            "badge" => "",
            "icon" => "fa-plane",
            "message" => "The package is in transit"
        ],

        "OUT_FOR_DELIVERY" => [
            "badge" => "",
            "icon" => "fa-plane",
            "message" => "The package is out for delivery"
        ],
        "DELIVERED" => [
            "badge" => "success",
            "icon" => "fa-check-square-o",
            "message" => "The package has been successfully delivered"
        ],
        "FAILED" => [
            "badge" => "warning",
            "icon" => "fa-exclamation-triangle",
            "message" => "The package could not be delivered"
        ]
    ];

    foreach ($history as $event) {
        $status = strtoupper($event->status);
        $date = date("M d, Y", strtotime($event->date));
        $time = date("h:i a", strtotime($event->date)); // fallback if you store time separately
        $loc = isset($event->location) ? "<span class='location'>" . htmlspecialchars($event->location) . "</span>" : "";

        $badge = $statusMap[$status]["badge"] ?? "";
        $icon = $statusMap[$status]["icon"] ?? "fa-clock-o";
        $message = $statusMap[$status]["message"] ?? $status;

        $html .= "
                <li class='timeline-inverted'>
                     <div data-wow-delay='.2s' class='timeline-date wow zoomIn'>
                        {$date}<!-- <span>{$time}</span> -->
                    </div>
                    <div class='timeline-badge {$badge}'>
                        <i class='fa {$icon} wow zoomIn'></i>
                    </div>
                    <div data-wow-delay='.6s' class='timeline-panel wow fadeInRight'>
                        <div class='timeline-body'>
                            {$message} {$loc}
                        </div>
                    </div>
                </li>";
    }

    $html .= "</ul>
                </div>
            </div>
            <div class='col-md-3'>
                <div class='tracking-info'>
                    
                    <div class='panel panel-info'>
                        <div class='panel-heading'>
                            <h3 class='panel-title'>Tracking Information</h3>
                        </div>
                        <div class='panel-body'>
                            <table class='table'>
                                <tr>
                                    <td>Carrier:</td>
                                    <td><strong>{$obj->consignor->name}</strong></td>
                                </tr>
                                    <tr>
                                    <td>Tracking Number:</td>
                                    <td><strong>{$obj->tracking_number}</strong></td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td><strong>{$obj->status}</strong></td>
                                </tr>
                                <tr>
                                    <td>Expected Delivery Date:</td>
                                    <td><strong>{$obj->expected_delivery_date}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Consignor</h3>
                    </div>
                    <div class='panel-body'>
                       <table class='table'>
                           <tr>
                               <td>Name:</td>
                               <td>{$obj->consignor->name}</td>
                           </tr>
                           <tr>
                               <td>Phone:</td>
                               <td>{$obj->consignor->phone}</td>
                           </tr>
                           <tr>
                               <td>Address:</td>
                               <td>{$obj->consignor->address}</td>
                           </tr>
                       </table>
                    </div>
                </div>
                <div class='panel panel-danger'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Consignee</h3>
                    </div>
                    <div class='panel-body'>
                       <table class='table'>
                           <tr>
                               <td>Name:</td>
                               <td>{$obj->consignee->name}</td>
                           </tr>
                           <tr>
                               <td>Phone:</td>
                               <td>{$obj->consignee->phone}</td>
                           </tr>
                           <tr>
                               <td>Address:</td>
                               <td>{$obj->consignee->address}</td>
                           </tr>
                       </table>
                    </div>
                </div>
            </div>
        </div>";
} else {
    if ($tid) {
        $html = "<br/><div class='alert alert-danger mt-10'>No shipment found with tracking number: " . htmlspecialchars($tid) . "</div>";
    }
}

$data = [
    "success" => true,
    "data" => $html,
    "tid" => $tid
];

header("Content-Type: application/json");
echo json_encode($data);