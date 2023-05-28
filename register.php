<?php
require 'config.php';
$passError = $emailError1 = $emailError2 = false;
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $chkpass = $_POST['check_pass'];

    $select1 = "SELECT * FROM member WHERE email='$email'";
    $result1 = mysqli_query($conn, $select1);

    if (mysqli_num_rows($result1) > 0) {
        $emailError1 = true;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError2 = true;
    } else {

        if ($chkpass == $password) {
            // $hashpassword=password_hash($password, PASSWORD_DEFAULT);
            // $insert= "INSERT INTO member (name, email, password) VALUES ('$name', '$email', '$hashpassword')";
            $insert = "INSERT INTO member (name, email, password) VALUES ('$name', '$email', '$password')";
            $sql = mysqli_query($conn, $insert);
            if ($sql) {
                echo
                "<script> alert('Registration Complete'); window.location.href='login.php'; </script> ";
            } else {
                echo
                "<script> alert('Registration Failed'); </script> ";
            }
        } else {
            $passError = true;
        }
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

    <title>Registration</title>
</head>

<body>
    <!-- <header>
        <a class="site_name" href="home.php">THIKANA</a>
        <nav>
            <ul class="nav_links">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="item_add.php">Add Property</a></li>
            </ul>
        </nav>
        <p class="lbutton">Log in</p>
    </header> -->


    <div class="container">

        <div class="form signup">
            <span class="title">Registration</span>

            <form action="#" method="post">
                <div class="input-field">
                    <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" placeholder="Enter your name" required>
                    <i class="uil uil-user"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Enter your email" required>
                    <i class="uil uil-envelope icon"></i>
                </div>
                <?php if ($emailError1) { ?>
                    <p class="error_message"> Email already in use </p><?php } ?>
                <?php if ($emailError2) { ?>
                    <p class="error_message"> Invalid Email </p><?php } ?>
                <div class="input-field">
                    <input type="password" class="password" name="password" placeholder="Create a password" required>
                    <i class="uil uil-lock icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="check_pass" id="check_pass" class="password" placeholder="Confirm password" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidepw"></i>
                </div>
                <?php if ($passError) { ?>
                    <p class="error_message"> Passwords don't match </p><?php } ?>

                <div class="input-field button">
                    <input type="submit" name="submit" value="Signup Now">
                </div>
            </form>

            <div class="login-signup">
                <span class="text">Already have an account?
                    <a href="login.php" class="text login-link">Log in</a>
                </span>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

</body>

</html>