<?php
require 'template.php';

$template = new Template();

// Get the requested page, default to 'dashboard'
$page = $_GET['page'] ?? 'dashboard';
$contentFile = "pages/{$page}.php";

// Check if the content file exists
if (!file_exists($contentFile)) {
    die('Page not found');
}

// Optional: set page-specific title, CSS, JS
$template->setTitle(ucfirst($page));
$template->addCSS('style.css');
$template->addJS(jsFile: "assets/js/{$page}" . '.js'); // e.g., dashboard.js, users.js

// Pass variables to content page (if needed)
$vars = [];
if ($page === 'dashboard') {
    $vars = [
        'username' => 'Alien',
        'stats' => ['Users' => 120, 'Orders' => 35]
    ];
} elseif ($page === 'users') {
    $vars = [
        'users' => [
            ['name' => 'Alice', 'email' => 'alice@example.com'],
            ['name' => 'Bob', 'email' => 'bob@example.com']
        ]
    ];
} elseif ($page === 'data-list') {
    $vars = [
        'data' => [
            ['id' => 1, 'name' => 'Item A', 'value' => 100],
            ['id' => 2, 'name' => 'Item B', 'value' => 200]
        ]
    ];
}

// Set content file with variables
$template->setContent($contentFile, $vars);

// Render the page
$template->display();
