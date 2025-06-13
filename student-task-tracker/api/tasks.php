<?php
require_once 'config.php';

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Get database connection
$conn = getDBConnection();

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

// Get the request URI and parse it
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$path_parts = explode('/', trim($path, '/'));

// Get the task ID if it exists
$task_id = isset($path_parts[2]) ? $path_parts[2] : null;

// Handle different HTTP methods
switch ($method) {
    case 'GET':
        if ($task_id) {
            // TODO: Get a single task
  
            
        } else {
            // TODO: Get all tasks

        }
        break;

    case 'POST':
        // TODO: Create a new task


    case 'PUT':
        //TODO: Update an existing task


    case 'DELETE':
        // TODO: Delete a task

}
?> 