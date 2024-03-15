<?php

declare(strict_types=1);

function createAppointment(object $pdo, string $customername, string $adate) {
    try {
      // Fetch user ID
      $sql = "SELECT id FROM customer WHERE customername = :customername;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':customername', $customername);
      $stmt->execute();
      $userResult = $stmt->fetch(PDO::FETCH_ASSOC);
      $customerId = $userResult['id'];
  
      // Fetch service ID
      // $sql = "SELECT id FROM service WHERE id = :servicetype";
      // $stmt = $pdo->prepare($sql);
      // $stmt->bindParam(':servicetype', $servicetype);
      // $stmt->execute();
      // $serviceResult = $stmt->fetch(PDO::FETCH_ASSOC);
  
      // $serviceId = $serviceResult['id'];
  
      // // Fetch barber ID
      // $sql = "SELECT id FROM barber WHERE id = :barbername";
      // $stmt = $pdo->prepare($sql);
      // $stmt->bindParam(':barbername', $barbername);
      // $stmt->execute();
      // $barberResult = $stmt->fetch(PDO::FETCH_ASSOC);
  
      // $barberId = $barberResult['id'];
  
      // Insert appointment
      $sql = "INSERT INTO appointment(customer_id, adate) VALUES (:customer_id, :adate);";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':customer_id', $customerId);
      // $stmt->bindParam(':barber_id', $barberId);
      // $stmt->bindParam(':service_id', $serviceId);
      $stmt->bindParam(':adate', $adate);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $stmt->execute();
  
      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        throw new Exception("Failed to create appointment.");
      }
    } catch(Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }