<html lang="en">
<head>
<title>Update</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<form action="update.php" method="post">
    <p>
        <label for="id">ID:</label>
        <input type="text" name="id" id="id">
    </p>
    <p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
    </p>
    <p>
        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname">
    </p>

    <input type="submit" value="Submit">
</form>

<a href="/index.php">RETURN</a>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn = new mysqli('db', 'user', 'password', 'appDB');

    $name = $_REQUEST['name'];
    $surname = $_REQUEST['surname'];
    $id = $_REQUEST['id'];

    $sql = "UPDATE users SET name = '$name', surname = '$surname' WHERE id = '$id';";
            
    if(mysqli_query($conn, $sql)){
        echo "<h3>data stored in a database successfully.";

        echo nl2br("\n$name\n $surname\n");
    } else{
        echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>

</body>
</html>