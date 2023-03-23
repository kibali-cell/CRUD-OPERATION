<?php
include "connection.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query="delete from users where id='$id'";
    if (mysqli_query($conn, $query)) {
        header('location: view_users.php?message="USER DELETED"');
    }else{
        header('location: view_users.php?error');
    }
}
?>