<?php
include "db.php";
$keyword = $_GET['keyword'] ?? '';
$sql = "SELECT * FROM homes WHERE title LIKE '%$keyword%' OR type LIKE '%$keyword%' OR location LIKE '%$keyword%' ORDER BY id DESC";
$homes = $conn->query($sql);

while($home = $homes->fetch_assoc()):
?>
<div class="home-card">
    <img src="uploads/<?php echo $home['image']; ?>" alt="home">
    <h3><?php echo $home['title']; ?></h3>
    <p><?php echo $home['location']; ?></p>
    <p>Rent: ₹<?php echo $home['rent_amount']; ?></p>
    <p>Status: <?php echo $home['status']=='Available' ? '🟢 Available':'🔴 Rented'; ?></p>
    <a href="home_details.php?id=<?php echo $home['id']; ?>">View Details</a>
</div>
<?php endwhile; ?>
