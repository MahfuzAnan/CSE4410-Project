<?php
require 'config.php';
session_start();
$passError = $emailError = false;
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM member WHERE email='$email' and password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION["member_id"] = $row['member_id'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["name"] = $row['name'];
        echo "<script> alert('Login done'); </script>";
        header("location: home.php");
        exit();
    } else {
        $emailError = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Iconscout CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- CSS -->
    <!-- <link rel="stylesheet" href="style.css"> -->

    <title>Login</title>
</head>

<body>
    <!-- <header>
        <a class="site_name" href="home.php">THIKANA.COM</a>
        <nav>
            <ul class="nav_links">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="item_add">Add Property</a></li>
            </ul>
        </nav>
        <p class="lbutton">Log in</p>
    </header> -->

    <section class="loginReg">
        <div class="container">
            <div class="forms">
                <div class="form login">
                    <span class="title">Login</span>

                    <form action="#" method="post">
                        <div class="input-field">
                            <input type="text" name="email" id="email" placeholder="Enter your email" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <?php if ($emailError) { ?>
                            <p class="error_message"> Wrong Email </p><?php } ?>

                        <div class="input-field">
                            <input type="password" class="password" name="password" placeholder="Enter your password" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidepw"></i>
                        </div>
                        <?php if ($passError) { ?>
                            <p class="error_message"> Wrong Password </p><?php } ?>


                        <div class="input-field button">
                            <input type="submit" name="login" value="Login Now">
                        </div>
                    </form>

                    <div class="login-signup">
                        <span class="text">Not a member?
                            <a href="register.php" class="text signup-link">Signup now</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
    <script>
        $(function() {
            $("form").validate();
        });
    </script>
</body>

</html>