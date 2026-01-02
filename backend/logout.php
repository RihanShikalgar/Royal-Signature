<?php
require_once '../backend/config.php';

setJsonHeader();

session_destroy();
$_SESSION = array();

sendResponse(true, 'Logout successful');
?>
