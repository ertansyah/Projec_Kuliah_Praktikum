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
$nama_lampiran = $_POST['lampiran'];

// Cek apakah data lampiran sudah ada di database
$checkQuery = "SELECT lampiran FROM tb_lampiran WHERE lampiran = '$nama_lampiran'";
$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) == 0) {
    // Data lampiran belum ada, maka tambahkan ke database
    $sql = "INSERT INTO tb_lampiran (lampiran) VALUES ('$nama_lampiran')";

    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        $notificationMessage = "Data berhasil disimpan ke database.";
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
    }
} else {
    $notificationMessage = "Data lampiran sudah ada dalam database.";
}


// Tutup koneksi
mysqli_close($conn);

if (!empty($notificationMessage)) {
    header("Location: ../../menu/output/lampiran.php?notification=" . urlencode($notificationMessage));
} else {
    header("Location: ../../menu/output/lampiran.php");
}
exit();
?>
