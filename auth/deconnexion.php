<?php

session_start();

if(isset($_SESSION['locale']))
{
    $_SESSION = array();
    session_destroy();
    header('location: ../index.php');
} else {
    header('location: ../index.php');
}