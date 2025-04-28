<?php
function isMalicious($input) {
    // Common SQL injection patterns
    $patterns = [
        '/\bor\b/i',
        '/\band\b/i',
        '/--/',
        '/#/i',
        '/\*/',
        '/select\b/i',
        '/union\b/i',
        '/insert\b/i',
        '/update\b/i',
        '/delete\b/i',
        '/drop\b/i',
        '/1\s*=\s*1/',
        '/\'/',  // single quote
        '/\"/',  // double quote
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            include_once("logMalicious.php");
            logMaliciousAttempt($input, basename($_SERVER['PHP_SELF']));
            return true;
        }
    }
    return false;
}
?>
