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

if(isset($_POST['isbn'])) 
{
    $isbn = $_POST['isbn'];
    $copies = $_POST['copies'];
  
    // Check if the provided ISBN exists in the database
    $sql_query = "SELECT COUNT(*) AS `count` FROM `book` WHERE `ISBN` = '$isbn'";
    $result = mysqli_query($link, $sql_query) or die(mysqli_error($link));
    $row = mysqli_fetch_array($result);
    $count = $row['count'];

    if ($count == 0) 
    {
      echo "The provided ISBN does not exist in the database.";
    } 
    
    else
    {
        // Get the current maximum CopyID for the matched ISBN
        $sql_query = "SELECT MAX(`CopyID`) AS `maxCopyID` FROM `bookcopy` WHERE `ISBN` = '$isbn'";
        $result = mysqli_query($link, $sql_query) or die(mysqli_error($link));
        $row = mysqli_fetch_array($result);
        $maxCopyID = $row['maxCopyID'];
        
        if (isset($_POST['add'])) 
        {
            // Insert new copies with incremented CopyID values
            for ($i = 1; $i <= $copies; $i++) 
            {
              $copyID = $maxCopyID + $i;
              $sql_query = "INSERT INTO `bookcopy` (`ISBN`, `CopyID`) VALUES ('$isbn', '$copyID')";
              mysqli_query($link, $sql_query) or die(mysqli_error($link));
            }
        
            echo "Successfully added $copies copies of ISBN $isbn.";
        } 

        elseif (isset($_POST['remove'])) 
        {
            // Check if the number of copies to be removed is valid
            $sql_query = "SELECT COUNT(*) AS `existingCopies` FROM `bookcopy` WHERE `ISBN` = '$isbn'";
            $result = mysqli_query($link, $sql_query) or die(mysqli_error($link));
            $row = mysqli_fetch_array($result);
            $existingCopies = $row['existingCopies'];

            if ($copies > $existingCopies) 
            {
                echo "Invalid operation. There are only $existingCopies copies available to remove.";
            }

            else 
            {
                // Remove existing copies starting from the largest CopyID
                $startCopyID = $maxCopyID;
                $endCopyID = $maxCopyID - $copies + 1;
                $sql_query = "DELETE FROM `bookcopy` WHERE `ISBN` = '$isbn' AND `CopyID` <= $startCopyID AND `CopyID` >= $endCopyID";
                mysqli_query($link, $sql_query) or die(mysqli_error($link));
            
                echo "Successfully removed $copies copies of ISBN $isbn.";
            }
        
        }

    }
  
}


?>


<html>
<head>
    <title>After adding copy</title>
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