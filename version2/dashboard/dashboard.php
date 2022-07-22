<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// When the user has no session. directs to the login
if (!isset($_SESSION['user'])) {
    header("Location: /login");
}
    
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // request 30 minutes ago
    session_destroy();
    session_unset();
}
    
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time
if (session_status() != 2 || !isset($_SESSION['user']) || $_SESSION['user'] == "") {
    session_destroy();
    session_unset();
    header('Location: /login');
}

?>
<!doctype html>
<html>
    <?php include(ROOTPATH. '/includes/php/header.php'); ?>
    <?php include(ROOTPATH. '/includes/php/main.php'); ?>
    <?php include(ROOTPATH. '/includes/php/footer.php'); ?>
</html>