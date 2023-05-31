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
<body>

<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>