
<!DOCTYPE html>
<html>
<?php
include 'dbinfo.php'; 
?>  

<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$username = $_SESSION['username'];
?> 
<head>
    <title>Add a Genre</title>
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

        input[type="text"] {
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
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
    <h1>Add a Genre</h1>

    <form action="AfterAddingGenre.php" method="post">
        <table>
            <tr>
                <td>Genre</td>
                <td><input type="text" name="genre" required/></td>
            </tr>
        </table>

        <div class="btn-container">
            <input type="submit" value="Add"/>
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