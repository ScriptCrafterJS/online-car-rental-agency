<?php
require_once('./db.php.inc');
include_once('./classes/Car.php');

$pdo = db_connect();

function filterCars($pdo, $rentStartDate, $rentEndDate, $returnCertainDate, $pickupLocation, $status)
{

    $sql = "SELECT car.* 
            FROM car
            JOIN location ON car.locationId = location.id
            WHERE 1=1";

    //cause if the manager decided to see cars on a certain day the start wont matter cause he want to see ALL cars on that day
    if (!empty($returnCertainDate)) {
        $sql .= " AND car.returnDate = '$returnCertainDate'";
    } else {
        if (!empty($rentStartDate)) {
            $sql .= " AND car.pickupDate >= '$rentStartDate'";
        }
    }

    if (!empty($rentEndDate)) {
        $sql .= " AND car.returnDate <= '$rentEndDate'";
    }

    if (!empty($status)) {
        $sql .= " AND car.status = '$status'";
    }

    if (!empty($pickupLocation)) {
        $sql .= " AND location.name = '$pickupLocation'";
    }


    return $pdo->query($sql);
}
//default values: display all available cars for a week from the current date.
$rentStartDate = date('Y-m-d');
$rentEndDate = date('Y-m-d', strtotime('+7 days'));
$returnCertainDate = "";
$pickupLocation = "";
$status = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $rentStartDate = !empty($_POST['pickupDate']) ? $_POST['pickupDate'] : $rentStartDate;
    $rentEndDate = !empty($_POST['returnDate']) ? $_POST['returnDate'] : $rentEndDate;

    $pickupLocation = !empty($_POST['pickupLocation']) ? $_POST['pickupLocation'] : $pickupLocation;
    $returnCertainDate = !empty($_POST['returnCertainDate']) ? $_POST['returnCertainDate'] : $returnCertainDate;
    $status = !empty($_POST['status']) ? $_POST['status'] : $status;

    //if the user decide to use the filter form then values used in the filter will overwrite the default values
    $cars = filterCars($pdo, $rentStartDate, $rentEndDate, $returnCertainDate, $pickupLocation, $status);


    $filteringOptions = array(
        'pickupDate' => $_POST['pickupDate'],
        'returnDate' => $_POST['returnDate'],
        'pickupLocation' => $_POST['pickupLocation'],
        'returnCertainDate' => $_POST['returnCertainDate'],
        'status' => $_POST['status'],
    );
    //if the cookie last for 1day = 86400 then 86400 * 15 will last for 15 days
    setcookie('filteringOptions', json_encode($filteringOptions), time() + (86400 * 1), '/');
}

//this will be performed for the default values
$cars = filterCars($pdo, $rentStartDate, $rentEndDate, $returnCertainDate, $pickupLocation, $status);

//retrieve the cookie we made
if (isset($_COOKIE['filteringOptions'])) {
    $filteringOptions = json_decode($_COOKIE['filteringOptions'], true);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager - Car Inquire</title>
</head>

<body>
    <main>
        <?php echo displayHead(); ?>
        <article>
            <fieldset>
                <legend>Advanced Car Search</legend>
                <form method="POST" action="car_inquire.php">

                    <label for="pickupDate">Rent Start Date</label>
                    <!-- now to use the cookie that we saved the option in it to bring it back into our inputs -->
                    <input type="date" id="pickupDate" name="pickupDate" value="<?php echo !empty($filteringOptions['pickupDate']) ? $filteringOptions['pickupDate'] : ""  ?>"><br>

                    <label for="returnDate">Rent End Date</label>
                    <input type="date" id="returnDate" name="returnDate" value="<?php echo !empty($filteringOptions['returnDate']) ? $filteringOptions['returnDate'] : ""  ?>"><br>

                    <label for="pickupLocation">Pickup Location:</label>
                    <input type="text" id="pickupLocation" name="pickupLocation" placeholder="Birzeit" value="<?php echo !empty($filteringOptions['pickupLocation']) ? $filteringOptions['pickupLocation'] : ""  ?>"><br>

                    <label for="returnCertainDate">All Cars Returned On Certain Day</label>
                    <input type="date" id="returnCertainDate" name="returnCertainDate" value="<?php echo !empty($filteringOptions['returnCertainDate']) ? $filteringOptions['returnCertainDate'] : ""  ?>"><br>

                    <label for="status">Search Based on Car Status</label>
                    <select name="status" id="status">
                        <option value="<?php echo !empty($filteringOptions['status']) ? $filteringOptions['status'] : ""  ?>" disabled selected>Select Status</option>
                        <option value="repair">repair</option>
                        <option value="damaged">damaged</option>
                    </select><br>

                    <button type="submit">Filter</button>
                </form>
                <br>
                <table border="1">
                    <caption>Cars Table Result</caption>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Car Type</th>
                            <th>Model</th>
                            <th>Description</th>
                            <th>Car Photo</th>
                            <th>Fuel Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($cars) {
                            while ($car = $cars->fetchObject('Car')) {
                                echo $car->managerDisplayInTable();
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