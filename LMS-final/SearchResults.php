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
$sql_query1 = "Select B.ISBN, Title, Edition, ReleasedYear, GenreName From book AS B
Where ( (B.ISBN LIKE '%".$isbn."%') AND (B.Title LIKE '%".$title."%')) ";

//Run our sql query
$result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));

//Our SQL Query
$sql_query2 = " Select B.ISBN, Title, Edition, ReleasedYear, GenreName From book AS B 
Where B.ISBN IN (Select A.ISBN AS results From author AS A Where  (A.Author LIKE '%".$author."%') )
AND B.ISBN NOT IN (SELECT ISBN FROM ($sql_query1) AS Q1)";

//Run our sql query
$result2 = mysqli_query ($link, $sql_query2)  or die(mysqli_error($link));


// All books
$sql_query3 = " Select B.ISBN, Title, Edition, ReleasedYear, GenreName From book AS B";

//Run our sql query
$result3 = mysqli_query ($link, $sql_query3)  or die(mysqli_error($link));

?> 


<html>
<head>
<style>

  table {
    border-collapse: collapse;
    width: 100%;
  }
  th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  th {
    background-color: #f2f2f2;
  }
  h1, h2 {
    text-align: center;
  }
  form {
    text-align: center;
    margin-top: 20px;
  }
  input[type="submit"] {
	
  padding: 8px 15px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #333;
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
<h1>Search Results</h1>

<form action="ShowBook.php" method="post">


<table border="1" style="width:100%">
  <tr>
	  <th>Select</th>
    <th>ISBN</th>
    <th>Title of the book</th>
    <th>Edition</th>
    <th>Released Year</th>
    <th>Genre</th>
  </tr>

  <?php 
  
  $row_count1 = mysqli_num_rows($result1);
  $row_count2 = mysqli_num_rows($result2);

  if ($row_count1 == 0 && $row_count2 == 0) 
  {
    echo "<tr><td colspan='4'>There are no exact matches. Here are some books with close matches:</td></tr>";
    while($row = mysqli_fetch_array($result3))
    { 
      
      $ISBN = $row['ISBN'];
      $Title = $row['Title'];
      $Edition = $row['Edition'];
      $ReleasedYear = $row['ReleasedYear'];
      $GenreName = $row['GenreName'];
      ?>

      <tr>
        <td><input type="radio" name="ISBN" value="<?php echo $ISBN; ?>" required></td>
        <td><?php echo $ISBN; ?></td>
        <td><?php echo $Title; ?></td>
        <td><?php echo $Edition; ?></td>
        <td><?php echo $ReleasedYear; ?></td>
        <td><?php echo $GenreName; ?></td>
      </tr>
    <?php
    }
  }

  else
  {

      while($row = mysqli_fetch_array($result1))
      { 

        $ISBN = $row['ISBN'];
        $Title = $row['Title'];
        $Edition = $row['Edition'];
        $ReleasedYear = $row['ReleasedYear'];
        $GenreName = $row['GenreName'];
        ?>

        <tr>
          <td><input type="radio" name="ISBN" value="<?php echo $ISBN; ?>" required></td>
          <td><?php echo $ISBN; ?></td>
          <td><?php echo $Title; ?></td>
          <td><?php echo $Edition; ?></td>
          <td><?php echo $ReleasedYear; ?></td>
          <td><?php echo $GenreName; ?></td>
        </tr>
        <?php
      }		// Ends the while loop for the first query results 
      
      if(!empty($isbn) || !empty($title))
      {
        echo "<tr><td colspan='6'><strong>No other Exact matches  - - Here are the books with close matches:</strong></td></tr>";
      }
  

  while ($row = mysqli_fetch_array($result2)) {
      $ISBN = $row['ISBN'];
      $Title = $row['Title'];
      $Edition = $row['Edition'];
      $ReleasedYear = $row['ReleasedYear'];
      $GenreName = $row['GenreName'];
    ?>
  
  <tr>
          <td><input type="radio" name="ISBN" value="<?php echo $ISBN; ?>" required></td>
          <td><?php echo $ISBN; ?></td>
          <td><?php echo $Title; ?></td>
          <td><?php echo $Edition; ?></td>
          <td><?php echo $ReleasedYear; ?></td>
          <td><?php echo $GenreName; ?></td>
        </tr>
      <?php
      } // End of the while loop for the second query results

}

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