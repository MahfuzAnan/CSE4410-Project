<?php
include 'dbinfo.php'; 
?>

<?php
// Always start the session before anything else
session_start();

// Connect to the database
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");
$username = $_SESSION['username'];


if (isset($_POST['approve'])) 
{
    // Get the selected ISBN from the form
    $selectedISBN = $_POST['ISBN'];
  
    // Update the issue table to set NumExten to 0 and ExtenDate to ReturnDate+7
    $updateQuery = "UPDATE issue SET NumExten = 0, ExtenDate = DATE_ADD(ReturnDate, INTERVAL 7 DAY) WHERE ISBN = '$selectedISBN'";
    $result = mysqli_query($link, $updateQuery) or die(mysqli_error($link));

    if ($result) {
        echo "Extension request approved successfully.";
    } else {
        echo "Failed to approve extension request.";
    }
} 

elseif (isset($_POST['deny'])) 
{
    // Get the selected ISBN from the form
    $selectedISBN = $_POST['ISBN'];

    // Update the issue table to set NumExten to 0 and ExtenDate to ReturnDate
    $updateQuery = "UPDATE issue SET NumExten = 0, ExtenDate = ReturnDate WHERE ISBN = '$selectedISBN'";
    $result = mysqli_query($link, $updateQuery) or die(mysqli_error($link));

    if ($result) {
        echo "Extension request denied successfully.";
    } else {
        echo "Failed to deny extension request.";
    }
} 

else 
{
    echo "Invalid request.";
}

?>

<html>
<body>

<form action="AdminSummary.php" method="post">
    <input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
    <input type="submit" value="Log Out"/>
</form>

</body>
</html>
