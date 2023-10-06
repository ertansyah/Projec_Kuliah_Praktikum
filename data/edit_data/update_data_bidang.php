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
// Ambil data dari formulir
$edit_no = $_POST['edit_no'];
$nama_bidang_edit = $_POST['nama_bidang_edit'];


$sql = "UPDATE bidang SET nama_bidang = '$nama_bidang_edit' WHERE no = '$edit_no'";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    $notificationMessage = "Data berhasil diperbarui.";
} else {
    $errorMessage = "Error: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);

if (!empty($notificationMessage)) {
    header("Location: ../../menu/output/bidang.php?notification=" . urlencode($notificationMessage));
} else {
    header("Location: ../../menu/output/bidang.php");
}
exit();
