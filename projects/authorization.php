<?php

session_start();


if($_SERVER["REQUEST_METHOD"] === "POST"){

    $customername = $_POST['customername'];
    $servicetype = $_POST['servicetype'];
    $barbername = $_POST['barbername']; // Replace with your select name
    $adate = $_POST['adate'];
    
    try{
        require_once 'dbh.pr.php';

        $sql = "SELECT id FROM customer WHERE customername = :customername;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':customername', $customername);
        $stmt->execute();
        $userResult = $stmt->fetch(PDO::FETCH_ASSOC);
        $customerId = $userResult['id'];
 

  // Prepare and execute insert statement

  $fetchSql = "SELECT id, servicetype FROM service";
$insertSql = "INSERT INTO appointment (customer_id, service_id, barber_id, adate) VALUES (:customer_id, :servicetype , :barbername, :adate)"; // Adjust insert query

// Fetch data for select tag
$fetchStmt = $pdo->prepare($fetchSql);
$fetchStmt->execute();
$results = $fetchStmt->fetchAll(PDO::FETCH_ASSOC);

$fetchSql1 = "SELECT id, barbername FROM barber";// Adjust insert query

// Fetch data for select tag
$fetchStmt1 = $pdo->prepare($fetchSql1);
$fetchStmt1->execute();
$results1 = $fetchStmt1->fetchAll(PDO::FETCH_ASSOC);


if (!$results) {
  echo "No data found for select tag.";
  exit;
}
    $insertStmt = $pdo->prepare($insertSql);
    $insertStmt->bindParam(':customer_id', $customerId);
    $insertStmt->bindParam(':servicetype', $servicetype);
    $insertStmt->bindParam(':barbername', $barbername);
    $insertStmt->bindParam(':adate', $adate);
    $insertStmt->execute();

  

  if ($insertStmt->rowCount() > 0) {
    echo "ID inserted successfully!";
  } else {
    echo "Error inserting ID.";
  }
        

       
    

       header("Location: ./book.php?success");

      

       $pdo = null;
       $stmt = null;
       die();
    }
    catch(PDOException $e){
        die("Query failed: ". $e->getMessage());
    }

}
else{
    header("Location: ./book.php");
    die();

}