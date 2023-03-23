<?php
$host = 'localhost';
$username = 'root';
$pass = '';
$db = 'jifunzedb';

$conn = mysqli_connect($host, $username, $pass, $db);

if(!$conn) {
    die("Connection failed!");
}
?>