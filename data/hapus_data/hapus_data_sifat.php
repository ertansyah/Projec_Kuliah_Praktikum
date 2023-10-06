<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}
$notificationMessage = "";

$no = $_GET['no'];


$sql = "DELETE FROM tb_sifat WHERE no = '$no'";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    $notificationMessage = "Data berhasil dihapus dari database.";
} else {
    $errorMessage = "Error: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);

if (!empty($notificationMessage)) {
    header("Location: ../../menu/output/sifat.php?notification=" . urlencode($notificationMessage));
} else {
    header("Location: ../../menu/output/sifat.php");
}
exit();
?>
