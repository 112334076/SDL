<?php
session_start();
if(!isset($_SESSION['admin'])) header("Location: login.php");
include "../db.php";

$id = $_GET['id'];
$home = $conn->query("SELECT * FROM homes WHERE id=$id")->fetch_assoc();

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $rent = $_POST['rent_amount'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $parking = $_POST['parking'];
    $desc = $_POST['description'];

    // Check if new image uploaded
    if($_FILES['image']['name']){
        $img_name = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$img_name);
    }else{
        $img_name = $home['image'];
    }

    $stmt = $conn->prepare("UPDATE homes SET title=?,type=?,location=?,rent_amount=?,bedrooms=?,bathrooms=?,parking=?,description=?,image=? WHERE id=?");
    $stmt->bind_param("sssidisssi",$title,$type,$location,$rent,$bedrooms,$bathrooms,$parking,$desc,$img_name,$id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_homes.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Home</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<header><h1>Edit Home</h1></header>
<main>
<form method="POST" enctype="multipart/form-data">
<label>Title:</label><input type="text" name="title" value="<?php echo $home['title']; ?>" required><br>
<label>Type:</label><input type="text" name="type" value="<?php echo $home['type']; ?>" required><br>
<label>Location:</label><input type="text" name="location" value="<?php echo $home['location']; ?>" required><br>
<label>Rent Amount:</label><input type="number" name="rent_amount" value="<?php echo $home['rent_amount']; ?>" required><br>
<label>Bedrooms:</label><input type="number" name="bedrooms" value="<?php echo $home['bedrooms']; ?>" required><br>
<label>Bathrooms:</label><input type="number" name="bathrooms" value="<?php echo $home['bathrooms']; ?>" required><br>
<label>Parking:</label><input type="text" name="parking" value="<?php echo $home['parking']; ?>"><br>
<label>Description:</label><textarea name="description"><?php echo $home['description']; ?></textarea><br>
<label>Image:</label><input type="file" name="image"><br>
<img src="../uploads/<?php echo $home['image']; ?>" style="width:150px;"><br>
<button type="submit" name="submit">Update Home</button>
</form>
</main>
</body>
</html>
