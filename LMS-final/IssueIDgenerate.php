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
$sql_query1 = "Select MAX(CopyID) AS maxcopyID From book AS B, bookcopy AS BC Where B.ISBN = '$isbn' AND B.ISBN = BC.ISBN AND IsHold = 0 AND IsBorrowed = 0 AND IsDamaged = 0";
//Run our sql query
$result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link)); 
if($result1 == false)
{
	echo 'The query by ISBN failed.';
}

$row1 = mysqli_fetch_assoc($result1);
$MaxCopyID = $row1['maxcopyID'];


// Insert data into the issue table
$issueDate = date('Y-m-d');
$returnDate = date('Y-m-d', strtotime('+1 week'));

$sql_query2 = "INSERT INTO issue (Username, ISBN, CopyID, IssueID, ExtenDate, IssueDate, ReturnDate, NumExten) VALUES ('$username', '$isbn', $MaxCopyID, '$issueID', NULL, '$issueDate', '$returnDate', 0)";
$result2 = mysqli_query($link, $sql_query2) or die(mysqli_error($link));

// Update the IsBorrowed value in bookcopy table
$sql_query3 = "UPDATE bookcopy SET IsBorrowed = 1 WHERE ISBN = '$isbn' AND CopyID = $MaxCopyID";
$result3 = mysqli_query($link, $sql_query3) or die(mysqli_error($link));

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
    <td>The action was successful. Your return date will be </td>
    <td><?php echo $returnDate; ?></td>
</tr>

<tr>
    <td>Your Issue ID--------------------------------------------------</td>
    <td><?php echo $issueID; ?></td>
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