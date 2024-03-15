<?php

session_start();
    
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $id = $_POST['id'];

    try{
        require_once 'db.php';

        $sql = "SELECT * FROM appointment WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $userResult = $stmt->fetch(PDO::FETCH_ASSOC);
        $customerId = $userResult['id'];


    $isql = "SELECT customer.customername,  barber.barbername, service.servicetype, service.duration, service.price, appointment.adate
             FROM customer
             INNER JOIN appointment ON customer.id = appointment.customer_id
             INNER JOIN barber  ON appointment.barber_id = barber.id
             INNER JOIN service  ON appointment.service_id = service.id
             WHERE customer.id = $customerId;";
    $istmt = $pdo->prepare($isql);
    $istmt -> execute();
    $results = $istmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $istmt = null;

      
    }
    catch(PDOException $e){
        die("Query failed: ". $e->getMessage());
    }
}
else{

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