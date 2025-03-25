<?php
// Database configuration (not used in this simple version)
define('DB_HOST', 'the file path to reach your dg');
define('DB_NAME', 'your sql database name');
define('DB_USER', 'your sql db user');
define('DB_PASS', 'your sql db password');

// Maximum scan time in seconds (for shared hosting safety)
define('MAX_SCAN_TIME', 30);

// Allowed domains (for safety, empty means all domains allowed)
$ALLOWED_DOMAINS = [
    // 'example.com',
    // 'test.org'
];

// Enable/disable port scanning (usually disabled on shared hosts)
define('ENABLE_PORT_SCAN', false);
?>
