<?php

declare(strict_types=1);

function set_appointment(object $pdo, string $fullname, string $email, int $contactnum, string $aservice, string $barber, string $adate, string $atime, string $amessage){
    $query = "INSERT INTO services (fullname, email, contactnum, aservice, barber, adate, atime, amessage) VALUES (:fullname, :email, :contactnum, :aservice, :barber, :adate, :atime, :amessage);";
    $stmt = $pdo->prepare($query);
    $stmt ->bindParam(":fullname", $fullname);
    $stmt ->bindParam(":email", $email);
    $stmt ->bindParam(":contactnum", $contactnum);
    $stmt ->bindParam(":aservice", $aservice);
    $stmt ->bindParam(":barber", $barber);
    $stmt ->bindParam(":adate", $adate);
    $stmt ->bindParam(":atime", $atime);
    $stmt ->bindParam(":amessage", $amessage);
    $stmt ->execute();
}