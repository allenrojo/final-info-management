<?php

require_once('dbh.pr.php'); // Include your database credentials

$host = 'localhost';
$dbname = 'appointmentsystem';
$dbusername = 'root';
$dbpassword = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e) {
    die("Connection failed". $e->getMessage());
 }

// Define queries (replace with your table and column names)
$fetchSql = "SELECT id, servicetype FROM service";
$insertSql = "INSERT INTO appointment (service_id, barber_id) VALUES (:servicetype , :barbername)"; // Adjust insert query

// Fetch data for select tag
$fetchStmt = $conn->prepare($fetchSql);
$fetchStmt->execute();
$results = $fetchStmt->fetchAll(PDO::FETCH_ASSOC);

$fetchSql1 = "SELECT id, barbername FROM barber";// Adjust insert query

// Fetch data for select tag
$fetchStmt1 = $conn->prepare($fetchSql1);
$fetchStmt1->execute();
$results1 = $fetchStmt1->fetchAll(PDO::FETCH_ASSOC);


if (!$results) {
  echo "No data found for select tag.";
  exit;
}

// Handle form submission (if applicable)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $selectedId = $_POST['servicetype'];
  $selectedId1 = $_POST['barbername']; // Replace with your select name

  // Prepare and execute insert statement
  $insertStmt = $conn->prepare($insertSql);
  $insertStmt->bindParam(':servicetype', $selectedId);
  $insertStmt->bindParam(':barbername', $selectedId1);
  $insertStmt->execute();

  

  if ($insertStmt->rowCount() > 0) {
    echo "ID inserted successfully!";
  } else {
    echo "Error inserting ID.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select and Insert Example</title>
</head>
<body>

  <form action="" method="post">
  <select name="barbername">
      <?php foreach ($results1 as $row1) : ?>
        <option value="<?php echo $row1['id']; ?>"><?php echo $row1['barbername']; ?></option>
      <?php endforeach; ?>
    </select>
 
    <select name="servicetype">
      <?php foreach ($results as $row) : ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['servicetype']; ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Submit</button>
  </form>

</body>
</html>

