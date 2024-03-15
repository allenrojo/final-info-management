<?php

declare(strict_types=1);

function is_input_empty($customername, $phonenum, $email, $pwd){
    if(empty($customername) || empty($phonenum) || empty($email) || empty($pwd)){
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

function username_taken(object $pdo, string $customername){
    if(get_username($pdo, $customername)){

        return true;
    }
    else{
        return false;
    }
}
function email_registered(object $pdo, string $email){
    if(get_email($pdo, $email)){
        return true;
    }
    else{
        return false;
    }
}

function create_signup(object $pdo, string $customername, int $phonenum, string $email, string $pwd){
    set_signup($pdo, $customername, $phonenum, $email, $pwd);
}
