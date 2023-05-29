<?php
require "config.php";

// Start the session and check for an active session
session_start();
if (empty($_SESSION["email"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit;
}

$sql = "SELECT * FROM books WHERE no_of_copies > 0";
$result = mysqli_query($conn, $sql);
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .book-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            transition: box-shadow 0.3s ease;
        }

        .book-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .book-card h5 {
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .book-card p {
            margin-bottom: 0.2rem;
            font-size: 0.9rem;
        }

        .container {
            margin-top: 30px;
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
        <h1>Library Management System</h1>
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
        <h2>Available Books</h2>
        <div class="row">
            <?php foreach ($books as $book): ?>
                <div class="col-md-4">
                    <div class="card book-card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $book['title']; ?></h5>
                            <p class="card-text"><strong>Author:</strong> <?php echo $book['author']; ?></p>
                            <p class="card-text"><strong>ISBN:</strong> <?php echo $book['isbn']; ?></p>
                            <a href="book_details.php?id=<?php echo $book['book_id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
