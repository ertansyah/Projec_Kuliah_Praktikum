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
$nama_jabatan_edit = $_POST['nama_jabatan_edit'];

// SQL untuk mengupdate data di tabel jabatan berdasarkan nomor
$sql = "UPDATE jabatan SET nama_jabatan = '$nama_jabatan_edit' WHERE no = '$edit_no'";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    $notificationMessage = "Data berhasil diperbarui.";
} else {
    $errorMessage = "Error: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);

if (!empty($notificationMessage)) {
    header("Location: ../../menu/output/jabatan.php?notification=" . urlencode($notificationMessage));
} else {
    header("Location: ../../menu/output/jabatan.php");
}
exit();
