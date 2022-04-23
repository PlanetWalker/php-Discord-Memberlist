<?php
if (session_status() === PHP_SESSION_NONE) session_start();
ob_start();
session_destroy();
header('Location: /');
?>