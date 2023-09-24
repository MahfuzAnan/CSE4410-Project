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

// Query to retrieve the issues that have exceeded the return date
$sql_query = "SELECT I.IssueID, I.IssueDate, I.ReturnDate, U.Username, B.Title
FROM issue AS I
INNER JOIN user AS U ON I.Username = U.Username
INNER JOIN book AS B ON I.ISBN = B.ISBN
WHERE CURDATE() > I.ReturnDate AND I.ReturnDate != '0000-00-00'";

// Run the SQL query
$result = mysqli_query($link, $sql_query) or die(mysqli_error($link));

?>


<!DOCTYPE html>
<html>
<head>
  <title>Check Return Dates</title>
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
  <h1>Check Return Dates</h1>

  <table>
    <tr>
      <th>Issue ID</th>
      <th>Issue Date</th>
      <th>Return Date</th>
      <th>Username</th>
      <th>Book Title</th>
    </tr>

    <?php
    // Fetch and display the overdue issues
    while ($row = mysqli_fetch_array($result)) {
      $issueID = $row['IssueID'];
      $issueDate = $row['IssueDate'];
      $returnDate = $row['ReturnDate'];
      $username = $row['Username'];
      $bookTitle = $row['Title'];
      ?>

      <tr>
        <td><?php echo $issueID; ?></td>
        <td><?php echo $issueDate; ?></td>
        <td><?php echo $returnDate; ?></td>
        <td><?php echo $username; ?></td>
        <td><?php echo $bookTitle; ?></td>
      </tr>

      <?php
    }

    // If no overdue issues found
    if (mysqli_num_rows($result) == 0) {
      ?>

      <tr>
        <td colspan="5">No issues have exceeded the return date.</td>
      </tr>

      <?php
    }
    ?>

  </table>

  <form action="AdminSummary.php" method="post">
    <input type="submit" value="Go Back"/>
  </form>

  <form action="Login.php" method="post">
    <input type="submit" value="Log Out"/>
  </form>

</body>
</html>