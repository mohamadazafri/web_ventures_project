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
            // Get a single task
            $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
            $stmt->execute([$task_id]);
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($task) {
                echo json_encode($task);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Task not found']);
            }
        
        } else {
            // TODO: Get all tasks
            $stmt = $conn->query("SELECT * FROM tasks ORDER BY dueDate DESC");
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tasks);

        }
        break;

    case 'POST':
        // TODO: Create a new task


    case 'PUT':
        //TODO: Update an existing task


    case 'DELETE':
        //Delete a task

        if (!$task_id) {
            http_response_code(400);
            echo json_encode(['error' => 'Task ID is required']);
            break;
        }

        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->execute([$task_id]);

        if ($stmt->rowCount() > 0) {
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Task not found']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;

}
?> 