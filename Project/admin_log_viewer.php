<?php
$logFile = "logs/malicious_attempts.log";

if (!file_exists($logFile)) {
    echo "<h3>No log file found.</h3>";
    exit();
}

$logEntries = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$totalAttempts = count($logEntries);
$lastAttempts = array_slice($logEntries, -10); // show last 10 attempts
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - SQL Injection Logs</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        .log-box {
            background: #fff;
            border-left: 4px solid #e74c3c;
            margin: 10px 0;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .count {
            font-size: 20px;
            color: #555;
        }
    </style>
</head>
<body>

<h2>🛡 SQL Injection Attempt Logs</h2>
<p class="count"> Total Attempts Logged: <strong><?= $totalAttempts ?></strong></p>

<?php if ($totalAttempts === 0): ?>
    <p>No malicious attempts found.</p>
<?php else: ?>
    <h3> Last 10 Attempts:</h3>
    <?php foreach ($lastAttempts as $entry): ?>
        <div class="log-box"><?= htmlspecialchars($entry) ?></div>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
