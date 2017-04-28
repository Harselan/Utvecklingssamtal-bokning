<?php
    session_start();
    if(isset($_SESSION['name'])){
        session_unset();
    }
    header('Location: index.php');
?>