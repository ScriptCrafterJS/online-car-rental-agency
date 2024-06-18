<?php 
require_once('../db.php.inc');
$pdo = db_connect();

session_start();
//! let this step where the user want to add special requirements to his/her car
//! also store the car id and the special requirements in a session OR add those special requirements to the car in the database and pass the id of the car to the session until the end of the renting process

//if the user is logged in to the system then he can rent the car
// if(isset($_SESSION["customer"])){
    //now lets bring the car form the database
    $sql = "SELECT * FROM car WHERE id = :carId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':carId', $_SESSION["rented_car"]["id"]);
    $stmt->execute();
    
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

// }else{
//otherwise the customer will be directed to the login page

// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renting Process 1</title>
</head>

<body>
    <h1>Renting Process Step 1</h1>
    <form action="step2.php" method="POST">
        <label for="car_id">Car Reference Number:</label>
        <input type="text" id="car_id" name="car_id" value="<?php echo $car['id']; ?>" disabled>
        <br>
        <label for="car_model">Car Model:</label>
        <input type="text" id="car_model" name="car_model" value="<?php echo $car['model']; ?>" disabled>
        <br>
        <label for="car_description">Car Description:</label>
        <textarea id="car_description" name="car_description" cols="50" rows="10"
            disabled><?php echo $car['description']; ?></textarea>
        <br>
        <br>
        <label for="car_type">Car Type:</label>
        <input type="text" id="car_type" name="car_type" value="<?php echo $car['type']; ?>" disabled>
        <br>
        <label for="car_make">Car Make:</label>
        <input type="text" id="car_make" name="car_make" value="<?php echo $car['make']; ?>" disabled>
        <br>
        <label for="car_registration_year">Registration Year:</label>
        <input type="text" id="car_registration_year" name="car_registration_year"
            value="<?php echo $car['registrationYear']; ?>" disabled>
        <br>
        <label for="car_color">Color:</label>
        <input type="text" id="car_color" name="car_color" value="<?php echo $car['color']; ?>" disabled>
        <br>
        <label for="car_price_per_day">Price Per Day:</label>
        <input type="text" id="car_price_per_day" name="car_price_per_day" value="<?php echo $car['pricePerDay']; ?>"
            disabled>
        <br>
        <label for="car_people_capacity">People Capacity:</label>
        <input type="text" id="car_people_capacity" name="car_people_capacity"
            value="<?php echo $car['peopleCapacity']; ?>" disabled>
        <br>
        <label for="car_suitcases_capacity">Suitcases Capacity:</label>
        <input type="text" id="car_suitcases_capacity" name="car_suitcases_capacity"
            value="<?php echo $car['suitcasesCapacity']; ?>" disabled>
        <br>
        <button type="submit">Next</button>
    </form>
</body>

</html>