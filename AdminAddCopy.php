
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
<h1>Add Copies of a Book</h1>

<form action="AfterAddingCopy.php" method="post">
<table>
<tr>
    <td>ISBN</td>
    <td><input type="text" name="isbn" required/></td>
</tr>

<tr>
    <td>Copies</td>
    <td><input type="number" name="copies" min="0" required/></td>
</tr>

</table>

<input type="submit" name="add" value="Add"/>

<input type="submit" name="remove" value="Remove"/>

</form>

<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Log Out"/>
</form>

<script>
    // Client-side validation to allow non-negative numbers only
    var copiesInput = document.querySelector('input[name="copies"]');

    copiesInput.addEventListener('input', function() 
    {
      if (copiesInput.validity.typeMismatch) {
        copiesInput.setCustomValidity('Please enter a non-negative number.');
      } else {
        copiesInput.setCustomValidity('');
      }
    });

</script>

</body>
</html>