<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$username = $_SESSION['username'];
$issueid = $_SESSION['issueid'];
$extendate = $_SESSION['extendate'];
$returndate = $_SESSION['returndate'];
$numexten = $_SESSION['numexten'];
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");
$sql_query = "UPDATE issue AS I SET ExtenDate = '$extendate', ReturnDate = '$returndate', NumExten = '$numexten' Where I.IssueID = '$issueid'";
	//Run our sql query
    $result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}
?> 

<html>
<head>
    <title>Extension Success</title>
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
    </style>
</head>
<body>
<h1>Extension Success</h1>
<form action="UserSummary.php" method="post">
<input type="submit" value="Back"/>
</form>
</body>
</html>
