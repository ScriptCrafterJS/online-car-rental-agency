<?php 
require_once('../db.php.inc');
$pdo = db_connect();

session_start();

//if the user is logged in to the system then he can rent the car
// if(isset($_SESSION["customer"])){
    //now lets bring the car form the database
    $sql = "SELECT * FROM cars WHERE id = :carId";
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
</body>

</html>