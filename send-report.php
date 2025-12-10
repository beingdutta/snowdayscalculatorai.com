<?php
// --- Error & Output Handling ---
// Prevent PHP from outputting HTML-formatted errors, which would break the JSON response.
ini_set('display_errors', 0);
error_reporting(0);
header('Content-Type: application/json');

// --- Enhanced Validation for Debugging ---
if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    $actual_method = htmlspecialchars(strtoupper($_SERVER['REQUEST_METHOD']));
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method. Expected POST, but received ' . $actual_method . '. This is often caused by a URL redirect.']);
    exit;
}

// Check if the POST array is empty. This is a classic sign of exceeding post_max_size.
if (empty($_POST)) {
    $post_max_size = ini_get('post_max_size');
    echo json_encode([
        'status' => 'error',
        'message' => 'No data received. This often means the file was too large for the server. The current server limit (post_max_size) is ' . $post_max_size . '.'
    ]);
    exit;
}

// Check for specific required fields.
if (empty($_POST['email']) || empty($_POST['pdf'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request: Missing email or PDF data.']);
    exit;
}

$recipient_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message_body    = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
$pdf_base64      = $_POST['pdf'];
$location        = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : 'your location';

if (!filter_var($recipient_email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email address provided.']);
    exit;
}

// --- Email Composition ---
$from_email = "reports@snowdayscalculatorai.com";
$from_name  = "SnowDay Calculator AI";
$subject    = "Your Snow Day Forecast Report for " . $location;

// Decode the base64 PDF content
$pdf_decoded = base64_decode($pdf_base64);

// Generate a boundary string
$boundary = "boundary-" . md5(time());

// --- Headers ---
$headers = "From: $from_name <$from_email>\r\n";
$headers .= "Reply-To: $from_email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

// --- Message Body (Plain Text Part) ---
$body = "--$boundary\r\n";
$body .= "Content-Type: text/plain; charset=UTF-8\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";

// Add user's optional message
if (!empty($message_body)) {
    $body .= $message_body . "\r\n\r\n";
}
$body .= "Please find your Snow Day Forecast Report attached.\r\n\r\n";
$body .= "This report was generated for " . $location . " from snowdayscalculatorai.com.\r\n";

// --- Attachment Part ---
$body .= "--$boundary\r\n";
$body .= "Content-Type: application/pdf; name=\"snow-day-report.pdf\"\r\n";
$body .= "Content-Disposition: attachment; filename=\"snow-day-report.pdf\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
$body .= chunk_split($pdf_base64) . "\r\n";

// --- Final Boundary ---
$body .= "--$boundary--";

// --- Send Email ---
if (mail($recipient_email, $subject, $body, $headers)) {
    echo json_encode(['status' => 'success', 'message' => 'Report sent successfully to ' . $recipient_email]);
} else {
    // It's good practice not to expose detailed server errors to the client.
    // Log a more detailed error for the administrator.
    $error = error_get_last();
    $log_message = "Mail failed to send to " . $recipient_email . ".";
    if ($error !== null) {
        $log_message .= " | PHP Error: " . $error['message'];
    }
    error_log($log_message);
    echo json_encode(['status' => 'error', 'message' => 'Could not send the email. Please try again later.']);
}
?>