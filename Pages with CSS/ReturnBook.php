<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$username = $_SESSION['username'];
$isbn = null;
$copyid = null;
if(isset($_POST['issueid']) and isset($_POST['isdamaged'])){
	$issueid = $_POST['issueid'];
	$isdamaged = $_POST['isdamaged'];
	$_SESSION['issueid']=$issueid;
	$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
	mysqli_select_db($link, $database) or die( "Unable to select database");
	//Our SQL Query
	$sql_query = "Select I.ISBN AS isbn, I.CopyID AS copyid, I.ReturnDate AS returndate From issue AS I Where I.IssueID = '$issueid'";
	//Run our sql query
	$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));
	if($result == false){
		echo 'The query failed.';
		exit();
	}
	$numrow = mysqli_num_rows($result);
	if($numrow == 0){
		echo 'Wrong issue ID';
	} else {
		$row = mysqli_fetch_array($result);
		$isbn = $row['isbn'];
		$copyid = $row['copyid'];
		$_SESSION['isbn']=$isbn;
		$_SESSION['copyid']=$copyid;
		$returndate = $row['returndate'];
		$returndate_copy = new DateTime($returndate);	
		$today = date("Y-m-d");
		$today_copy = new DateTime($today);
		$interval = $today_copy->diff($returndate_copy)->days; // returndate_copy - today_copy
		$invert = $today_copy->diff($returndate_copy)->invert;
		if($invert == 1) {
			$this_penalty = $interval * 0.5;
			//Our SQL Query
			$sql_query = "Select SF.Penalty AS old_penalty From student_faculty AS SF Where SF.Username = '$username'";
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
			$sql_query = "UPDATE student_faculty AS SF SET Penalty = '$new_penalty' Where SF.Username = '$username'";
			//Run our sql query
			$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));	
			if($result == false)
			{
				echo 'The query failed.';
				exit();
			}
			if($new_penalty >= 100){
				//Our SQL Query
				$sql_query = "UPDATE student_faculty AS SF SET IsDebarred = 1 Where SF.Username = '$username'";
				//Run our sql query
				$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));	
				if($result == false)
				{
					echo 'The query failed.';
					exit();
				}			
			}
		}			
		//Our SQL Query
		$sql_query = "UPDATE bookcopy AS BC SET IsChecked = 0 Where BC.ISBN = '$isbn' AND BC.CopyID = '$copyid'";
		//Run our sql query
		$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));	
		if($result == false)
		{
			echo 'The query failed.';
			exit();
		}
		echo 'Return Success';
		if($isdamaged == 1){
			header('Location: LostDamagedBook_User.php');
		}
	}
}
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
			justify-content: center;
            align-items: center;
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
			
            justify-content: center;
            
			
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
            width: 250px;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
<h1>Return Book</h1>

<form action="" method="post">
<table>
<tr>
    <td>Enter your issue ID</td>
    <td><input type="text" name="issueid" required/></td>
</tr>
<tr>
    <td>ISBN</td>
    <td><?php echo $isbn; ?></td>
</tr>
<tr>
    <td>Copy Number</td>
    <td><?php echo $copyid; ?></td>
</tr>

<tr>
    <td>Username</td>
    <td><?php echo $username; ?></td>
</tr>

</table>

<input type="submit" value="Return"/>


<form action="UserSummary.php" method="post">
<input type="submit" value="Back"/>
</form>


</body>
</html>