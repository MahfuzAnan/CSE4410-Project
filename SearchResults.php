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

$isbn = $_POST['isbn'];
$title = $_POST['title'];
$author = $_POST['author'];

//Our SQL Query
$sql_query1 = "Select B.ISBN, Title, Edition From book AS B
Where ( (B.ISBN LIKE '%".$isbn."%') AND (B.Title LIKE '%".$title."%')) ";

//Run our sql query
$result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));

//Our SQL Query
$sql_query2 = " Select B.ISBN, Title, Edition From book AS B 
Where B.ISBN IN (Select A.ISBN AS results From author AS A Where  (A.Author LIKE '%".$author."%') )
AND B.ISBN NOT IN (SELECT ISBN FROM ($sql_query1) AS Q1)";

//Run our sql query
$result2 = mysqli_query ($link, $sql_query2)  or die(mysqli_error($link));

?> 


<html>
<body>
<h1>Search Results</h1>

<form action="IssueIDgenerate.php" method="post">


<table border="1" style="width:100%">
  <tr>
	<th>Select</th>
    <th>ISBN</th>
    <th>Title of the book</th>
    <th>Edition</th>

  </tr>

  <?php while($row = mysqli_fetch_array($result1))
  { 
	  
	$ISBN = $row['ISBN'];
	$Title = $row['Title'];
	$Edition = $row['Edition'];
  ?>
  
  <tr>
    <td><input type="radio" name="ISBN" value="<?php echo $ISBN; ?>" required></td>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Edition; ?></td>
  </tr>
<?php
}		// Ends the while loop for the first query results 

while ($row = mysqli_fetch_array($result2)) {
    $ISBN = $row['ISBN'];
    $Title = $row['Title'];
    $Edition = $row['Edition'];
  ?>

<tr>
        <td><input type="radio" name="ISBN" value="<?php echo $ISBN; ?>" required></td>
        <td><?php echo $ISBN; ?></td>
        <td><?php echo $Title; ?></td>
        <td><?php echo $Edition; ?></td>
      </tr>
    <?php
    } // End of the while loop for the second query results

?>


</table>


<input type="submit" value="Select Book"/>

</form>

<form action="SearchBooks.php" method="post">
<input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Log Out"/>
</form>

</body>
</html>