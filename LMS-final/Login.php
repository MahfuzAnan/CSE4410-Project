<?php
include 'dbinfo.php'; 
?>  

<html>
<head>
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
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }

        input[type="text"],
        select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            width: 130px;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
<h1>Login</h1>

<?php
//always start the session before anything else!!!!!! 
session_start(); 

if(isset($_POST['username']) and isset($_POST['password']))  { //check null
	$username = $_POST['username']; // text field for username 
	$password = $_POST['password']; // text field for password
	
// store session data
$_SESSION['username']=$username;

//connect to the db 

$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

        //Our SQL Query
        	$sql_query = "Select U.Username From user AS U, staff AS S Where U.Username = '$username' AND U.Password = '$password' AND U.Username = S.Username";  

        //Run our sql query
           $result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
		   
			if($result == false)
			{
				echo 'The query failed.';
				exit();
			}
			if(mysqli_num_rows($result) == 1)
			{ 
			//the username and password matches the database 
			//move them to the page to which they need to go 
				
			// Fetch the row from the result set
				$row = mysqli_fetch_assoc($result);
				$fetchedUsername = $row['Username'];
				
				// Debug output
				echo "Query returned 1 row. Fetched username: $fetchedUsername";

				header('Location: AdminSummary.php');	
				exit();
			}


		//Our SQL Query
           $sql_query = "Select Username From user Where Username = '$username' AND Password = '$password'";  

            //Run our sql query
           $result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
			if($result == false)
			{
				echo 'The query failed.';
				exit();
			}

			//this is where the actual verification happens 
			if(mysqli_num_rows($result) == 1){ 
			//the username and password matches the database 
			//move them to the page to which they need to go 
				header('Location: UserSummary.php');
			   
			}else{ 
			$err = 'Incorrect username or password' ; 
			} 
			//then just above your login form or where ever you want the error to be displayed you just put in 
			echo "$err";
    } 
	
?>	

<form action="" method="post">
<table>
<tr>
    <td>Username</td>
    <td><input type="text" name="username" required/></td>
</tr>
<tr>
    <td>Password</td>
    <td><input type="text" name="password" required/></td>
</tr>
</table>

<input type="Submit" value="Login"/>
</form>
<form action="NewUserRegistration.php" method="post">
<input type="Submit" value="Create Account"/>
</form>


</body>
</html>