<?php
require 'session.php';
$_SESSION=[];
session_unset();
session_destroy();
header('location:http://localhost/library/index.php');
?>