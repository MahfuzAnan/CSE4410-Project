<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

if(isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email']))  {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$name = "$firstname $lastname";
	$email = $_POST['email'];
	$DOB = $_POST['DOB'];
	$address = $_POST['address'];
	$gender = $_POST['gender'];
	$isfaculty = $_POST['isfaculty'];
	
	$username = $_SESSION['username'];
	
	if($isfaculty == "1") {
		$dept = $_POST['dept'];
	} else {
		$dept = null;
	}

	$insertStatement = "INSERT INTO student_faculty (Username, Name, DOB, Email, Gender, Address,
	IsFaculty, Dept) VALUES ('$username', '$name', '$DOB', '$email', '$gender', '$address', '$isfaculty',
	'$dept')";
	$result = mysqli_query ($link, $insertStatement)  or die(mysqli_error($link)); 
	if($result == false) {
		echo 'The query failed.';
		exit();
	} else {
		header('Location: Login.php');
	}
} 


?>

<html>
<head>
    <title>Create Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
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
    <td>Address</td>
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


<tr>
    <td>Are you a faculty</td>

</tr>

<table>
<select name="isfaculty">
  <option value="1">Yes</option>
  <option value="0">no</option>
</select>
</table>


<tr>
    <td>Associate Department</td>

</tr>
</table>
<table>
<select name="dept">
  <option value="School of Electrical & Computer Engineering">Electrical Engineering</option>
  <option value="College of Computing">Computer Science</option>
  <option value="School of Industrial & Systems Engineering">Industrial & Systems Engineering</option>
</select>
</table>


<input type="submit" value="submit"/>
</form>
</body>
</html>