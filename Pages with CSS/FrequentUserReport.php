
<html>
<head>
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
            text-align: center;
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
        }

        td, th {
            padding: 8px;
            text-align: center;
        }

        select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
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
            background-color: #333;
        }

        table.report {
            width: 100%;
            border-collapse: collapse;
        }

        table.report th {
            background-color: #333;
            color: white;
        }

        table.report th,
        table.report td {
            padding: 8px;
            border: 1px solid #ccc;
        }
</style>
</head>
<body>
<h1>Frequent User Report</h1>
<form action="SearchBooks.php" method="post">


<tr>
    <td>Month</td>

</tr>

<table>
<select>
  <option value="january">january</option>
  <option value="february">february</option>
<option value="march">march</option>
<option value="april">april</option>
<option value="may">may</option>
<option value="june">june</option>
<option value="july">july</option>
<option value="august">august</option>
<option value="september">september</option>
<option value="october">october</option>
<option value="november">november</option>
<option value="december">december</option>
</select>
</table>

<input type="submit" value="show report"/>

<table border="1" style="width:100%">
  <tr>
    <th>Month</th>
    <th>User Name</th>
    <th>#chechouts</th>
  </tr>
  <tr>
    <td>Jill</td>
    <td>Smith</td>
    <td>50</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
  </tr>
</table>


</body>
</html>