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

if(isset($_POST['genre'])) 
{

        $genre = $_POST['genre'];

        if (isset($_POST['add']))  
        {
            // Insert the genre
            $sql_query = "INSERT INTO `genre` (`GenreName`) VALUES ('$genre')";
            $result = mysqli_query($link, $sql_query) or die(mysqli_error($link));

            if($result == false)
        	{
        		echo 'The query has failed!';
        	}
            else
            {
                echo "Genre added successfully.";
            }

        } 
        
        elseif (isset($_POST['remove']))  
        {
            // Remove the genre
            $sql_query = "DELETE FROM `genre` WHERE `GenreName` = '$genre'";
            $result = mysqli_query($link, $sql_query) or die(mysqli_error($link));

            if($result == false)
        	{
        		echo 'The query has failed!';
        	}
            else
            {
                echo "Genre Removed successfully.";
            }

        }
    
}

?>


<html>
<head>
    <title>After adding genre</title>
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