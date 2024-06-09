<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //exploiting the ability of the array to have specified indices to act as a map
    $_SESSION['customer'] = [
        'name' => $_POST['name'],
        'houseNo' => $_POST['houseNo'],
        'flatNo' => $_POST['flatNo'],
        'street' => $_POST['street'],
        'city' => $_POST['city'],
        'country' => $_POST['country'],
        'dateOfBirth' => $_POST['dateOfBirth'],
        'idNumber' => $_POST['idNumber'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone'],
        'creditCardNumber' => $_POST['creditCardNumber'],
        'creditCardExpiry' => $_POST['creditCardExpiry'],
        'creditCardName' => $_POST['creditCardName'],
        'bankIssued' => $_POST['bankIssued'],
    ];
    //redirect the user to the next step
    header('Location: step2.php');
    exit();
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
    <fieldset>
        <legend>Enter Customer Information</legend>
        <form method="POST" action="">
            <label>Name:</label><br>
            <input type="text" name="name" required><br><br>

            <label>House No:</label><br>
            <input type="text" name="houseNo" required><br><br>

            <label>Flat No:</label><br>
            <input type="text" name="flatNo" required><br><br>

            <label>Street:</label><br>
            <input type="text" name="street" required><br><br>

            <label>City:</label><br>
            <input type="text" name="city" required><br><br>

            <label>Country:</label><br>
            <input type="text" name="country" required><br><br>

            <label>Date of Birth:</label><br>
            <input type="date" name="dateOfBirth" required><br><br>

            <label>ID Number:</label><br>
            <input type="text" name="idNumber" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Telephone:</label><br>
            <input type="text" name="telephone" required><br><br>

            <label>Credit Card Number:</label><br>
            <input type="number" name="creditCardNumber" required><br><br>

            <label>Credit Card Expiration Date:</label><br>
            <input type="date" name="creditCardExpiry" required><br><br>

            <label>Credit Card Name:</label><br>
            <input type="text" name="creditCardName" required><br><br>

            <label>Credit Card Bank Issued:</label><br>
            <input type="text" name="bankIssued" required><br><br>

            <button type="submit">Next</button>
        </form>
    </fieldset>
</body>

</html>