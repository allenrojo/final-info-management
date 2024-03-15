<?php

declare(strict_types=1);

function is_input_empty($fullname, $email, $contactnum, $aservice, $barber, $adate, $atime, $amessage){
    if(empty($fullname) || empty($email) || empty($contactnum) || empty($aservice)  || empty($barber) || empty($adate) || empty($atime) || empty($amessage)){
        return true;
    }
    else{
        return false;
    }
}

function email_invalid($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}

function create_appointment(object $pdo, string $fullname, string $email, int $contactnum, string $aservice, string $barber, string $adate, string $atime, string $amessage){
    set_appointment($pdo, $fullname, $email, $contactnum, $aservice, $barber, $adate, $atime, $amessage);
}
