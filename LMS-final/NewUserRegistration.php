<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

$error = "";    // Initilizing the error variable 

if(isset($_POST['username']) and isset($_POST['password']) and isset($_POST['confirmpassword']))  {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
	
	$_SESSION['username']=$username;
	$_SESSION['password']=$password;
	$_SESSION['confirmpassword']=$confirmpassword;
	 
    // Check if username already exists
    $checkQuery = "SELECT Username FROM user WHERE Username = '$username'";
    $checkResult = mysqli_query($link, $checkQuery) or die(mysqli_error($link));
    $existingUser = mysqli_fetch_assoc($checkResult);

	if ($existingUser) {
        $error = 'Try again - the username is not unique';
    } elseif ($password == $confirmpassword) {
        $insertStatement = "INSERT INTO user (Username, Password) VALUES ('$username', '$password')";
        $result = mysqli_query($link, $insertStatement) or die(mysqli_error($link));
        if ($result == false) {
            echo 'The query failed.';
            exit();
        } else {
            header('Location: CreateProfile.php');
        }
    } else {
        $error = 'Password not consistent';
    }
}
?>

<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('lms-2.jpg');
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 100px;
        }

        .container table {
            width: 100%;
        }

        .container table td {
            padding: 5px;
        }

        .container input[type="text"],
        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        input[type="password"],
        select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }
        
        .container input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
			
        }

        .container input[type="submit"]:hover {
            background-color: #333;
        }

        .error {
            text-align: center;
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
<h1>New User Registration</h1>

<?php if ($error) { ?>
        <div class="error"><?php echo $error; ?></div>
<?php } ?>

<form action="" method="post" >
<table>
<tr>
    <td>Username</td>
    <td><input type="text" name="username" autocomplete="off" required/></td>
</tr>
<tr>
    <td>Password</td>
    <td><input type="password" name="password" autocomplete="off" required/></td>
</tr>

<tr>
    <td>Confirm Password</td>
    <td><input type="password" name="confirmpassword" autocomplete="off" required/></td>
</tr>
</table>

<input type="submit" value="Register"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Back"/>
</form>
</div>
</body>
</html>