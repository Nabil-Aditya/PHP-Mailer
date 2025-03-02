<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kirim Email</title>
</head>

<body>
    <h2>Kirim Pengajuan</h2>
    <form method="POST" action="kirim.php">
        <table>

            <tr>
                <td>NIP :</td>
                <td><input type="text" name="nip" size="30"></td>
            </tr>

            <tr>
                <td>Nama :</td>
                <td><input type="text" name="nama" size="30"></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="text" name="email" size="30"></td>
            </tr>

            <tr>
                <td>Nomor Telepon :</td>
                <td><input type="text" name="no_telp" size="30"></td>
            </tr>

            <!-- Subjek dan Pesan dihapus dari form karena akan ditetapkan otomatis di PHP -->
            <tr>
                <td></td>
                <td><input type="submit" name="kirim" value="Kirim"></td>
            </tr>
        </table>
    </form>
</body>

</html>