<?php

$databaseUrl = "https://snowday-calculator-7c58f-default-rtdb.firebaseio.com/responses.json";

$answer = $_POST['answer'] ?? '';

if (!empty($answer)) {

    $userIp = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $userIp = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    }

    $data = [
        "answer" => $answer,
        "ip" => $userIp,
        "user_agent" => $_SERVER['HTTP_USER_AGENT'] ?? '',
        "timestamp" => time()
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $databaseUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "CURL ERROR: " . curl_error($ch);
    } else {
        echo "Firebase Response: " . $response;
    }

    curl_close($ch);
}
?>
