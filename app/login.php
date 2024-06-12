<?php 
require_once('./db.php.inc');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     //connect to the database
     $pdo = db_connect();

     $sql = $pdo->prepare("SELECT * FROM users WHERE password = :password AND username = :username");
     $sql->bindParam(':password', $_POST['password']);
     $sql->bindParam(':username', $_POST['username']);
     $sql->execute();
    $user = $sql->fetch();

    if($user){
        if($user['isManager']){
            //go to the manager page
            header('Location: manager.php');
            exit();
        }else{
            //go to the customer page
            header('Location: customer.php');
            exit();
        }
    }
}

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
    ?>
    <fieldset>
        <legend>Login</legend>
        <form method="POST" action="">
            <label>Username:</label><br>
            <input type="text" name="username" required minlength="6" maxlength="13"><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required minlength="8" maxlength="12"><br><br>

            <button type="submit">Login</button>
        </form>
    </fieldset>
    <?php 
    echo displayFooter();
    ?>
</body>

</html>