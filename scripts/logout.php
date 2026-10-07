<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

session_destroy();
session_unset();

header('Location: ../index.php');
exit();
?>