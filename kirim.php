<?php
include 'koneksi.php'; // Koneksi ke database

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Ambil data dari form
$nip = $_POST['nip'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_telp = $_POST['no_telp'];

// Set status default
$status = 'Pending';

// Simpan data ke dalam tabel sementara dengan status 'Pending'
$query = "INSERT INTO tb_pengajuan_sementara (nip, nama, email, no_telp, status) VALUES ('$nip', '$nama', '$email', '$no_telp', '$status')";
mysqli_query($conn, $query);

// Dapatkan ID terakhir yang dimasukkan
$id_pengajuan = mysqli_insert_id($conn);

// Tetapkan subjek dan pesan email
$judul = "Pengajuan Pelatihan";
$approval_link = "http://localhost/mail/admin.php?id=$id_pengajuan"; // Link untuk approve
$gambar_url = "https://www.polibatam.ac.id/wp-content/uploads/2022/01/poltek-2048x1821.png";
$pesan = "
    <div style='text-align: center;'>
        <img src='$gambar_url' alt='Gambar Pengajuan' style='max-width: 100%; height: auto; margin-bottom: 20px;'>
        <p><strong>Ada Pengajuan! Silahkan <b>Konfirmasi Pengajuan Pelatihan</b> dengan memilih tombol di bawah ini:</strong></p>
        <p>
            <a href='$approval_link' target='_blank' style='display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: #007BFF; text-decoration: none; border-radius: 5px;'>
                Approve
            </a>
        </p>
    </div>
";

// Kirim email ke admin
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pblpolibatam@gmail.com';
    $mail->Password = 'cvcyswsaniintymr';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('pblpolibatam@gmail.com', 'pblpolibatam');
    $mail->addAddress('nabiladitya2203@gmail.com', 'Admin');

    $mail->isHTML(true);
    $mail->Subject = $judul;
    $mail->Body = $pesan;
    $mail->AltBody = 'Ada Pengajuan! Silahkan Konfirmasi Pengajuan Pelatihan.';

    $mail->send();
    echo 'Pengajuan berhasil, menunggu persetujuan dari admin.';
} catch (Exception $e) {
    echo "Pengiriman email gagal: {$mail->ErrorInfo}";
}

// Redirect ke halaman pengguna dengan mengirimkan ID pengajuan
header("Location: halaman_pengguna.php?id=$id_pengajuan");
exit();
?>
