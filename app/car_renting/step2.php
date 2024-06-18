<?php

session_start();
require_once('../db.php.inc');
// require_once('../classes/Car.php');

$pdo = db_connect();

//! if the user want a special requirement where he wants to return to a different location then you have to make another query to add the new location to the database then select this location as the return location

$sql = "SELECT car.*, location.name
FROM car
JOIN location ON car.locationId = location.id where car.id = :carId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':carId', $_SESSION["rented_car"]["id"]);
$stmt->execute();
$car = $stmt->fetch(PDO::FETCH_ASSOC);



$total = (strtotime($car["returnDate"]) - strtotime($car["pickupDate"])) / (24 * 60 * 60) * $car["pricePerDay"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Invoice</title>
</head>

<body>
    <!-- here we will display to the customer the renting invoice from the previous step where he added special requirements -->
    <article class="invoice">
        <p class="invoice__total">Total: $<?php echo $total ?></p>
        <div>
            <div class="customer-info">
                <p class="customer-id"><?php echo $_SESSION["customer"]["id"] ?></p>
                <p class="customer-name"><?php echo $_SESSION["customer"]["name"] ?></p>
                <p class="customer-address">
                    <?php echo $_SESSION['customer']['houseNo'] . ", " . $_SESSION['customer']['flatNo'] . ", " . $_SESSION['customer']['street'] . ", " . $_SESSION['customer']['city'] . ", " . $_SESSION['customer']['country'] ?>
                </p>
                <p class="customer-telephone"><?php echo $_SESSION["customer"]["telephone"] ?></p>
            </div>
            <!-- here we will display the invoice date of day when the invoice issued -->
            <div class="invoice-date">Issued: <?php echo Date("Y-m-d") ?></div>
        </div>
        <div class="rent-details">
            <?php echo $car["model"] ?><br>
            <?php echo $car["type"] ?><br>
            <?php echo $car["fuelType"] ?><br>
            <?php echo $car["name"] ?><br>
            <?php echo $car["pickupTime"] ?><br>
            <?php echo $car["pickupDate"] ?><br>
            <?php echo $car["name"] ?><br>
            <?php echo $car["returnTime"] ?><br>
            <?php echo $car["returnDate"] ?><br>
            <?php echo $car["additionalRequirements"] ?>
        </div>
    </article>
    <article class="payment-details">
        <form action="confirmation.php" method="POST">
            <h2>Enter Payment Details</h2>
            <!-- number, expiration date, holder name, and bank-issued. -->
            <label for="card_number">Card Number</label>
            <br>
            <input id="card_number" type="number" placeholder="1234 5678 9876 5432">
            <br>
            <!-- when submit the expiration date the date should be validated -->
            <label for="expiration_date">Expiration Date</label><br>
            <input id="expiration_date" type="date">
            <br>
            <label for="holder_name">Holder Name</label><br>
            <input id="holder_name" type="text">
            <br>
            <label for="bank_issued">Bank Issued</label><br>
            <input id="bank_issued" type="text">
            <br>
            <label for="card_type">Card Type</label><br>
            <input id="card_type" type="radio" name="creditCardType" value="Visa">Visa
            <input id="card_type" type="radio" name="creditCardType" value="Master Card">Master Card

            <br>
            <label for="terms_and_conditions">Terms and Conditions</label><br>
            <input id="terms_and_conditions" type="checkbox">
            <br>
            <label for="customer_name">Customer Name</label><br>
            <input id="customer_name" type="text">
            <br>
            <label for="date">Date</label><br>
            <input id="date" type="date">
            <br>
            <button type="submit">Submit</button>
        </form>
    </article>
</body>

</html>