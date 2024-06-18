<?php
require_once('./db.php.inc');
include_once('./classes/Car.php');

$pdo = db_connect();

function filterCars($pdo, $rentStartDate, $rentEndDate, $carType, $pickupLocation, $minPricePerDay, $maxPricePerDay)
{

    $sql = "SELECT car.* 
            FROM car
            JOIN location ON car.locationId = location.id
            WHERE 1=1";

    if (!empty($rentStartDate)) {
        $sql .= " AND car.pickupDate >= '$rentStartDate'";
    }

    if (!empty($rentEndDate)) {
        $sql .= " AND car.returnDate <= '$rentEndDate'";
    }

    if (!empty($carType)) {
        $sql .= " AND car.type = '$carType'";
    }

    if (!empty($pickupLocation)) {
        $sql .= " AND location.name = '$pickupLocation'";
    }

    if (!empty($minPricePerDay)) {
        $sql .= " AND car.pricePerDay >= $minPricePerDay";
    }

    if (!empty($maxPricePerDay)) {
        $sql .= " AND car.pricePerDay <= $maxPricePerDay";
    }

    return $pdo->query($sql);
}
//define my default values to incorporate them if the user is not using the filter form
$rentStartDate = "";
$rentEndDate = "";
$carType = 'sedan';
$pickupLocation = "";
$minPricePerDay = "";
$maxPricePerDay = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rentStartDate = !empty($_POST['pickupDate']) ? $_POST['pickupDate'] : $rentStartDate;
    $rentEndDate = !empty($_POST['returnDate']) ? $_POST['returnDate'] : $rentEndDate;
    $carType = !empty($_POST['car_type']) ? $_POST['car_type'] : $carType;
    $pickupLocation = !empty($_POST['pickupLocation']) ? $_POST['pickupLocation'] : $pickupLocation;
    $minPricePerDay = !empty($_POST['min_price_per_day']) ? $_POST['min_price_per_day'] : $minPricePerDay;
    $maxPricePerDay = !empty($_POST['max_price_per_day']) ? $_POST['max_price_per_day'] : $maxPricePerDay;

    //if the user decide to use the filter form then values used in the filter will overwrite the default values
    $cars = filterCars($pdo, $rentStartDate, $rentEndDate, $carType, $pickupLocation, $minPricePerDay, $maxPricePerDay);


    $customerFilteringOptions = array(
        'pickupDate' => $_POST['pickupDate'],
        'returnDate' => $_POST['returnDate'],
        'car_type' => $_POST['car_type'],
        'pickupLocation' => $_POST['pickupLocation'],
        'min_price_per_day' => $_POST['min_price_per_day'],
        'max_price_per_day' => $_POST['max_price_per_day']
    );

    setcookie('filtering_options', json_encode($customerFilteringOptions), time() + (86400 * 30), '/');
}

//this will be performed for the default values
$cars = filterCars($pdo, $rentStartDate, $rentEndDate, $carType, $pickupLocation, $minPricePerDay, $maxPricePerDay);

//retrieve the cookie we made
if (isset($_COOKIE['customerFilteringOptions'])) {
    $customerFilteringOptions = json_decode($_COOKIE['customerFilteringOptions'], true);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - Car Search</title>
</head>

<body>
    <main>
        <?php echo displayHead(); ?>
        <article>
            <fieldset>
                <legend>Advanced Car Search</legend>
                <form method="POST" action="home.php">
                    <label for="pickupDate">Rent Start Date</label>
                    <input type="date" id="pickupDate" name="pickupDate" value="<?php echo !empty($customerFilteringOptions['pickupDate']) ? $customerFilteringOptions['pickupDate'] : ""  ?>"><br>
                    <label for="pickupDate">Rent End Date</label>
                    <input type="date" id="returnDate" name="returnDate" value="<?php echo !empty($customerFilteringOptions['returnDate']) ? $customerFilteringOptions['returnDate'] : ""  ?>"><br>

                    <label for="car_type">Car Type</label>
                    <select name="car_type" id="car_type">
                        <option value="<?php echo !empty($customerFilteringOptions['car_type']) ? $customerFilteringOptions['car_type'] : ""  ?>" disabled selected>Select Type</option>
                        <option value="Van">Van</option>
                        <option value="Min-Van">Min-Van</option>
                        <option value="state">state</option>
                        <option value="sedan">sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="sport">sport</option>
                    </select><br>
                    <label for="pickupLocation">Pickup Location:</label>
                    <input type="text" id="pickupLocation" name="pickupLocation" placeholder="Birzeit" value="<?php echo !empty($customerFilteringOptions['pickupLocation']) ? $customerFilteringOptions['pickupLocation'] : ""  ?>"><br>
                    <label for="min_price_per_day">Min Price Per Day</label>
                    <input type="number" id="min_price_per_day" name="min_price_per_day" placeholder="200" value="<?php echo !empty($customerFilteringOptions['min_price_per_day']) ? $customerFilteringOptions['min_price_per_day'] : ""  ?>"><br>
                    <label for="max_price_per_day">Max Price Per Day</label>
                    <input type="number" id="max_price_per_day" name="max_price_per_day" placeholder="1000" value="<?php echo !empty($customerFilteringOptions['max_price_per_day']) ? $customerFilteringOptions['max_price_per_day'] : ""  ?>"><br>


                    <button type="submit">Filter</button>
                </form>
                <br>
                <table border="1">
                    <caption>Cars Table Result</caption>
                    <thead>
                        <tr>
                            <th><button><a href="home.php">Shorten</a></button></th>
                            <th>Price Per Day</th>
                            <th>Car Type</th>
                            <th>Fuel Type</th>
                            <th>Car photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($cars) {
                            while ($car = $cars->fetchObject('Car')) {
                                echo $car->displayInTable();
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </fieldset>
        </article>
        <?php echo displayFooter(); ?>
    </main>
</body>