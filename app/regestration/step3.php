<?php
session_start();
require_once('../db.php.inc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['customer']['username'];
    $password = $_SESSION['customer']['password'];

    //connect to the database
    $pdo = db_connect();
    
    //insert the user info in the user table
    $sql = "INSERT INTO users (username, password, isManager) 
    VALUES (:username, :password, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();


    $creditCardNumber = $_SESSION['customer']['creditCardNumber'];
    $creditCardExpiry = $_SESSION['customer']['creditCardExpiry'];
    $creditCardName = $_SESSION['customer']['creditCardName'];
    $bankIssued = $_SESSION['customer']['bankIssued'];

    //insert the payment information in the payments table
    $sql = "INSERT INTO payments (creditCardNumber, creditCardExpiry, creditCardName, bankIssued) 
    VALUES (:creditCardNumber, :creditCardExpiry, :creditCardName, :bankIssued)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':creditCardNumber', $creditCardNumber);
    $stmt->bindParam(':creditCardExpiry', $creditCardExpiry);
    $stmt->bindParam(':creditCardName', $creditCardName);
    $stmt->bindParam(':bankIssued', $bankIssued);
    $stmt->execute();


    //retrieve the last user entry and the last payment entry for our new customer
    //fetch the last added element
    $sql = $pdo->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 1");
    $sql->execute();
    $lastUser = $sql->fetchObject('User');

    $sql = $pdo->prepare("SELECT * FROM payments ORDER BY id DESC LIMIT 1");
    $sql->execute();
    $lastPayment= $sql->fetchObject('User');


    //insert our new customer into the system
    $sql = "INSERT INTO users (username, password, isManager) 
    VALUES (:username, :password, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    echo "Thank You! <br> Your Customer ID is: $customerID <br>";
    echo "<a href='../login.php'>Login</a>";
    exit();


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Page</title>
</head>

<body>
    <?php 
        echo displayHead();
    ?>
    <h1>Confirmation Page</h1>
    <?php
    // Display entered information
    if (isset($_SESSION['customer'])) {
        $customer = $_SESSION['customer'];
        
        echo "<p>Name: {$customer['name']}</p>";
        echo "<p>Address: {$customer['houseNo']}, {$customer['flatNo']}, {$customer['street']}, {$customer['city']}, {$customer['country']}</p>";
        echo "<p>Date of Birth: {$customer['dateOfBirth']}</p>";
        echo "<p>ID Number: {$customer['idNumber']}</p>";
        echo "<p>Email: {$customer['email']}</p>";
        echo "<p>Telephone: {$customer['telephone']}</p>";
    }
    ?>
    <form method="post">
        <input type="submit" name="confirm" value="Confirm">
    </form>
</body>

</html>