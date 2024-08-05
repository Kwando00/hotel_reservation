<?php
$servername = "localhost";
$username = "root"; // ชื่อผู้ใช้ฐานข้อมูลของคุณ
$password = ""; // รหัสผ่านฐานข้อมูลของคุณ
$dbname = "hotel_booking";

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $room_type = $_POST["room_type"];
  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $check_in = $_POST["check_in"];
  $check_out = $_POST["check_out"];

  $stmt = $conn->prepare("INSERT INTO bookings (room_type, name, phone, check_in, check_out) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $room_type, $name, $phone, $check_in, $check_out);

  if ($stmt->execute()) {
    echo "การจองสำเร็จ";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
