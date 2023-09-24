<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

$username = $_SESSION['username'];

if(isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email']))  
{
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$name = "$firstname $lastname";
	$email = $_POST['email'];
	$DOB = $_POST['DOB'];
	$address = $_POST['address'];
	$gender = $_POST['gender'];	


	$insertStatement = "INSERT INTO user_detail (Username, Name, DOB, Email, Gender, Nationality) VALUES 
    ('$username', '$name', '$DOB', '$email', '$gender', '$address')";
	$result = mysqli_query ($link, $insertStatement)  or die(mysqli_error($link)); 
	if($result == false) {
		echo 'The query failed.';
		exit();
	} else {
		echo "User has been created successfully.";
        echo "<script>alert('User has been created successfully.')</script>";
        echo "<script>window.location.href = 'Login.php';</script>";
	}
} 


?>

<html>
<head>
    <title>Create Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('lms-2.jpg');
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        form {
            text-align: center;
            margin-top: 20px;
            color: white;

        }

        table {
            margin: 0 auto;
            color: white;
        }

        td {
            padding: 5px;
        }

        input[type="text"],
        textarea {
            width: 300px;
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
	
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container input[type="submit"] {
            background-color: #4CAF50;
        }

        .btn-container input[type="submit"]:hover {
            background-color: #222;
        }
    </style>
</head>	
<body>
<h1>Create Profile</h1>

<form action="" method="post">
<table>
<tr>
    <td>First Name</td>
    <td><input type="text" name="firstname" required/></td>
</tr>
<tr>
    <td>Last Name</td>
    <td><input type="text" name="lastname" required/></td>
</tr>

<tr>
    <td>D.O.B</td>
    <td><input type="text" name="DOB"/></td>
</tr>

<tr>
    <td>Email</td>
    <td><input type="text" name="email" required/></td>
</tr>

<tr>
    <td>Nationality</td>
    <td><textarea name="address" rows="5" cols="30"></textarea></td>
</tr>

</table>


<tr>
    <td>Gender</td>
</tr>


<select name="gender">
  <option value="M">male</option>
  <option value="F">female</option>
</select>





<input type="submit" value="submit"/>

</form>

</form>
<form action="NewUserRegistration.php" method="post">
<input type="Submit" value="Back"/>
</form>

</body>
</html>