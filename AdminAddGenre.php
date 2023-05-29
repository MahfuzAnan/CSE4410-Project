
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

<body>
<h1>Add a Genre</h1>

<form action="AfterAddingGenre.php" method="post">
<table>
<tr>
    <td>Genre</td>
    <td><input type="text" name="genre" required/></td>
</tr>

</table>

<input type="submit" name="add"  value="Add" />

<input type="submit" name="remove" value="Remove" />

</form>

<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Log Out"/>
</form>

</body>
</html>