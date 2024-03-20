<?php
session_start();

if($_SESSION['upr']!='admin'){
    header('Location: ./index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
</head>
<body>
    <h1>ADMIN</h1>
    <?php
    include 'menu.php'
    ?>
</body>
</html>