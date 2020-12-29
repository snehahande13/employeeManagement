<?php
session_start();

unset($_SESSION["email"]);
unset($_SESSION['error']);
header("Location:loginform.php");
?>