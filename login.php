<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: welcome.php');
    exit;
}

if (isset($_POST['login-btn'])) {
    $email = $_POST['user_email'];
    $password = ($_POST['user_password']);

    $query = "SELECT * FROM users WHERE user_email = ? AND user_password = ? LIMIT 1";

    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $email, $password);

    if ($stmt_login->execute()) {
        $stmt_login->bind_result($user_id, $user_name, $user_email, $user_password, $user_phone, $user_address, $user_city, $user_photo);
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_phone'] = $user_phone;
            $_SESSION['user_address'] = $user_address;
            $_SESSION['user_city'] = $user_city;
            $_SESSION['user_photo'] = $user_photo;
            $_SESSION['logged_in'] = true;

            header('location: welcome.php?message=Logged in successfuly');
        } else {
            header('location: login.php?error=Could not verify your account');
        }
    } else {
        //Error
        header('location: login.php?error=Something went wrong');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-content">
                <form id="login-form" method="POST" action="login.php">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="user_email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="user_password" required>
                        <label for="">Password</label>
                    </div>
                    <?php if (isset($_GET['error'])) ?>
                    <div class="register" role="alert">
                        <?php if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        }
                        ?>
                    </div>
                    <div class="button">
                        <input type="submit" id="login-btn" name="login-btn" value="Login Now">
                    </div>
                    <div class="register">
                        <p>Don't have a account? <a href="register.html">Register now</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>