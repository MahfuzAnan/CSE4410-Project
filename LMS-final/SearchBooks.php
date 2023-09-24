<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('lms-2.jpg');
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        } 

        h1 {
            text-align: center;
            color: #fff;
        }

        form {
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            color: #fff;
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
    </style>
</head>

<?php
include 'dbinfo.php'; 
?>  

<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$username = $_SESSION['username'];
?> 

<body>
<h1>SearchBooks</h1>

<form action="SearchResults.php" method="post">
<table>
<tr>
    <td>ISBN</td>
    <td><input type="text" autocomplete="on" pattern="[0-9Xx]+" name="isbn"/></td>
</tr>

<tr>
    <td>Title</td>
    <td><input type="text" autocomplete="off" name="title"/></td>
</tr>


<tr>
    <td>Author</td>
    <td><input type="text" autocomplete="off" name="author"/></td>
</tr>

</table>

<input type="submit" value="Search"/>

</form>

<form action="UserSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Log Out"/>
</form>

</body>
</html>