<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $customername = $_POST["customername"];
    $pwd = $_POST["pwd"];

    try{
        require_once 'dbh.php';
        require_once 'loginmodel.php';
        require_once 'logincontr.php';

        $errors = [];
        

        if(is_input_empty($customername, $pwd)){
            $errors["empty_input"] = "Fill in all fields!";

        }
        $result = get_user($pdo, $customername);

        if(is_username_wrong($result)){
            $errors["login_incorrect"] = "Incorrect login info!";

        }
        if(!is_username_wrong($result) && !is_password_wrong($pwd, $result["pwd"])){
            $errors["login_incorrect"] = "Incorrect login info!";

        }

        require_once 'config.php';

        

        if($errors){
            $_SESSION["errors_login"] = $errors;

           

            header("Location: ../signup.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_customername"] = htmlspecialchars($result["customername"]);
        
        $_SESSION["last_regeneration"] = time();
        header("Location: /home.php");
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