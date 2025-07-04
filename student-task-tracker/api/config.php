<?php
// CORS configuration
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Access-Control-Max-Age: 86400'); // 24 hours
header('Content-Type: application/json; charset=utf-8');
// Database configuration
// define('DB_HOST', 'sql310.infinityfree.com');
// define('DB_USER', 'if0_39387061');
// define('DB_PASS', 'qrpt9781');
// define('DB_NAME', 'if0_39387061_student_tracker_system');
define('DB_HOST', 'shinkansen.proxy.rlwy.net');
define('DB_USER', 'root');
define('DB_PASS', 'CGkuGHpkMQNaqJIDSekmXIGOngEQCHeo');
define('DB_NAME', 'railway');
define('DB_PORT', '24965');

// API configuration
define('API_VERSION', 'v1');
define('API_URL', '/api/' . API_VERSION);


// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
function getDBConnection() {
    try {
        $conn = new PDO(
            "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
        exit();
    }
}
?> 