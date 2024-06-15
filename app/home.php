<?php
require_once('./db.php.inc');
include_once('./classes/Car.php');

$pdo = db_connect();

function filterCars($pdo,$rentStartDate, $rentEndDate, $carType, $pickupLocation, $minPricePerDay, $maxPricePerDay) {

    $sql = "SELECT cars.* 
            FROM cars
            JOIN rentals ON cars.id = rentals.carID
            JOIN locations ON rentals.locationID = locations.id
            WHERE 1=1";

    if (!empty($rentStartDate)) {
        $sql .= " AND rentals.rentStartDate >= '$rentStartDate'";
    }

    if (!empty($rentEndDate)) {
        $sql .= " AND rentals.rentEndDate <= '$rentEndDate'";
    }

    if (!empty($carType)) {
        $sql .= " AND cars.type = '$carType'";
    }

    if (!empty($pickupLocation)) {
        $sql .= " AND locations.pickupName = '$pickupLocation'";
    }

    if (!empty($minPricePerDay)) {
        $sql .= " AND cars.pricePerDay >= $minPricePerDay";
    }

    if (!empty($maxPricePerDay)) {
        $sql .= " AND cars.pricePerDay <= $maxPricePerDay";
    }
    
    return $pdo->query($sql);
     
}
//define my default values to incorporate them if the user is not using the filter form
$rentStartDate = date('Y-m-d');
$rentEndDate = date('Y-m-d', strtotime('+3 days'));
$carType = 'sedan';
$pickupLocation = 'Birzeit';
$minPricePerDay = 200;
$maxPricePerDay = 1000;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rentStartDate = !empty($_POST['rent_start_date']) ? $_POST['rent_start_date'] : $rentStartDate;
    $rentEndDate = !empty($_POST['rent_end_date']) ? $_POST['rent_end_date'] : $rentEndDate;
    $carType = !empty($_POST['car_type']) ? $_POST['car_type'] : $carType;
    $pickupLocation = !empty($_POST['pickup_location']) ? $_POST['pickup_location'] : $pickupLocation;
    $minPricePerDay = !empty($_POST['min_price_per_day']) ? $_POST['min_price_per_day'] : $minPricePerDay;
    $maxPricePerDay = !empty($_POST['max_price_per_day']) ? $_POST['max_price_per_day'] : $maxPricePerDay;
    
    //if the user decide to use the filter form then values used in the filter will overwrite the default values
    $cars = filterCars($pdo,$rentStartDate, $rentEndDate, $carType, $pickupLocation, $minPricePerDay, $maxPricePerDay);

    /*//! this line will be for making cookies to save the customer filtering preferences
    $filteringOptions = array(
        'rent_start_date' => $_POST['rent_start_date'],
        'rent_end_date' => $_POST['rent_end_date'],
        'car_type' => $_POST['car_type'],
        'pickup_location' => $_POST['pickup_location'],
        'min_price_per_day' => $_POST['min_price_per_day'],
        'max_price_per_day' => $_POST['max_price_per_day']
    );
    
    setcookie('filtering_options', json_encode($filteringOptions), time() + (86400 * 30), '/');
    */
}

//this will be performed for the default values
$cars = filterCars($pdo,$rentStartDate, $rentEndDate, $carType, $pickupLocation, $minPricePerDay, $maxPricePerDay);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <main>
        <?php echo displayHead(); ?>
        <article>
            <fieldset>
                <legend>Advanced Car Search</legend>
                <form method="POST" action="home.php">
                    <label for="rent_start_date">Rent Start Date</label>
                    <input type="date" id="rent_start_date" name="rent_start_date"><br>
                    <label for="rent_start_date">Rent End Date</label>
                    <input type="date" id="rent_end_date" name="rent_end_date"><br>

                    <label for="car_type">Car Type</label>
                    <select name="car_type" id="car_type">
                        <option value="" disabled selected>Select Type</option>
                        <option value="Van">Van</option>
                        <option value="Min-Van">Min-Van</option>
                        <option value="state">state</option>
                        <option value="sedan">sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="sport">sport</option>
                    </select><br>
                    <label for="pickup_location">Pickup Location:</label>
                    <input type="text" id="pickup_location" name="pickup_location" placeholder="Birzeit"><br>


                    <label for="min_price_per_day">Min Price Per Day</label>
                    <input type="number" id="min_price_per_day" name="min_price_per_day" placeholder="200"><br>
                    <label for="max_price_per_day">Max Price Per Day</label>
                    <input type="number" id="max_price_per_day" name="max_price_per_day" placeholder="1000"><br>


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
                        while($car = $cars->fetchObject('Car')){
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