<?php

declare(strict_types=1);

function get_username(object $pdo, string $customername){
    $query = "SELECT customername from customer WHERE customername = :customername;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":customername", $customername);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;

    

}
function get_email(object $pdo, string $email){
    $query = "SELECT email from customer WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;

    

}

function set_signup(object $pdo, string $customername, int $phonenum, string $email, string $pwd){
    $query = "INSERT INTO customer(customername, phonenum, email, pwd) VALUES (:customername, :phonenum, :email, :pwd);";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    
    $stmt ->bindParam(":customername", $customername);
    $stmt ->bindParam(":phonenum", $phonenum);
    $stmt ->bindParam(":email", $email);
    $stmt ->bindParam(":pwd", $hashedPwd);
    $stmt ->execute();
}