
<html>
<head>
    <title>Add a Book</title>
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
<?php
include 'dbinfo.php'; 
?>  

<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$link = mysqli_connect($host, $user, $pass) or die("Unable to connect");
mysqli_select_db($link, $database) or die("Unable to select database");
$username = $_SESSION['username'];
?> 

<body>
<h1>Add a Book</h1>

<form action="AfterAddingBook.php" method="post">
<table>
<tr>
    <td>ISBN</td>
    <td><input type="text" name="isbn" required/></td>
</tr>

<tr>
    <td>Title</td>
    <td><input type="text" name="title" required/></td>
</tr>

<tr>
    <td>Author(s)</td>
    <td>
        <select name="author_count" required onchange="generateAuthorInputs(this.value)">
            <option value="" disabled selected>Select</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </td>
    </tr>
    <tr id="author_inputs" style="display: none;">
    <td>Author Name(s)</td>
    <td>
        <div id="author_names"></div>
    </td>
</tr>

<tr>
    <td>Cost</td>
    <td><input type="text" name="cost" /></td>
</tr>

<tr>
    <td>Edition</td>
    <td><input type="text" name="edition" required/></td>
</tr>

<tr>
    <td>Published Place</td>
    <td><input type="text" name="publishedplace" required/></td>
</tr>

<tr>
    <td>Publisher</td>
    <td><input type="text" name="publisher" required/></td>
</tr>

<tr>
    <td>Released Year</td>
    <td><input type="number" name="releasedyear" min="1700" max="<?php echo date('Y'); ?>" required/></td>
</tr>

<tr>
    <td>Genre </td>
    <td>
        <select name="genre" required>
            <option value="" disabled selected > Select </option>
            <?php
                $sql_query = "SELECT `GenreName` FROM `genre`";
                $result = mysqli_query($link, $sql_query);
                while ($row = mysqli_fetch_assoc($result)) 
                {
                    $genreName = $row['GenreName'];
                    echo "<option value=\"$genreName\">$genreName</option>";
                }
            ?>
        </select>
    </td>
</tr>


</table>
    
    <input type="submit" value="Add"/>
    
</form>

<form action="AdminSummary.php" method="post">

        <input type="submit" value="Back"/>
              
    </form>

<form action="Login.php" method="post">
        <input type="submit" value="Log Out"/>
    
</form>

<script>
    function generateAuthorInputs(count) 
    {
        var authorInputs = document.getElementById("author_inputs");
        var authorNamesDiv = document.getElementById("author_names");
        
        // Clear previously generated inputs
        authorNamesDiv.innerHTML = "";
        
        if (count > 0) 
        {
            authorInputs.style.display = "table-row";
            
            for (var i = 1; i <= count; i++) 
            {
                var input = document.createElement("input");
                input.type = "text";
                input.name = "author" + i;
                input.placeholder = "Author #" + i;
                input.required = true;
                authorNamesDiv.appendChild(input);
            }
        } 
        
        else 
        {
            authorInputs.style.display = "none";
        }
    }
</script>

</body>
</html>