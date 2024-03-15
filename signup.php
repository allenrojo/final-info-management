<?php
require_once 'signup/config.php';
require_once 'signup/signup.view.php';
require_once 'signup/loginview.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In or Signup</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="container-create">
            <h1>Create Account</h1>
            <form action="signup/sign.php" method="post" class=signup>
            <?php
            signup_inputs();
            ?>
            <button>Submit</button>

            </form>
            <?php
            check_errors();

            ?>
            <h3>
                <?php
                output_username();
                ?>
            </h3>
        
        
        <?php
        if (!isset($_SESSION["user_id"])) { ?>
            <h3>LOGIN FORM</h3>
            <form action="signup/login.s.php" method="post">
                <input type="text" name="customername" placeholder="Enter Username">
                <br>
                <input type="password" name="pwd" placeholder="Enter password">
                <br>
                <button>Login</button>

            </form>

        <?php } ?>




        <?php
        check_login_errors();

        ?>

        
        
    </div>



</body>

</html>