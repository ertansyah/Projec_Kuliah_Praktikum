<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

$notificationMessage = ""; // Deklarasi variabel notifikasi di awal

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    // Hapus data user berdasarkan nip
    $sql = "DELETE FROM user WHERE nip='$nip'";

    if (mysqli_query($conn, $sql)) {
        $notificationMessage = "Data user berhasil dihapus."; // Set pesan notifikasi berhasil
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

// Lakukan pengalihan header ke halaman user.php
if (!empty($notificationMessage)) {
    header("Location: ../../menu/output/user.php?notification=" . urlencode($notificationMessage));
} else {
    header("Location: ../../menu/output/user.php");
}
exit(); // Pastikan Anda menambahkan exit() setelah melakukan redirect
?>
