<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$username = $_SESSION['username'];
$today = date("Y-m-d");
$plus = strtotime("+14 day", time());
$estimate = date('Y-m-d', $plus);
if(isset($_POST['isbn']) and isset($_POST['copyid']) and isset($_POST['issueid']))  {
	$isbn = $_POST['isbn'];
	$copyid = $_POST['copyid'];
	$issueid = $_POST['issueid'];
	$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
	mysqli_select_db($link, $database) or die( "Unable to select database");
	//Our SQL Query
	$sql_query = "Select Max(IssueID) AS givenissueid, IsChecked From issue AS I, bookcopy AS BC Where I.ISBN = '$isbn' AND I.CopyID = '$copyid' AND I.ISBN = BC.ISBN AND I.CopyID = BC.CopyID";
	//Run our sql query
    $result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}
	$row = mysqli_fetch_array($result);
	$givenissueid = $row['givenissueid'];
	$ischecked = $row['IsChecked'];
	if($ischecked == 1) {
		echo 'Error: This book is checked out.';
	} elseif($issueid == $givenissueid) {
		$sql_query = "UPDATE issue AS I SET ExtenDate = '$today', IssueDate = '$today', ReturnDate = '$estimate' Where I.IssueID = '$issueid'";
		//Run our sql query
		$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
		if($result == false)
		{
			echo 'The query by ISBN failed.';
			exit();
		}
		$sql_query = "UPDATE bookcopy AS BC SET IsHold = 0, IsChecked = 1 Where BC.ISBN = '$isbn' AND BC.CopyID = '$copyid'";
		//Run our sql query
		$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
		if($result == false)
		{
			echo 'The query by ISBN failed.';
			exit();
		}
		header('Location: ConfirmCheckout.php');		
	} else {
		echo 'Wrong IssueID';
	}
}
?> 
<html>
<head>
    <title>Book Checkout</title>
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

        input[type="text"] {
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
            width: 250px;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }

        .center {
            text-align: center;
        }

        .info {
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
<h1>Book Checkout</h1>

<form action="" method="post">
<table>
<tr>
    <td>Issue ID</td>
    <td><input type="text" name="issueid" required/></td>
</tr>
<tr>
    <td>ISBN</td>
    <td><input type="text" name="isbn" required/></td>
</tr>
<tr>
    <td>Copy Number</td>
    <td><input type="text" name="copyid" required/></td>
</tr>

<tr>
    <td>Username</td>
    <td><?php echo $username; ?></td>
</tr>

<tr>
    <td>Check Out Date</td>
    <td><?php echo $today; ?></td>
</tr>

<tr>
    <td>Estimated Return Date</td>
    <td><?php echo $estimate; ?></td>
</tr>

</table>
<input type="submit" value="Confirm"/>
</form>
<form action="UserSummary.php" method="post">
<input type="submit" value="Cancel"/>
</form>
</body>
</html>