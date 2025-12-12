<?php

// Import database configuration
if (in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1'])) {
    require_once __DIR__ . '/DB/db_config_local_to_server.php';
} else {
    require_once __DIR__ . '/DB/db_config.php';
}

$answer = $_POST['answer'] ?? '';

$rawInput = file_get_contents('php://input');

// If $_POST is empty, try reading raw JSON input
if (empty($answer)) {
    $input = json_decode($rawInput, true);
    $answer = $input['answer'] ?? '';
}

// Debug: Log the incoming request
error_log("Save.php: Received request with answer: " . $answer);

if (!empty($answer)) {

    $userIp = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $userIp = trim($ipList[0]);
    }

    // Validate answer against ENUM values
    if (!in_array($answer, ['yes', 'no'])) {
        error_log("Save.php: Invalid answer received: " . $answer);
        http_response_code(400);
        echo "Error: Invalid answer value.";
        exit;
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        error_log("Save.php: Connection failed: " . $conn->connect_error);
        http_response_code(500);
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO support_responses (response, ip_address) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $answer, $userIp);
        if ($stmt->execute()) {
            error_log("Save.php: Data inserted successfully for IP: " . $userIp);
            echo "Success: Response saved to MySQL.";
        } else {
            error_log("Save.php: Execution error: " . $stmt->error);
            http_response_code(500);
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        error_log("Save.php: Preparation error: " . $conn->error);
        http_response_code(500);
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
} else {
    // This part is reached if no 'answer' is found in the POST or JSON body.
    // It can also be reached if a server redirect changes the request method from POST to GET.
    http_response_code(400); // Bad Request
    echo "Error: No answer data received. Request method was: " . $_SERVER['REQUEST_METHOD'];
}
?>
