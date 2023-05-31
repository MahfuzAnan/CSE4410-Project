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

if(isset($_POST['issueid'])) 
{
$issueid = $_POST['issueid'];
$_SESSION['issueid'] = $issueid;

// Retrieve the issue details based on the provided Issue ID
$sql_query1 = "SELECT * FROM issue WHERE IssueID = '$issueid' AND Username = '$username'";
$result1 = mysqli_query($link, $sql_query1) or die(mysqli_error($link));
$row1 = mysqli_fetch_assoc($result1);

if (!$row1) 
{
    echo "Wrong Issue ID";
} 

else 
{
    // Calculate the new ExtenDate and update the issue table
    $returnDate = $row1['ReturnDate'];
    $newExtenDate = date('Y-m-d', strtotime($returnDate . ' + 7 days'));
    $sql_update1 = "UPDATE issue SET ExtenDate = '$newExtenDate', NumExten = -1 WHERE IssueID = '$issueid'";
    mysqli_query($link, $sql_update1) or die(mysqli_error($link));

    echo "Extension Request Successful";
}

}
?> 


<html>
<body>


<form action="ExtensionRequest.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>