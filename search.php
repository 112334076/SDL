<?php
include "db.php";
$keyword = $_GET['keyword'] ?? '';
$sql = "SELECT * FROM homes WHERE title LIKE '%$keyword%' OR type LIKE '%$keyword%' OR location LIKE '%$keyword%' ORDER BY id DESC";
$homes = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Search Homes</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<h1>Search Homes</h1>
<form method="GET">
<input type="text" name="keyword" placeholder="Search by title, type, location" value="<?php echo $keyword; ?>">
<button type="submit">Search</button>
</form>
</header>
<main style="display:flex;flex-wrap:wrap;gap:20px;">
<?php while($home = $homes->fetch_assoc()): ?>
<div style="border:1px solid #ccc;padding:15px;width:250px;">
    <img src="uploads/<?php echo $home['image']; ?>" style="width:100%;height:150px;">
    <h3><?php echo $home['title']; ?></h3>
    <p><?php echo $home['location']; ?></p>
    <p>Rent: ₹<?php echo $home['rent_amount']; ?></p>
    <p>Status: <?php echo $home['status']=='Available' ? '🟢 Available':'🔴 Rented'; ?></p>
    <a href="home_details.php?id=<?php echo $home['id']; ?>">View Details</a>
</div>
<?php endwhile; ?>
</main>
</body>
</html>
