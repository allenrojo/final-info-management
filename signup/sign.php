<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $customername = $_POST["customername"];
    $phonenum = $_POST["phonenum"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
   

    try{
        require_once 'dbh.php';
        require_once 'signup.model.php';
        require_once 'signup.contr.php';
        

        $errors = [];
        

        if(is_input_empty($customername, $phonenum, $email, $pwd)){
            $errors["empty_input"] = "Fill in all fields!";

        }
        if(email_invalid($email)){
        $errors["invalid_email"] = "Invalid email!";

        }
        if(username_taken($pdo, $customername)){
            $errors["username_taken"] = "Username is taken!";
    
        }
        if(email_registered( $pdo,  $email)){
            $errors["email_registered"] = "Email is taken!";

        }
        require_once 'config.php';

        if($errors){
            $_SESSION["error_signup"] = $errors;

            $signupData = [

                "customername" => $customername,
                "phonenum"=> $phonenum,
                "email"=> $email

            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../signup.php");
            die();
        }
       create_signup($pdo, $customername, $phonenum, $email, $pwd);

       header("Location: ../signup.php?signup=success");

       $pdo = null;
       $stmt = null;
       die();
    }
    catch(PDOException $e){
        die("Query failed: ". $e->getMessage());
    }

}
else{
    header("Location: ../signup.php");
    die();

}