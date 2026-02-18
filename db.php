<?php
include "db.php";

$homes = $conn->query("SELECT * FROM homes");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rental Homes</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Smart Rental Management</h1></header>
<main class="home-list">
<?php while($row = $homes->fetch_assoc()){ ?>
<div class="home-card">
    <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
    <h2><?php echo $row['title']; ?></h2>
    <p>Location: <?php echo $row['location']; ?></p>
    <p>Rent: ₹<?php echo $row['rent_amount']; ?></p>
    <p>Status: <span class="<?php echo strtolower($row['status']); ?>"><?php echo $row['status']; ?></span></p>
    <?php if($row['status']=="Available"){ ?>
        <a href="book_home.php?id=<?php echo $row['id']; ?>"><button>Book Now</button></a>
    <?php } else { ?>
        <button disabled>Rented</button>
    <?php } ?><?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

</div>
<?php } ?>
</main>
</body>
</html>