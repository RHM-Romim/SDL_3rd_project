<?php
function logMaliciousAttempt($input, $page = "unknown") {
    $ip = $_SERVER['REMOTE_ADDR'];
    $time = date("Y-m-d H:i:s");
    $log = "[$time] IP: $ip | Page: $page | Input: $input\n";

    file_put_contents("logs/malicious_attempts.log", $log, FILE_APPEND);
}
?>
