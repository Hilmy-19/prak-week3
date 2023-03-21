<?php

include 'server/connection.php';

$username = $_POST['user_name'];
$email = $_POST['user_email'];
$password = ($_POST['user_password']);
$phone = $_POST['user_phone'];
$address = $_POST['user_address'];
$city = $_POST['user_city'];

$query = "INSERT INTO users VALUES ('', '$username', '$email', '$password', '$phone', '$address', '$city', '')";

mysqli_query($conn, $query);
header("location: register.html");

?>