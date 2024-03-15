<?php

require_once 'signup/config.php';
require_once 'signup/loginview.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="home.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>

<body>
<div class="container-body">
  <div class="container-header">
    <h3 class="welcome">
      <?php echo "Welcome, " . $_SESSION["user_customername"]; ?> 
      <br>
      <a class="appointment" href="projects/book.php">  Book an appointment today!</a> 
    </h3>
    <form action='signup/logout.s.php' method='post'>
    
    <button type='submit'>Logout</button>
  </form>
  </div> 
  <div class=container-hero>
      <p class="hero-title">Get the freshest cut.</p>
      <p class="hero-desc">We offer a variety of services by our experienced barbers.</p>
      <a class="appointment-button" href="projects/book.php">Appointment</a>
    </div> 
  <div class="container-services">
    <section id="services">
      <h2 class="title">Our Services <hr> </h2>
      <div class="icon-services">
        <div class="wrapper">
          <img class="icons" src="img/icons8-scissor-64.png"> 
          <p class="icon-description">Haircut - Classic</p>
          </div>
        <div class="wrapper">
          <img class="icons" src="img/icons8-scissor-64.png"> 
          <p class="icon-description">Haircut - Fade</p>
        </div>
        <div class="wrapper">
          <img class="icons" src="img/icons8-scissor-64.png"> 
          <p class="icon-description">Beard Trim</p>
        </div>  
        <div class="wrapper">
          <img class="icons" src="img/icons8-scissor-64.png"> 
          <p class="icon-description">Haircut & Shave</p>
        </div>      
      </div>
    </section>
  </div>
  <div class="container-about">
    <section id="about-us">
      <h2 class="title">About Us <hr> </h2>
      <p class="icon-description">
        We are a team of passionate barbers dedicated to providing high-quality haircuts and a relaxing experience.
        We use top-of-the-line products and stay up-to-date on the latest styles.
      </p>
    </section>
  </div>
  <div class="container-contact">
    <section id="contact">
      <h2 class="title">Contact Us <hr> </h2>
      <p class="icon-description">
        Phone: (052) 948-1100<br>
        Email: appointments@barbershop.com<br>
        Address: 955 Parada St., Mandaluyong City
      </p>
    </section>
  </div>
 

  

</div>
</body>


</html>