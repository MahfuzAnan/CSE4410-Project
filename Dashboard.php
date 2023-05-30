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

// Fetch borrowed books
$sql_borrowed = "SELECT DISTINCT B.ISBN, I.IssueID, B.Title, B.Edition, B.Publisher, B.ReleasedYear, B.GenreName, I.ExtenDate, I.ReturnDate
FROM issue AS I INNER JOIN book AS B ON I.ISBN = B.ISBN WHERE I.Username = '$username'";
$result_borrowed = mysqli_query($link, $sql_borrowed) or die(mysqli_error($link));

// Fetch future hold request books
$sql_hold = "SELECT DISTINCT B.ISBN, B.Title, B.Edition, B.Publisher, B.ReleasedYear, B.GenreName
FROM bookcopy AS BC, book AS B
WHERE BC.ISBN = B.ISBN AND BC.FuRequester = '$username' AND IsHold = 1";
$result_hold = mysqli_query($link, $sql_hold) or die(mysqli_error($link));

// Fetch extended date requests
$sql_extension = "SELECT DISTINCT B.ISBN, I.IssueID, B.Title, B.Edition, B.Publisher, B.ReleasedYear, B.GenreName, I.ExtenDate, I.ReturnDate
FROM book AS B
INNER JOIN issue AS I ON B.ISBN = I.ISBN
WHERE I.Username = '$username' AND I.NumExten = -1";
$result_extension = mysqli_query($link, $sql_extension) or die(mysqli_error($link));


?>


<html>
<body>
<h1>User Dashboard</h1>

<h2>Borrowed Books</h2>
<table border="1" style="width:100%">
  <tr>
    <th>ISBN</th>
    <th>Issue ID</th>
    <th>Title of the book</th>
    <th>Edition</th>
    <th>Publisher</th>
    <th>Released Year</th>
    <th>Genre Name</th>
    <th>Return Date</th>
  </tr>

  <?php while($row = mysqli_fetch_array($result_borrowed))
  { 
    $ISBN = $row['ISBN'];
    $issueID = $row['IssueID'];
    $Title = $row['Title'];
    $Edition = $row['Edition'];
    $Publisher = $row['Publisher'];
    $ReleasedYear = $row['ReleasedYear'];
    $GenreName = $row['GenreName'];
    $extenDate = $row['ExtenDate'];
    $returnDate = $row['ReturnDate'];
  ?>
  
  <tr>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $issueID; ?></td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Edition; ?></td>
    <td><?php echo $Publisher; ?></td>
    <td><?php echo $ReleasedYear; ?></td>
    <td><?php echo $GenreName; ?></td>
    <td>
      <?php
        if ($extenDate > $returnDate) {
          echo $extenDate;
        } else {
          echo $returnDate;
        }
      ?>
    </td>

  </tr>
<?php
} // Ends the while loop for the borrowed books
?>
</table>



<h2>Future Hold Books</h2>
<table>
<table border="1" style="width:100%">
  <tr>
    <th>ISBN</th>
    <th>Issue ID</th>
    <th>Title of the book</th>
    <th>Edition</th>
    <th>Publisher</th>
    <th>Released Year</th>
    <th>Genre Name</th>
  </tr>

  <?php while($row = mysqli_fetch_array($result_hold))
  { 
    $ISBN = $row['ISBN'];
    $Title = $row['Title'];
    $Edition = $row['Edition'];
    $Publisher = $row['Publisher'];
    $ReleasedYear = $row['ReleasedYear'];
    $GenreName = $row['GenreName'];
  ?>
  
  <tr>
    <td><?php echo $ISBN; ?></td>
    <td>Pending...</td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Edition; ?></td>
    <td><?php echo $Publisher; ?></td>
    <td><?php echo $ReleasedYear; ?></td>
    <td><?php echo $GenreName; ?></td>
  </tr>
<?php
} // Ends the while loop for future hold books
?>
</table>



<h2>Extension Requests for Books</h2>
<table>
<table border="1" style="width:100%">
  <tr>
    <th>ISBN</th>
    <th>Issue ID</th>
    <th>Title of the book</th>
    <th>Edition</th>
    <th>Publisher</th>
    <th>Released Year</th>
    <th>Genre Name</th>
    <th>Status</th>
  </tr>

  <?php while($row = mysqli_fetch_array($result_extension))
  { 
    $ISBN = $row['ISBN'];    
    $issueID = $row['IssueID'];
    $Title = $row['Title'];
    $Edition = $row['Edition'];
    $Publisher = $row['Publisher'];
    $ReleasedYear = $row['ReleasedYear'];
    $GenreName = $row['GenreName'];
    $extenDate = $row['ExtenDate'];
    $returnDate = $row['ReturnDate'];
  ?>
  
  <tr>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $issueID; ?></td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Edition; ?></td>
    <td><?php echo $Publisher; ?></td>
    <td><?php echo $ReleasedYear; ?></td>
    <td><?php echo $GenreName; ?></td>
    <td>
      <?php
        if ($extenDate > $returnDate) {
          echo "Approved";
        } elseif ($extenDate == $returnDate) {
          echo "Rejected";
        } else {
          echo "Pending...";
        }
    ?></td>

  </tr>
<?php
} // Ends the while loop for the extension requested books
?>
</table>


<form action="UserSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>