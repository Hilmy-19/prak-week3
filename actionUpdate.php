<?php

include "server/connection.php";

$id = $_GET['user_id'];
$username = $_POST['user_name'];
$email = $_POST['user_email'];
$phone = $_POST['user_phone'];
$address = $_POST['user_address'];
$city = $_POST['user_city'];

$query = "UPDATE users SET user_name = '$username', user_email = '$email', user_phone = '$phone',
                            user_address = '$address', user_city = '$city' WHERE user_id = '$id'";

mysqli_query($conn, $query);
header("location:welcome.php")

?>