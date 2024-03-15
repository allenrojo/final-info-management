<?php

declare(strict_types=1);

function create_appointment(object $pdo, string $customername, string $adate){
    createAppointment($pdo, $customername, $adate);
}