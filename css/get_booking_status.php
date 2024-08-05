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

$room_types = ['standard', 'deluxe', 'suite'];
$rooms = [
  'standard' => ['total' => 45, 'booked' => 0],
  'deluxe' => ['total' => 11, 'booked' => 0],
  'suite' => ['total' => 5, 'booked' => 0]
];

$sql = "SELECT room_type, COUNT(*) as booked FROM bookings GROUP BY room_type";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $rooms[$row['room_type']]['booked'] = $row['booked'];
  }
}

echo json_encode($rooms);

$conn->close();
?>
