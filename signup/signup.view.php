<?php

declare(strict_types=1);

function signup_inputs(){
    

    if(isset($_SESSION["signup_data"]["customername"]) && !isset($_SESSION["error_signup"]["username_taken"])) {
        echo '<input type="text" name="customername" placeholder="Username" value ="' . $_SESSION["signup_data"] ["customername"]. ' ">
        <br>';
    } else{
        echo '<input type="text" name="customername" placeholder="Username">
        <br>';
    }


    echo '<input type="text" name="phonenum" placeholder="Phone number">
    <br>';

    if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["error_signup"]["email_registered"]) && !isset($_SESSION["error_signup"]["invalid_email"])) {
        echo '<input type="text" name="email" placeholder="Email" value ="' . $_SESSION["signup_data"] ["email"]. ' ">
        <br>';
    } else{
        echo '<input type="text" name="email" placeholder="Email">
        <br>';
    }

    echo '<input type="password" name="pwd" placeholder="Password">
    <br>';
}

function check_errors()
{
    if(isset($_SESSION['error_signup'])){
        $errors = $_SESSION['error_signup'];

        echo "<br>";

        foreach($errors as $error){

            echo '<p>' . $error . '</p>';

        }
        unset($_SESSION['error_signup']);

    }else if(isset($_GET["signup"]) && $_GET["signup"] === "success"){
        echo '<br>';
        echo '<p>Signup success!</p>';

    }
    
   
}