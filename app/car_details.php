<?php
require_once('./db.php.inc');
include_once('./classes/Car.php');
$pdo = db_connect();
session_start();

$car = null;
if (isset($_GET['carID'])) {
    $carId = $_GET['carID'];
    
    $sql = "SELECT * FROM car WHERE id = :carId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':carId', $carId);
    $stmt->execute();
    
    $car = $stmt->fetch(PDO::FETCH_ASSOC);  
    $_SESSION['rented_car'] = ['id' => $car['id']];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Location: car_renting/step1.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
</head>

<body>
    <article>
        <?php if ($car): ?>
        <fieldset>
            <legend>Car Details</legend>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                <div>
                    <img src="../images/<?php echo $car['photoName'] ?>" alt="<?php echo $car['photoName'] ?>"
                        width="300">
                    <?php echo $car['description']; ?>
                </div>
                <div>
                    <ul>
                        <!-- if the car is null in the above php code then the details wont appears -->
                        <li>Car Reference Number: <?php echo $car['id']; ?></li>
                        <li>Car Model: <?php echo $car['model']; ?></li>
                        <li>Car Type: <?php echo $car['type']; ?></li>
                        <li>Car Make: <?php echo $car['make']; ?></li>
                        <li>Registration Year: <?php echo $car['registrationYear']; ?></li>
                        <li>Color: <?php echo $car['color']; ?></li>
                        <li>Price Per Day: <?php echo $car['pricePerDay']; ?></li>
                        <li>People Capacity: <?php echo $car['peopleCapacity']; ?></li>
                        <li>Suitcases Capacity: <?php echo $car['suitcasesCapacity']; ?></li>
                    </ul>
                </div>
                <button type="submit">Rent</button>
            </form>
        </fieldset>
        <?php endif; ?>
    </article>
</body>

</html>