<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$username = $_SESSION['username'];
$chargename = $_SESSION['chargename'];
$target = $_SESSION['target'];
$this_penalty = $_POST['charge'];
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");		
	//Our SQL Query
	$sql_query = "Select SF.Penalty AS old_penalty From student_faculty AS SF Where SF.Username = '$chargename'";
	//Run our sql query
	$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));	
	if($result == false)
	{
		echo 'The query failed.';
		exit();
	}
	$row = mysqli_fetch_array($result);
	$old_penalty = $row['old_penalty'];
	$new_penalty = $this_penalty + $old_penalty;
	//Our SQL Query
	$sql_query = "UPDATE student_faculty AS SF SET Penalty = '$new_penalty' Where SF.Username = '$chargename'";
	//Run our sql query
	$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));	
	if($result == false)
	{
		echo 'The query failed.';
		exit();
	}
	if($new_penalty >= 100){
		//Our SQL Query
		$sql_query = "UPDATE student_faculty AS SF SET IsDebarred = 1 Where SF.Username = '$chargename'";
		//Run our sql query
		$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));	
		if($result == false)
		{
			echo 'The query failed.';
			exit();
		}
	}
?> 
<html>
<head>
    <title>Charge Success</title>
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
    </style>
</head>
<body>
<h1>Charge Success</h1>
<form action="<?php echo $target; ?>" method="post">
<input type="submit" value="Back"/>
</form>
</body>
</html>
