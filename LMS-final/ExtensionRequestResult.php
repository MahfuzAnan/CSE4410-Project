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

if(isset($_POST['issueid'])) 
{
$issueid = $_POST['issueid'];
$_SESSION['issueid'] = $issueid;

// Retrieve the issue details based on the provided Issue ID
$sql_query1 = "SELECT * FROM issue WHERE IssueID = '$issueid' AND Username = '$username'";
$result1 = mysqli_query($link, $sql_query1) or die(mysqli_error($link));
$row1 = mysqli_fetch_assoc($result1);

if (!$row1) 
{
    echo "Wrong Issue ID";
} 

else 
{
    // Calculate the new ExtenDate and update the issue table
    $returnDate = $row1['ReturnDate'];
    $newExtenDate = date('Y-m-d', strtotime($returnDate . ' + 7 days'));
    $sql_update1 = "UPDATE issue SET NumExten = -1 WHERE IssueID = '$issueid'";
    mysqli_query($link, $sql_update1) or die(mysqli_error($link));

    echo "Extension Request Successful";
}

}
?> 


<html>
<head>
    <title>Extension Request Result</title>
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
            width: 10%;
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

<form action="Dashboard.php" method="post">
<input type="submit" value="User Dashboard"/>
</form>

<form action="ExtensionRequest.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>