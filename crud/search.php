
<?php
    
    session_start();
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $customername = $_POST['customername'];

        try{
            require_once 'db.php';


    
            $sql = "SELECT id FROM customer WHERE customername = :customername;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':customername', $customername);
            $stmt->execute();
            $userResult = $stmt->fetch(PDO::FETCH_ASSOC);
            $customerId = $userResult['id'];


        $isql = "SELECT appointment.id, customer.customername,  barber.barbername, service.servicetype, service.duration, service.price, appointment.adate
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="appointments">
        <h1>Your Appointments</h1>
        <form action="edit.php" method="post">
        <?php

    if(empty($results)){
    echo "No appointments have made!";
    } else{

        foreach($results as $row){
        
        echo "<button>";
        echo "<div >";
        echo "<p>"."Name: ". $row["customername"]. "</p>";
        echo "<p>"."Barber Name: ". $row["barbername"]. "</p>";
        echo "<p>"."Service: ". $row["servicetype"]. "</p>" ;
        echo "<p>"."Duration: ". $row["duration"]. " minutes". "</p>";
        echo "<p>"."Price: ". $row["price"]. " php". "</p>";
        echo "<p>"."Date of Appointment: ". $row["adate"]. " </p>";
        echo "</div>";
        echo "</button>";
        }
        

}
?>
        </form>

    

   
    </section>
    
    
</body>
</html>

