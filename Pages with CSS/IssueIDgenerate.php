<?php
include 'dbinfo.php'; 
?>  

<?php
//always start the session before anything else!!!!!! 
session_start(); 

//connect to the db 
$isbn = $_POST['ISBN'];				// The ISBN came from the "HoldRequestforaBook.php" submit button ($result1 of that page)
$_SESSION['isbn'] = $isbn;
$username = $_SESSION['username'];
$today = date("Y-m-d");
$plus = strtotime("+14 day", time());
$estimate = date('Y-m-d', $plus);

$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

	//Our SQL Query
	$sql_query = "Select Max(IssueID) AS issueid From issue";
	//Run our sql query
    $result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link)); 
	if($result == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}

$row = mysqli_fetch_array($result);
$issueid = $row['issueid'];
$newisssueid = $issueid + 1;

	//Our SQL Query
	$mincopyidstatement = "Select Min(CopyId) AS copyid From bookCopy AS BC Where BC.ISBN = '$isbn' AND IsHold = 0 AND IsChecked = 0 AND IsDamaged = 0";
	//Run our sql query
    $result = mysqli_query ($link, $mincopyidstatement)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}

$row = mysqli_fetch_array($result);
$copyid = $row['copyid'];

	//Our SQL Query
	$insertissue = "INSERT INTO issue (Username, ISBN, CopyID, IssueID, ExtenDate, IssueDate,
	ReturnDate, NumExten) VALUES ('$username', '$isbn', '$copyid', '$newisssueid', null, '$today', '$estimate', 0)";
	//Run our sql query
    $result = mysqli_query ($link, $insertissue)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}

	//Our SQL Query
	$insertissue = "UPDATE bookcopy AS BC SET IsHold = 1 Where BC.ISBN = '$isbn' AND BC.CopyID = '$copyid'";
	//Run our sql query
    $result = mysqli_query ($link, $insertissue)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}
?>


<html>
<head>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }
    th, td {
        padding: 8px;
        border-bottom: 1px solid #dddddd;
        text-align: left;
    }
    input[type="submit"] {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #dddddd;
        border-radius: 4px;
        margin-bottom: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #333;
    }
</style>
</head>
<body>
<table>
<tr>
    <td>YOUR Issue ID</td>
    <td><?php echo $newisssueid; ?></td>
</tr>
</table>

<form action="UserSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Close"/>
</form>

</body>
</html>