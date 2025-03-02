<?php
include 'koneksi.php'; // Koneksi ke database

// Dapatkan ID pengajuan dari URL
$id_pengajuan = $_GET['id'];

// Ambil data pengajuan dari database
$query = "SELECT * FROM tb_pengajuan_sementara WHERE id='$id_pengajuan'";
$result = mysqli_query($conn, $query);
$pengajuan = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['approve'])) {
        // Update status menjadi 'Approved'
        $update_query = "UPDATE tb_pengajuan_sementara SET status='Approved' WHERE id='$id_pengajuan'";
        mysqli_query($conn, $update_query);
        echo "Pengajuan telah disetujui.";
    } elseif (isset($_POST['reject'])) {
        // Update status menjadi 'Rejected'
        $update_query = "UPDATE tb_pengajuan_sementara SET status='Rejected' WHERE id='$id_pengajuan'";
        mysqli_query($conn, $update_query);
        echo "Pengajuan telah ditolak.";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Detail Pengajuan</h1>
    <p><strong>NIP:</strong> <?php echo $pengajuan['nip']; ?></p>
    <p><strong>Nama:</strong> <?php echo $pengajuan['nama']; ?></p>
    <p><strong>Email:</strong> <?php echo $pengajuan['email']; ?></p>
    <p><strong>No Telp:</strong> <?php echo $pengajuan['no_telp']; ?></p>

    <form method="post">
        <button type="submit" name="approve" style="background-color: #007BFF; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Approve</button>
        <button type="submit" name="reject" style="background-color: #FF0000; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Reject</button>
    </form>
</body>
</html>
