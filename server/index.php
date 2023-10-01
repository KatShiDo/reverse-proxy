<html lang="en">
<head>
<title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<h1>Таблица пользователей данного продукта</h1>
<table>
    <tr><th>Id</th><th>Name</th><th>Surname</th></tr>
<?php
$mysqli = new mysqli("db", "user", "password", "appDB");
$result = $mysqli->query("SELECT * FROM Students");
foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td></tr>";
}
?>
</table>
<a href="/update.php">UPDATE</a>
<a href="/delete.php">DELETE</a>
<a href="/create.php">CREATE</a>
<?php
phpinfo();
?>
</body>
</html>