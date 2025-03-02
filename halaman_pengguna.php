<?php
include 'koneksi.php'; // Koneksi ke database

// Ambil ID dari URL atau metode lain (misalnya dari form)
$id_pengajuan = $_GET['id']; // Asumsikan id pengajuan diambil dari URL, misalnya: halaman_pengguna.php?id=1

// Query untuk mengambil status pengajuan dari tabel `tb_pengajuan_sementara` berdasarkan ID
$query = "SELECT status FROM tb_pengajuan_sementara WHERE id='$id_pengajuan' LIMIT 1";
$result = mysqli_query($conn, $query);
$pengajuan = mysqli_fetch_assoc($result);

// Periksa apakah data pengajuan ditemukan
if (!$pengajuan) {
    $status_pengajuan = "Pengajuan tidak ditemukan.";
    $warna_status = 'black'; // Warna default jika pengajuan tidak ditemukan
} else {
    $status_pengajuan = $pengajuan['status'];
    
    // Tentukan warna berdasarkan status
    switch ($status_pengajuan) {
        case 'Pending':
            $warna_status = 'blue';
            break;
        case 'Approved':
            $warna_status = 'green';
            break;
        case 'Rejected':
            $warna_status = 'red';
            break;
        default:
            $warna_status = 'black'; // Warna default jika status tidak sesuai dengan ketiga pilihan di atas
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan</title>
</head>
<body>
    <h1>Status Pengajuan</h1>
    <p>Status Pengajuan dengan ID <?php echo $id_pengajuan; ?>: 
        <strong style="color: <?php echo $warna_status; ?>;">
            <?php echo $status_pengajuan; ?>
        </strong>
    </p>

    <a href="logout.php">Logout</a>
</body>
</html>
