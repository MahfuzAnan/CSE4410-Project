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
$sql_query1 = "SELECT I.Username, I.IssueID, I.ISBN, B.Title, B.Edition, I.IssueDate, I.ReturnDate
FROM issue AS I, book AS B
WHERE I.ISBN = B.ISBN AND I.NumExten = -1";

//Run our sql query
$result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link)); 
if($result1 == false)
{
	echo 'The query by ISBN failed.';
}

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

<form action="HandleExtensionResult.php" method="post">

<h1>Extension Requests</h1>
<table border="1" style="width:100%">
  <tr>
    <th>Select</th>
    <th>Username</th>
    <th>Issue ID</th>
    <th>ISBN</th>
    <th>Title</th>
    <th>Edition</th>
    <th>Issue Date</th>
    <th>Return Date</th>
  </tr>

  <?php while($row1 = mysqli_fetch_array($result1))
  {
    $username = $row1['Username'];
    $issueID = $row1['IssueID'];
    $ISBN = $row1['ISBN'];
    $title = $row1['Title'];
    $edition = $row1['Edition'];
    $issueDate = $row1['IssueDate'];
    $returnDate = $row1['ReturnDate'];
  ?>
  
  <tr>
    <td><input type="radio" name="ISBN" value="<?php echo $ISBN; ?>" required></td>
    <td><?php echo $username; ?></td>
    <td><?php echo $issueID; ?></td>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $title; ?></td>
    <td><?php echo $edition; ?></td>
    <td><?php echo $issueDate; ?></td>
    <td><?php echo $returnDate; ?></td>
  </tr>
<?php
} // Ends the while loop for the query results
?>
</table>
  <div class="btn-container">
    <input type="submit" value="Approve" name="approve"/>
  </div>
  <div class="btn-container">
    <input type="submit" value="Deny" name="deny"/>
  </div>
</form>


<form action="AdminSummary.php" method="post">
  <div class="btn-container">
    <input type="submit" value="Back"/>
  </div>
</form>

<form action="Login.php" method="post">
  <div class="btn-container">
    <input type="submit" value="Log Out"/>
  </div>
</form>

</body>
</html>