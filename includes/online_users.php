<?php
header('Content-Type: application/json');

$online_dir = __DIR__ . '/../online_users';
$online_count = 0;
$timeout_seconds = 300; // 5 minutes

if (is_dir($online_dir)) {
    if ($handle = opendir($online_dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                $filepath = $online_dir . '/' . $file;
                // Check if the file was modified within the timeout period
                if (filemtime($filepath) > (time() - $timeout_seconds)) {
                    $online_count++;
                } else {
                    // Clean up old session files
                    unlink($filepath);
                }
            }
        }
        closedir($handle);
    }
}

echo json_encode(['online_users' => $online_count]);
?>