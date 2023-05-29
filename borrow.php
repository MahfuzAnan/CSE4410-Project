<?php
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

    // Check if the book exists and has available copies
    if ($book && $book['no_of_copies'] > 0) {
        // Get the member ID from the session
        $memberId = $_SESSION['member_id'];

        // Insert the borrow details into the borrow table
        $insertSql = "INSERT INTO borrow (member_id, book_id) VALUES ('$memberId', '$bookId')";
        mysqli_query($conn, $insertSql);

        // Decrease the number of copies for the book by 1
        $updateSql = "UPDATE books SET no_of_copies = no_of_copies - 1 WHERE book_id = '$bookId'";
        mysqli_query($conn, $updateSql);

        // Redirect back to the book details page
        header("Location: book_details.php?id=$bookId");
        exit;
    } else {
        // Book not available or does not exist
        header("Location: home.php");
        exit;
    }
} else {
    // Redirect to the home page if no book ID is provided
    header("Location: home.php");
    exit;
}
?>
