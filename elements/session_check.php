<?php 
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && isset($_SESSION['AUTH_TOKEN'])) {
    $currentTime = time();

    $sessionExpiration = ini_get('session.gc_maxlifetime');

    $expirationTimestamp = $_SESSION['LAST_ACTIVITY'] + $sessionExpiration;

    if ($currentTime > $expirationTimestamp) {
        echo json_encode(['expired' => true]);
        
        session_destroy();
        exit;
    } else {
        // The session is still active
        echo json_encode(['expired' => false]);
        
        // Update the LAST_ACTIVITY timestamp to the current time
        $_SESSION['LAST_ACTIVITY'] = $currentTime;
        exit;
    }
}
?>
