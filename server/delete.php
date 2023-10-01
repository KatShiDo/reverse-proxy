<html lang="en">
<head>
<title>Update</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<form action="delete.php" method="post">
    <p>
        <label for="id">ID:</label>
        <input type="text" name="id" id="id">
    </p>

    <input type="submit" value="Submit">
</form>

<a href="/index.php">RETURN</a>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn = new mysqli('db', 'user', 'password', 'appDB');

    $id = $_REQUEST['id'];

    $sql = "DELETE FROM users WHERE id = '$id';";
            
    if(mysqli_query($conn, $sql)){
        echo "<h3>data deleted successfully.";
    } else{
        echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>

</body>
</html>