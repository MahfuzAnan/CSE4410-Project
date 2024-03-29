<?php
include 'dbinfo.php'; 
?>  
<?php
// Always start the session before anything else!
session_start();

// Connect to the database
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");

// Initialize an array to store the month names
$months = array(
    1 => "January",
    2 => "February",
    3 => "March",
    4 => "April",
    5 => "May",
    6 => "June",
    7 => "July",
    8 => "August",
    9 => "September",
    10 => "October",
    11 => "November",
    12 => "December"
);

// Loop through each month
foreach ($months as $monthNum => $monthName) {
    // Construct the SQL query for the current month
    $sql_query = "SELECT GenreName, checkoutnum FROM (SELECT Month(IssueDate) AS month, GenreName, Count(IssueID) AS checkoutnum FROM book AS B, issue AS I
        WHERE B.ISBN = I.ISBN AND Month(IssueDate) = $monthNum AND ExtenDate IS NOT NULL
        GROUP BY month, GenreName) AS V ORDER BY checkoutnum DESC LIMIT 3";

    // Execute the SQL query
    $result = mysqli_query($link, $sql_query) or die(mysqli_error($link));

    if ($result == false) {
        echo 'The query by ISBN failed.';
        exit();
    }

    // Check if there are any results for the current month
    if (mysqli_num_rows($result) > 0) {
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
            <h1><?php echo $monthName; ?> Popular Genre Report</h1>
            <table border="1" style="width:100%">
                <tr>
                    <th>Top Genre</th>
                    <th>No. of Issues Recorded</th>
                </tr>
                <?php while ($row = mysqli_fetch_array($result)) {
                    $GenreName = $row['GenreName'];
                    $checkoutnum = $row['checkoutnum'];
                ?>
                <tr>
                    <td><?php echo $GenreName; ?></td>
                    <td><?php echo $checkoutnum; ?></td>
                </tr>
                <?php
                    }
                ?>
            </table>
            <br>
        </body>
        </html>

        <form action="AdminSummary.php" method="post">
        <input type="submit" value="Back"/>
        </form>

        <?php
    }
}
?>