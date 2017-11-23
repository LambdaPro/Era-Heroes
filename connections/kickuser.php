<?php
include_once "db.php";
session_destroy();
unset($_SESSION['login_session']);
unset($_SESSION['user_id']);
?>
