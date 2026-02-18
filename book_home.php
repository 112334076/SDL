<?php
include "db.php";
if(isset($_POST['book'])){
    $home_id = $_POST['home_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['move_in_date'];

    $stmt = $conn->prepare("INSERT INTO bookings(home_id,tenant_name,phone,email,move_in_date) VALUES(?,?,?,?,?)");
    $stmt->bind_param("issss",$home_id,$name,$phone,$email,$date);
    $stmt->execute();

    $conn->query("UPDATE homes SET status='Rented' WHERE id=$home_id");

    echo "<script>alert('Booking Confirmed!');window.location='index.php';</script>";
}
?>
