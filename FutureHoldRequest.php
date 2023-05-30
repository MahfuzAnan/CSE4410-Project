<?php
include 'dbinfo.php'; 
?>  

<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");
$username = $_SESSION['username'];

$isbn = $_POST['isbn'];				

// Generate the Issue ID
$currentYear = date('Y');
$currentMonth = date('m');
$currentDate = date('d');
$currentHour = date('H');
$currentMinute = date('i');
$currentSecond = date('s');

$issueID = $currentYear . $currentMonth . $currentDate . '_' . $isbn . '_' . $currentHour . $currentMinute . $currentSecond;

//Our SQL Query
$sql_query1 = "Select MAX(CopyID) AS maxcopyID From book AS B, bookcopy AS BC Where B.ISBN = '$isbn' AND B.ISBN = BC.ISBN";
//Run our sql query
$result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link)); 
if($result1 == false)
{
	echo 'The query by ISBN failed.';
}

$row1 = mysqli_fetch_assoc($result1);
$MaxCopyID = $row1['maxcopyID'] + 1;


// Insert data into the issue table
$issueDate = date('Y-m-d');
$returnDate = date('Y-m-d', strtotime('+1 week'));

$sql_query2 = "INSERT INTO bookcopy (ISBN, CopyID, IsBorrowed, IsHold, IsDamaged, FuRequester) VALUES ('$isbn', $MaxCopyID, 0, 1, 0, '$username')";
$result2 = mysqli_query($link, $sql_query2) or die(mysqli_error($link));

?>


<html>
<body>
<table>
<tr>
    <td>Your Future Hold Request has been Acknowledged. You will be informed later when the copy is available</td>
</tr>
</table>

<form action="SearchBooks.php" method="post">
<input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Log Out"/>
</form>

</body>
</html>