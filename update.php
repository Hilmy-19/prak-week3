<?php
include "server/connection.php";
$id = $_GET['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['btn_update'])) {
  $username = $_POST['user_name'];
  $email = $_POST['user_email'];
  $phone = $_POST['user_phone'];
  $address = $_POST['user_address'];
  $city = $_POST['user_city'];

  $q = "UPDATE users SET user_name = '$username', user_email = '$email', user_phone = '$phone',
                          user_address = '$address', user_city = '$city' WHERE user_id = '$id'";

  mysqli_query($conn, $q);
  header("location:welcome.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="css/update.css" />
  </head>
  <body>
    <section>
      <div class="form-box">
        <div class="form-content">
          <form method="POST" action="actionUpdate.php?user_id=<?php echo $id ?>">
            <h2>Edit</h2>
            <h2>ID:<?php echo $row['user_id'] ?></h2>
            <div class="inputbox">
              <input type="text" name="user_name" value="<?php echo $row['user_name']?>" required />
              <label for="">Username</label>
            </div>
            <div class="inputbox">
              <input type="email" name="user_email" value="<?php echo $row['user_email']?>" required />
              <label for="">Email</label>
            </div>
            <div class="inputbox">
              <input type="text" name="user_phone" value="<?php echo $row['user_phone']?>" required />
              <label for="">Phone</label>
            </div>
            <div class="inputbox">
              <input type="text" name="user_address" value="<?php echo $row['user_address']?>" required />
              <label for="">Address</label>
            </div>
            <div class="inputbox">
              <input type="text" name="user_city" value="<?php echo $row['user_city']?>" required />
              <label for="">City</label>
            </div>
            <button type="submit" name="btn_update">Update</button>
          </form>
        </div>
      </div>
    </section>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>