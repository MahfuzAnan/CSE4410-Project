<!--
    <html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 100px;
        }

        .container table {
            width: 100%;
        }

        .container table td {
            padding: 5px;
        }

        .container input[type="text"],
        .container input[type="submit"],
        .container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .container input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
        }

        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Lost Damaged Book</h1>

<form action="CreateProfile.php" method="post">
<table>
<tr>
    <td>ISBN</td>
    <td><input type="text" name="isbn"/></td>
</tr>
<tr>
    <td>Copy Number</td>
    <td><input type="text" name="copynumber"/></td>
</tr>

<tr>
    <td>Last User of Book</td>
    <td><input type="text" name="lastuserofbook"/></td>
</tr>

<tr>
    <td>Amount to be charged</td>
    <td><input type="text" name="charge"/></td>
</tr>

</table>

<tr>
    <td>Return in Damaged Condition</td>

</tr>

<table>
<select>
  <option value="yes">Yes</option>
  <option value="no">no</option>
</select>
</table>

<input type="submit" value="Look for the last user"/>
<input type="submit" value="Submit"/>
<input type="submit" value="cancel"/>


</form>



</body>
</html>

-->

<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            padding: 10px;
            margin-bottom: 10px; /* Adjusted margin-bottom value */
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container table {
            width: 100%;
        }

        .container table td {
            padding: 5px;
        }

        .container input[type="text"],
        .container input[type="submit"],
        .container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .container input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
        }

        .container input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
        <h1>Lost Damaged Book</h1>
<div class="container">
    <form action="CreateProfile.php" method="post">
        <table>
            <tr>
                <td>ISBN</td>
                <td><input type="text" name="isbn"/></td>
            </tr>
            <tr>
                <td>Copy Number</td>
                <td><input type="text" name="copynumber"/></td>
            </tr>

            <tr>
                <td>Last User of Book</td>
                <td><input type="text" name="lastuserofbook"/></td>
            </tr>

            <tr>
                <td>Amount to be charged</td>
                <td><input type="text" name="charge"/></td>
            </tr>
        </table>

        <table>
            <tr>
                <td>Return in Damaged Condition</td>
            </tr>
            <tr>
                <td>
                    <select>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </td>
            </tr>
        </table>

        <input type="submit" value="Look for the last user"/>
        <input type="submit" value="Submit"/>
        <input type="submit" value="Cancel"/>
    </form>
</div>

</body>
</html>
