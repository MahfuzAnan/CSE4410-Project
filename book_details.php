<?php
// Your database connection code
require "config.php";

// Start the session and check for an active session
session_start();
if (empty($_SESSION["email"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit;
}

// Check if the book ID is provided in the URL
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Retrieve the book details from the database
    $sql = "SELECT * FROM books WHERE book_id = '$bookId'";
    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);
} else {
    // Redirect to the home page if no book ID is provided
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - Book Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 30px;
        }

        .card {
            width: 300px;
            margin: auto;
            margin-top: 20px;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            margin-bottom: 5px;
        }

        header {
            background-color: #333;
            padding: 20px;
            color: #fff;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        header nav ul li {
            display: inline;
            margin-right: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
        }

        header nav ul li a:hover {
            color: #ccc;
        }
        
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Library Management System</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search...">
            <button class="search-icon" type="submit">Search</button>
        </div>
    </header>

    <div class="container">
        <h2>Book Details</h2>
        <div class="card">
            <h5 class="card-title"><?php echo $book['title']; ?></h5>
            <p class="card-text"><strong>Author:</strong> <?php echo $book['author']; ?></p>
            <p class="card-text"><strong>ISBN:</strong> <?php echo $book['isbn']; ?></p>
            <!-- <p class="card-text"><strong>Category:</strong> <?php echo $book['category']; ?></p>
            <p class="card-text"><strong>Description:</strong> <?php echo $book['description']; ?></p> -->
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
