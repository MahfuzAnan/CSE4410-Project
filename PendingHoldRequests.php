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


//Our SQL Query
$sql_query1 = "SELECT DISTINCT I.IssueID, I.Username, B.ISBN, B.Title, B.Edition, B.GenreName, B.ReleasedYear, BC.CopyID
FROM issue AS I
INNER JOIN book AS B ON I.ISBN = B.ISBN
INNER JOIN bookcopy AS BC ON I.ISBN = BC.ISBN AND I.CopyID = BC.CopyID
WHERE BC.IsHold = 1" ;

//Run our sql query
$result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link)); 
if($result1 == false)
{
	echo 'The query by ISBN failed.';
}

?>


<html>
<body>

<form action="PendingHoldRequestsResult.php" method="post">

<h1>Pending Future Hold Requests</h1>
<table border="1" style="width:100%">
  <tr>
    <th>Select</th>
    <th>Username</th>
    <th>Issue ID</th>
    <th>ISBN</th>
    <th>Title</th>
    <th>Edition</th>
    <th>Genre Name</th>
    <th>Released Year</th>
    <th>Copy ID</th>
  </tr>

  <?php while($row = mysqli_fetch_array($result1))
  {
    $username = $row['Username'];
    $issueID = $row['IssueID'];
    $ISBN = $row['ISBN'];
    $title = $row['Title'];
    $edition = $row['Edition'];
    $genreName = $row['GenreName'];
    $releasedYear = $row['ReleasedYear'];
    $copyID = $row['CopyID'];
  ?>
  
  <tr>
    <td><input type="radio" name="selectedCopy" value="<?php echo $ISBN . '_' . $copyID; ?>" required></td>
    <td><?php echo $username; ?></td>
    <td><?php echo $issueID; ?></td>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $title; ?></td>
    <td><?php echo $edition; ?></td>
    <td><?php echo $genreName; ?></td>
    <td><?php echo $releasedYear; ?></td>
    <td><?php echo $copyID; ?></td>
  </tr>
<?php
} // Ends the while loop for the query results
?>
</table>

<input type="submit" value="Dismiss Request" name="dismiss"/>

</form>


<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Log Out"/>
</form>

</body>
</html>