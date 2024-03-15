<?php
session_start();
include('dbh.pr.php');
$host = 'localhost';
$dbname = 'appointmentsystem';
$dbusername = 'root';
$dbpassword = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
  die("Connection failed". $e->getMessage());
}

$fetchSql = "SELECT id, servicetype FROM service";
$insertSql = "INSERT INTO appointment (customer_id, service_id, barber_id, adate) VALUES (:customer_id, :servicetype , :barbername, :adate)"; // Adjust insert query

// Fetch data for select tag
$fetchStmt = $pdo->prepare($fetchSql);
$fetchStmt->execute();
$results = $fetchStmt->fetchAll(PDO::FETCH_ASSOC);

$fetchSql1 = "SELECT id, barbername FROM barber";// Adjust insert query

// Fetch data for select tag
$fetchStmt1 = $pdo->prepare($fetchSql1);
$fetchStmt1->execute();
$results1 = $fetchStmt1->fetchAll(PDO::FETCH_ASSOC);

if (!$results) {
  echo "No data found for select tag.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="book.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <script>

    $(document).ready(function() {
    $("#submit").click(function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get selected values
    var customerName = $("#customername").val();
    var barberName = $("#barbername option:selected").text();
    var serviceType = $("#servicetype option:selected").text();
    var appointmentDate = $("#adate").val();

    if (barberName === "Select Barbers" ||serviceType == "Select service" || appointmentDate === ""  ) {
            alert("Fields required");
            return; // Stop further execution if no barber is selected
        }
    // Create confirmation tab content
    var confirmationText = "<h2>Your Appointment</h2><p>Customer Name: " + customerName + "</p><p>Barber Name: " + barberName + "</p><p>Service Type: " + serviceType + "</p><p>Appointment Date: " + appointmentDate + "</p>";

    // Display confirmation tab
    $("#confirmationTab").html(confirmationText);
    $("#confirmationTab").show(); // Show the confirmation tab
    $("#confirmationTab").append("<button type='button' id='confirmSubmitBtn'>Confirm</button>");


    // Handle confirm button click
    $("#confirmSubmitBtn").click(function() {
      // Submit the form using AJAX
      $.ajax({
        url: "authorization.php", // Replace with your submit script
        type: "POST",
        data: {
          customername: customerName,
          barbername: barberName,
          servicetype: serviceType,
          adate: appointmentDate
        },
        success: function(response) {
          // Handle successful submission (e.g., display success message)
          console.log(response); // For debugging purposes
          // Reset the form
          $("#appointmentForm")[0].reset();
          $("#confirmationTab").hide(); // Hide the confirmation tab

        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Handle errors during submission
          console.error(textStatus, errorThrown); // For debugging purposes
        }
      });
    });
  });
});
  </script>
</head>
<body>
  <div class="container-header">
      <h1>Book an appointment</h1>
      <a href="../home.php">Return to home</a>
    </div>
  <div class="container-main">
    
  
    <form action="authorization.php" method="post" id="appointmentForm"> 
      <input type="hidden" name="customername" value="<?php echo $_SESSION["user_customername"];?>" id="customername">  

    <div class="container">
      <label class="title" for="service">Choose type of service.</label>
      <div class="dropdown-service">
        <select name="servicetype" id="servicetype">
        <option value="select" disabled selected value>Select Services</option>
        <?php foreach ($results as $row) : ?>
                <option value="<?php echo $row['id'];?>"><?php echo $row['servicetype']; ?></option>              
                <?php endforeach; ?>  
        </select>
      </div>
    </div>
    <div class="container">    
        <label class="title" for="barber">Choose barber.</label>
        <select name="barbername" id="barbername">
        <option value="select" disabled selected value>Select Barbers</option>
        <?php foreach ($results1 as $row1) : ?>
                <option value="<?php echo $row1['id']; ?>"><?php echo $row1['barbername']; ?></option>
                <?php endforeach; ?>

        </select>
    </div>
    <div class=container>
      <label class="title">Choose date.</label>
      <input class="date" type="date" name="adate" placeholder="Choose date" id="adate">
    </div> 
    <button id="submit">Book</button>    
   
    <div id="confirmationTab" style="display: none;"> </div>
    </form>

  </div>
</body>
</html>
