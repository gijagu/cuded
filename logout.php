<?php
session_start(); 

$_SESSION['logged_in']=null;
session_destroy();
header('Location: /cuded/');
?>