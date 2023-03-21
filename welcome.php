<?php
session_start();
include('server/connection.php');

$sql = "Select * from users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}


if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $q = "SELECT * FROM users WHERE user_id LIKE '%$keyword%' OR user_name LIKE '%$keyword%' OR user_email LIKE '%$keyword%'";
} else {
    $q = 'SELECT * FROM users';
}
$result = mysqli_query($conn, $q);

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}
if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        header('location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <link rel="stylesheet" href="css/welcome.css"> -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <!-- <div class="welcome">
        <div class="profile">
            <div class="avatar">
                <img src="<?php echo $row['user_photo']; ?>" alt="Profile Picture">
            </div>
            <div class="info">
                <h2><?php echo $row['user_name']; ?></h2>
                <p><?php echo $row['user_email']; ?></p>
                <p><?php echo $row['user_phone']; ?></p>
                <p><?php echo $row['user_address']; ?></p>
                <p><?php echo $row['user_city']; ?></p>
                <br>
                <a class="logout" href="welcome.php?logout=1" id="logout-btn">LOGOUT</a>
            </div>
        </div>
    </div> -->
    <section>
        <div class="box">
            <div class="container mt-4">
                <form action="" method="post">
                    <input type="text" name="keyword" placeholder="Masukan keyword">
                    <button type="submit" class="btn btn-primary" name="search">Cari</button>
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['user_id'] ?></td>
                                <td><?php echo $row['user_name'] ?></td>
                                <td><?php echo $row['user_email'] ?></td>
                                <td><?php echo $row['user_phone'] ?></td>
                                <td><?php echo $row['user_address'] ?></td>
                                <td><?php echo $row['user_city'] ?></td>
                                <td>
                                    <a href="actionDelete.php?user_id=<?php echo $row['user_id']; ?>" role="button" onclick="return confirm('Data ini akan dihapus')">Hapus</a>
                                </td>
                                <td>
                                    <a href="update.php?user_id=<?php echo $row['user_id']; ?>">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a class="btn btn-danger" href="welcome.php?logout=1" role="button">Log Out</a>
            </div>
        </div>
    </section>
</body>

</html>