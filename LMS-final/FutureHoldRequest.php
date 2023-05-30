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

// Getting the max number of copies
$sql_query1 = "Select MAX(CopyID) AS maxcopyID From book AS B, bookcopy AS BC Where B.ISBN = '$isbn' AND B.ISBN = BC.ISBN";
//Run our sql query
$result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link)); 
if($result1 == false)
{
	echo 'The query by ISBN failed.';
}

$row1 = mysqli_fetch_assoc($result1);
$MaxCopyID = $row1['maxcopyID'] + 1;


// Updating the bookcopy table (IsHold is set to 1)
$sql_query2 = "INSERT INTO bookcopy (ISBN, CopyID, IsBorrowed, IsHold, IsDamaged, FuRequester) VALUES ('$isbn', $MaxCopyID, 0, 1, 0, '$username')";
$result2 = mysqli_query($link, $sql_query2) or die(mysqli_error($link));


// Insert data into the issue table (also the Issue ID)
$issueDate = NULL;      // since it's not been issued yet
$returnDate = NULL;

$sql_query3 = "INSERT INTO issue (Username, ISBN, CopyID, IssueID, ExtenDate, IssueDate, ReturnDate, NumExten) VALUES ('$username', '$isbn', $MaxCopyID, '$issueID', NULL, '$issueDate', '$returnDate', 0)";
$result3 = mysqli_query($link, $sql_query3) or die(mysqli_error($link));

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
            width: 80px;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
</style>

</head>
<body>
<table>
<tr>
    <td>Your Future Hold Request has been Acknowledged. You will be informed later when the copy is available (Check Dashboard) </td>
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