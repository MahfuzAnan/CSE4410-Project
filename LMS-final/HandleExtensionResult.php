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
<head>
    <title>Handle Extension Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }

        input[type="text"],
        select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            width: 80px;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }

        .success {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
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

<form action="AdminSummary.php" method="post">
    <input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
    <input type="submit" value="Log Out"/>
</form>

</body>
</html>
