<html>
<head>
    <title>Admin Summary</title>
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

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            width: 280px;
            text-align: center;
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
<h1>Admin Summary</h1>

<form action="PopularSubjectReport.php" method="post">
<input type="submit" value="Popular Genre Report"/>
</form>

<form action="FrequentUsersReport.php" method="post">
<input type="submit" value="Frequently Sought Books Report"/>
</form>

<form action="PopularBooksReport.php" method="post">
<input type="submit" value="Popular Books Requested for Future Hold"/>
</form>

<!-- <form action="DamagedBooksReport.php" method="post">
<input type="submit" value="Damaged Books Report"/>
</form> -->

<!-- <form action="LostDamagedBook_Admin.php" method="post">
<input type="submit" value="Lost/Damaged Book"/>
</form> -->

<form action="PendingHoldRequests.php" method="post">
<input type="submit" value="Pending Future Hold Requests"/>
</form>

<form action="HandleExtension.php" method="post">
<input type="submit" value="Handle Extension Requests"/>
</form>

<form action="AdminAddBook.php" method="post">
<input type="submit" value="Add a Book to the Library"/>
</form>

<form action="AdminAddCopy.php" method="post">
<input type="submit" value="Add/Remove Copies of a Book"/>
</form>

<form action="AdminAddGenre.php" method="post">
<input type="submit" value="Add/Remove a Genre"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Log Out"/>
</form>

</body>
</html>