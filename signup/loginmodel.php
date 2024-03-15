<?php 

declare(strict_types= 1);

function get_user(object $pdo, string $customername){
    $query = "SELECT * from customer WHERE customername = :customername;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":customername", $customername);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;


}