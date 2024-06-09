<?php
require_once('../db.php.inc');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php 
    echo displayHead();
    echo "<a href='../login.php'>Login</a>";
    echo displayFooter();
    ?>
</body>

</html>