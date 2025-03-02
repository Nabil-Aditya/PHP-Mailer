<?php
// ini wajib dipanggil paling atas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ini sesuaikan dengan lokasi folder dimana 3 file ini berada
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// sesuaikan nama variabel dengan nama variabel yg ada di form pada file index.php
$nama  = $_POST['nama'];
$email = $_POST['email'];
$judul = $_POST['subjek'];
$pesan = $_POST['pesan'];

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 3;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                             // Enable SMTP authentication
    $mail->Username   = 'pblpolibatam@gmail.com';         // SMTP username
    $mail->Password   = 'cvcyswsaniintymr';               // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption
    $mail->Port       = 587;                              // TCP port to connect to

    // Pengirim
    $mail->setFrom('pblpolibatam@gmail.com', 'pblpolibatam');
    // Penerima
    $mail->addAddress($_POST['email'], $_POST['nama']);    // Email penerima

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $judul;
    $mail->Body    = $pesan;
    $mail->AltBody = 'PHP mailer';                         // Body email (optional)

    // Send the email
    if(!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent successfully';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
