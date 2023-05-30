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

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $authorCount = $_POST['author_count'];
    $cost = $_POST['cost'];
    $edition = $_POST['edition'];
    $publishedplace = $_POST['publishedplace'];
    $publisher = $_POST['publisher'];
    $releasedyear = $_POST['releasedyear'];
    $genre = $_POST['genre'];

    $authors = array();                     // Retrieve author names
    for ($i = 1; $i <= $authorCount; $i++) 
    {
        $authorName = $_POST['author' . $i];
        $authors[] = $authorName;
    }

    //Our SQL Query to Insert info into the "book" table
    $sql_query1 = "INSERT INTO `book` (`ISBN`, `Title`, `Cost`, `IsReserved`, `Edition`, `PublishedPlace`, `Publisher`, `ReleasedYear`, `GenreName`) VALUES
    ('$isbn', '$title', $cost, $edition, 0, '$publishedplace', '$publisher', $releasedyear, '$genre')";
    //Run our sql query
    $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));

    if($result1 == false)
    {
    	echo 'The query to insert into the "book" table has failed!';
    }

    else
    {
        echo "Book added successfully!";

        // Check if it's a new ISBN or existing ISBN
        $sql_query2 = "SELECT MAX(`CopyID`) AS `MaxCopyID` FROM `bookcopy` WHERE `ISBN` = '$isbn'";
        $result2 = mysqli_query($link, $sql_query2) or die(mysqli_error($link));
        $row2 = mysqli_fetch_assoc($result2);
        $maxCopyID = $row2['MaxCopyID'];
        
        // Calculate the new CopyID
        $newCopyID = ($maxCopyID != null) ? $maxCopyID + 1 : 1;

        // Update the "bookcopy" table with the new book copy
        $sql_query3 = "INSERT INTO `bookcopy` (`ISBN`, `CopyID`, `IsChecked`, `IsHold`, `IsDamaged`, `FuRequester`) VALUES ('$isbn', $newCopyID, 0, 0, 0, NULL)";
        $result3 = mysqli_query($link, $sql_query3) or die(mysqli_error($link));

        if ($result3 == false) 
        {
            echo 'The query to update the "bookcopy" table has failed!';
        } 
        else 
        {
            echo "Book copy has been added successfully!";
        }

    }


    // Loop through the authors array and insert into the "author" table
    foreach ($authors as $author) 
    {
        // Our SQL query to insert info into the "author" table
        $sql_query4 = "INSERT INTO `author` (`ISBN`, `Author`) VALUES ('$isbn', '$author')";

        // Run our SQL query
        $result4 = mysqli_query($link, $sql_query4) or die(mysqli_error($link));

        if ($result4 == false) 
        {
            echo 'The query to insert into the "author" table has failed!';
            break; // Exit the loop if an insertion fails
        }

    }

    if ($result1 != false && $result4 != false) 
    {
        echo "Book and Author(s) added successfully!";
    }

}

?>


<html>
<head>
    <title>After adding a Book</title>
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

<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>