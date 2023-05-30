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

$isbn = $_POST['ISBN'];

// SQL query to retrieve the book details based on the selected ISBN
$sql_query1 = "SELECT B.ISBN, B.Title, B.Edition, B.PublishedPlace, B.Publisher, B.ReleasedYear, B.GenreName, (
    SELECT GROUP_CONCAT(A.Author SEPARATOR ', ')
    FROM author AS A
    WHERE A.ISBN = B.ISBN
    ) AS Authors
    FROM book AS B
    WHERE B.ISBN = '$isbn'";

// Run the SQL query
$result1 = mysqli_query($link, $sql_query1) or die(mysqli_error($link));

// SQL query to retrieve the number of copies available of the selected ISBN
$sql_query2 = "Select COUNT(CopyId) AS copynum, MAX(CopyID) AS maxcopyID From book AS B, bookcopy AS BC Where B.ISBN = '$isbn' AND B.ISBN = BC.ISBN AND IsHold = 0 AND IsBorrowed = 0 AND IsDamaged = 0";
// Run the SQL query
$result2 = mysqli_query($link, $sql_query2) or die(mysqli_error($link));


// Fetch the book details
$row = mysqli_fetch_assoc($result1);
$ISBN = $row['ISBN'];
$Title = $row['Title'];
$Edition = $row['Edition'];
$PublishedPlace = $row['PublishedPlace'];
$Publisher = $row['Publisher'];
$ReleasedYear = $row['ReleasedYear'];
$GenreName = $row['GenreName'];
$Authors = $row['Authors'];
$Empty = '';


// Fetch the CopyID(s)
$row2 = mysqli_fetch_assoc($result2);
$CopyNum = $row2['copynum'];
$MaxCopyID = $row2['maxcopyID'];

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
            width: 160px;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 100px;
        }

        .container table {
            width: 100%;
        }

        .container table td {
            padding: 5px;
        }

        .container input[type="text"],
        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .container input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
			
        }

        .container input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<h1>Book Details</h1>
<div class="container">
<table>
    <tr>
        <td><strong>ISBN:</strong></td>
        <td><?php echo $ISBN; ?></td>
    </tr>
    <tr>
        <td><strong>Title:</strong></td>
        <td><?php echo $Title; ?></td>
    </tr>
    <tr>
        <td><strong>Edition:</strong></td>
        <td><?php echo $Edition; ?></td>
    </tr>
    <tr>
        <td><strong>Published Place:</strong></td>
        <td><?php echo $PublishedPlace; ?></td>
    </tr>
    <tr>
        <td><strong>Publisher:</strong></td>
        <td><?php echo $Publisher; ?></td>
    </tr>
    <tr>
        <td><strong>Released Year:</strong></td>
        <td><?php echo $ReleasedYear; ?></td>
    </tr>
    <tr>
        <td><strong>Genre Name:</strong></td>
        <td><?php echo $GenreName; ?></td>
    </tr>
    <tr>
        <td><strong>Authors:</strong></td>
        <td><?php echo $Authors; ?></td>
    </tr>
    <tr>
        <td><strong>Available Copies:</strong></td>
        <td><?php echo $CopyNum; ?></td>
    </tr>
    <!-- <tr>
        <td><strong>The CopyID:</strong></td>
        <td><?php echo $MaxCopyID; ?></td>
    </tr> -->
</table>
    </div>

<form action="IssueIDgenerate.php" method="post">
    <input type="hidden" name="isbn" value="<?php echo $ISBN; ?>">
    <input type="submit" value="Borrow Request" <?php if ($CopyNum <= 0) echo 'disabled'; ?>>
</form>

<form action="FutureHoldRequest.php" method="post">
    <input type="hidden" name="isbn" value="<?php echo $ISBN; ?>">
    <input type="submit" value="Future Hold Request" <?php if ($CopyNum > 0) echo 'disabled'; ?>>
</form>

<form action="SearchResults.php" method="post">
    <input type="hidden" name="isbn" value="<?php echo $ISBN; ?>">
    <input type="hidden" name="title" value="<?php echo $Empty; ?>">
    <input type="hidden" name="author" value="<?php echo $Empty; ?>">
    <input type="submit" value="Back">
</form>

<form action="Login.php" method="post">
<input type="submit" value="Log Out"/>
</form>

</body>
</html>