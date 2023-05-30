<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 

$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");
//Our SQL Query
$sql_query1 = "Select Title, checkoutnum From (Select Month(IssueDate) AS month, Title, Count(IssueID) AS checkoutnum From book AS B, issue AS I
	Where B.ISBN = I.ISBN AND (Month(IssueDate) = 2 OR Month(IssueDate) = 1) AND ExtenDate IS NOT NULL
	Group by month, Title) AS V Where month = 1 Order by checkoutnum DESC LIMIT 3";
//Run our sql query
$result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));	
if($result1 == false)
{
	echo 'The query by ISBN failed.';
	exit();
}
//Our SQL Query
$sql_query2 = "Select Title, checkoutnum From (Select Month(IssueDate) AS month, Title, Count(IssueID) AS checkoutnum From book AS B, issue AS I
	Where B.ISBN = I.ISBN AND (Month(IssueDate) = 2 OR Month(IssueDate) = 1) AND ExtenDate IS NOT NULL
	Group by month, Title) AS V Where month = 2 Order by checkoutnum DESC LIMIT 3";
//Run our sql query
$result2 = mysqli_query ($link, $sql_query2)  or die(mysqli_error($link));	
if($result2 == false)
{
	echo 'The query by ISBN failed.';
	exit();
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
<h1>Popular Books Report</h1>
<form action="AdminSummary.php" method="post">
<table border="1" style="width:100%">
  <tr>
    <th>Month</th>
    <th>Book Name</th>
    <th>#checkouts</th>
  </tr>
 <?php while($row1 = mysqli_fetch_array($result1)){ 
	  
	$Title = $row1['Title'];
	$checkoutnum = $row1['checkoutnum'];
  ?>
  <tr>
    <td>January</td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $checkoutnum; ?></td>
  </tr>
<?php
}
?>
<?php while($row2 = mysqli_fetch_array($result2)){ 
	  
	$Title = $row2['Title'];
	$checkoutnum = $row2['checkoutnum'];
  ?>
  <tr>
    <td>February</td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $checkoutnum; ?></td>
  </tr>
<?php
}
?>
</table>
<input type="submit" value="Back"/>
</form>

</body>
</html>