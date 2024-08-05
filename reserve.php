<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $room_type = $_POST['room_type'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    // Insert into database
    $sql = "INSERT INTO reservations (name, phone, room_type, checkin, checkout)
    VALUES ('$name', '$phone', '$room_type', '$checkin', '$checkout')";

    if ($conn->query($sql) === TRUE) {
        // Append to reservation.html
        $reservationHTML = "
            <tr>
                <td>{$conn->insert_id}</td>
                <td>{$name}</td>
                <td>{$phone}</td>
                <td>{$room_type}</td>
                <td>{$checkin}</td>
                <td>{$checkout}</td>
                <td><button onclick=\"deleteReservation({$conn->insert_id})\">ลบ</button></td>
            </tr>
        ";
        
        $htmlFile = 'reservation.html';
        $currentContent = file_get_contents($htmlFile);
        
        // Insert the new reservation row before the closing </tbody> tag
        $updatedContent = str_replace('</tbody>', $reservationHTML . '</tbody>', $currentContent);
        
        file_put_contents($htmlFile, $updatedContent);
        
        header("Location: reserve.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
