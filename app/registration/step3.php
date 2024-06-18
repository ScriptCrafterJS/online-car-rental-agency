<?php
session_start();
require_once('../db.php.inc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {;

    //connect to the database
    $pdo = db_connect();
    
    //insert the user info in the user table
    $sql = "INSERT INTO user (username, password, isManager) 
    VALUES (:username, :password, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $_SESSION['customer']['username']);
    $stmt->bindParam(':password', $_SESSION['customer']['password']);
    $stmt->execute();

    //retrieve the last user entry and the last payment entry for our new customer
    //fetch the last added element
    $sql = $pdo->prepare("SELECT * FROM user ORDER BY id DESC LIMIT 1");
    $sql->execute();
    $lastUser = $sql->fetch();


     //insert our new customer into the system
     $sql = "INSERT INTO customer (name, houseNo, flatNo, street, city, country, dateOfBirth,idNumber,email,telephone,userId) 
     VALUES (:name, :houseNo, :flatNo, :street, :city, :country, :dateOfBirth,:idNumber, :email, :telephone, :userId)";
     $stmt = $pdo->prepare($sql);
     $stmt->bindParam(':name', $_SESSION['customer']['name']);
     $stmt->bindParam(':houseNo', $_SESSION['customer']['houseNo']);
     $stmt->bindParam(':flatNo', $_SESSION['customer']['flatNo']);
     $stmt->bindParam(':street', $_SESSION['customer']['street']);
     $stmt->bindParam(':city', $_SESSION['customer']['city']);
     $stmt->bindParam(':country', $_SESSION['customer']['country']);
     $stmt->bindParam(':dateOfBirth', $_SESSION['customer']['dateOfBirth']);
     $stmt->bindParam(':idNumber', $_SESSION['customer']['idNumber']);
     $stmt->bindParam(':email', $_SESSION['customer']['email']);
     $stmt->bindParam(':telephone', $_SESSION['customer']['telephone']);
     $stmt->bindParam(':userId', $lastUser['id']);
     $stmt->execute();

    $sql = $pdo->prepare("SELECT * FROM customer ORDER BY id DESC LIMIT 1");
    $sql->execute();
    $lastCustomer= $sql->fetch();


      //insert the payment information in the payments table
    $sql = "INSERT INTO payment (creditCardNumber, creditCardExpiry, creditCardName, bankIssued, creditCardType, customerId) 
    VALUES (:creditCardNumber, :creditCardExpiry, :creditCardName, :bankIssued, :creditCardType,:customerId)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':creditCardNumber', $_SESSION['customer']['creditCardNumber']);
    $stmt->bindParam(':creditCardExpiry', $_SESSION['customer']['creditCardExpiry']);
    $stmt->bindParam(':creditCardName', $_SESSION['customer']['creditCardName']);
    $stmt->bindParam(':bankIssued', $_SESSION['customer']['bankIssued']);
    $stmt->bindParam(':creditCardType', $_SESSION['customer']['creditCardType']);
    $stmt->bindParam(':customerId', $lastCustomer['id']);
    $stmt->execute();

    $_SESSION['customer']['id'] = $lastCustomer['id'];

    header('Location: confirmation.php');
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
    <form method="post" action="">
        <input type="submit" name="confirm" value="Confirm">
    </form>
    <?php 
    echo displayFooter();
    ?>
</body>

</html>