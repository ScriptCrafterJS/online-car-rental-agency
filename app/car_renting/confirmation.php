<?php 
/*updates the database and responds with the confirmation message.
The confirmation message should thank the customer and inform him/her that the car has been successfully rented
as well as inform the customer of the invoice ID for future reference.
 */

require_once('../db.php.inc');

//session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = $_POST['car_id'];
    $sql = "UPDATE cars SET isRented = 1 WHERE id = :car_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':car_id', $car_id);
    $stmt->execute();

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>