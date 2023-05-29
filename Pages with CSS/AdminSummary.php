<!DOCTYPE html>
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
            width: 250px;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <h1>Admin Summary</h1>

    <form action="PopularSubjectReport.php" method="post">
        <input type="submit" value="Popular Subject Report"/>
    </form>

    <form action="FrequentUsersReport.php" method="post">
        <input type="submit" value="Frequent User Report"/>
    </form>

    <form action="PopularBooksReport.php" method="post">
        <input type="submit" value="Popular Books Report"/>
    </form>

    <form action="DamagedBooksReport.php" method="post">
        <input type="submit" value="Damaged Books Report"/>
    </form>

    <form action="LostDamagedBook_Admin.php" method="post">
        <input type="submit" value="Lost/Damaged Book"/>
    </form>

    <form action="AdminAddBook.php" method="post">
        <input type="submit" value="Add a Book to the Library"/>
    </form>

    <form action="AdminAddGenre.php" method="post">
        <input type="submit" value="Add a Genre of Books"/>
    </form>

    <form action="Login.php" method="post">
        <input type="submit" value="Close"/>
    </form>
</body>
</html>
