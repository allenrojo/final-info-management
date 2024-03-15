<?php

declare(strict_types=1);

function check_errors()
{
    if(isset($_SESSION['errors_barbershop'])){
        $errors = $_SESSION['errors_barbershop'];

        echo "<br>";

        foreach($errors as $error){

            echo '<p>' . $error . '</p>';

        }
        unset($_SESSION['errors_barbershop']);

    }
   
}