<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inovasi_hijau";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $suggestion = $_POST['suggestion'];

    $sql = "INSERT INTO suggestions (name, email, suggestion) VALUES ('$name', '$email', '$suggestion')";

    if ($conn->query($sql) === TRUE) {
        echo "Saran berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
