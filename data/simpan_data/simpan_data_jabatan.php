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
$nama_jabatan = $_POST['nama_jabatan'];

// SQL untuk menyimpan data ke dalam tabel indexs
$sql = "INSERT INTO jabatan (nama_jabatan) VALUES ('$nama_jabatan')";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    $notificationMessage = "Data berhasil disimpan ke database.";
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
?>
