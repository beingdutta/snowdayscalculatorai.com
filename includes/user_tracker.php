<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$session_id = session_id();
$online_dir = __DIR__ . '/../online_users';

// Ensure the directory exists
if (!is_dir($online_dir)) {
    mkdir($online_dir, 0755, true);
}

$session_file = $online_dir . '/' . $session_id;

// Create or update the file's modification time
touch($session_file);
?>