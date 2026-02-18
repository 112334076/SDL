<?php
session_start();
if(!isset($_SESSION['admin'])) header("Location: login.php");
include "../db.php";

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $rent = $_POST['rent_amount'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $parking = $_POST['parking'];
    $desc = $_POST['description'];

    // Image Upload
    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $upload_dir = "../uploads/".$img_name;
    move_uploaded_file($tmp_name, $upload_dir);

    $stmt = $conn->prepare("INSERT INTO homes(title,type,location,rent_amount,bedrooms,bathrooms,parking,description,image) VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssidisss",$title,$type,$location,$rent,$bedrooms,$bathrooms,$parking,$desc,$img_name);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_homes.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Home</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<header><h1>Add New Home</h1></header>
<main>
<form method="POST" enctype="multipart/form-data">
<label>Title:</label><input type="text" name="title" required><br>
<label>Type:</label><input type="text" name="type" required><br>
<label>Location:</label><input type="text" name="location" required><br>
<label>Rent Amount:</label><input type="number" name="rent_amount" required><br>
<label>Bedrooms:</label><input type="number" name="bedrooms" required><br>
<label>Bathrooms:</label><input type="number" name="bathrooms" required><br>
<label>Parking:</label><input type="text" name="parking"><br>
<label>Description:</label><textarea name="description"></textarea><br>
<label>Image:</label><input type="file" name="image" required><br>
<button type="submit" name="submit">Add Home</button>
</form>
</main>
</body>
</html>
