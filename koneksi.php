<?php
$servername = "localhost"; // Nama server database
$username = "root";        // Username database
$password = "";            // Password database (biarkan kosong jika tidak ada)
$dbname = "mail"; // Nama database yang digunakan

// Membuat koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
