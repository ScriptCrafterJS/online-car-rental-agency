<?php
session_start();

$notMatch = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    //validate the password by confirming it another time
    
    if ($password !== $confirmPassword) {
        $notMatch = true;
    }

    if (!$notMatch) {
        //here we add two features to our map (the customer) =>  his/her username and password
        $_SESSION['customer']['username'] = $_POST['username'];
        $_SESSION['customer']['password'] = $password;

        header('Location: step3.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
</head>

<body>
    <h2>Customer Registration</h2>
    <?php
    if ($notMatch) {
        echo '<p style="color: red">Passwords are not match</p>';
    }
    ?>
    <fieldset>
        <legend>Create an E-account</legend>
        <form method="POST" action="">
            <label>Username:</label><br>
            <input type="text" name="username" required minlength="6" maxlength="13"><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required minlength="8" maxlength="12"><br><br>

            <label>Confirm Password:</label><br>
            <input type="password" name="confirmPassword" required minlength="8" maxlength="12"><br><br>

            <button type="submit">Next</button>
        </form>
    </fieldset>
</body>

</html>