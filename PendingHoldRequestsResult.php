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


if (isset($_POST['dismiss'])) 
{
    $selectedCopy = $_POST['selectedCopy'];
    $selectedValues = explode('_', $selectedCopy);
    $selectedISBN = $selectedValues[0];
    $selectedCopyID = $selectedValues[1];


    // Update IsHold and IsBorrowed values in the bookcopy table
    $updateBookcopyQuery = "UPDATE bookcopy SET IsHold = 0, IsBorrowed = 1 WHERE ISBN = '$selectedISBN' AND CopyID = '$selectedCopyID'";
    $resultBookcopy = mysqli_query($link, $updateBookcopyQuery) or die(mysqli_error($link));

    // Generate the Issue ID
    $currentYear = date('Y');
    $currentMonth = date('m');
    $currentDate = date('d');
    $currentHour = date('H');
    $currentMinute = date('i');
    $currentSecond = date('s');

    $issueID = $currentYear . $currentMonth . $currentDate . '_' . $selectedISBN . '_' . $currentHour . $currentMinute . $currentSecond;

    // Update the relevant records in the issue table
    $updateIssueQuery = "UPDATE issue SET IssueID = '$issueID' , IssueDate = CURDATE(), ReturnDate = DATE_ADD(CURDATE(), INTERVAL 7 DAY) WHERE ISBN = '$selectedISBN' AND CopyID = '$selectedCopyID'";
    $resultIssue = mysqli_query($link, $updateIssueQuery) or die(mysqli_error($link));

    if ($resultBookcopy && $resultIssue) {
        echo "Request dismissed successfully.";
    } else {
        echo "Failed to dismiss the request.";
    }
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
