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

// SQL untuk mengambil data dari tabel indexs
$sql = "SELECT * FROM bidang";

// Eksekusi query
$result = mysqli_query($conn, $sql);

// Cek apakah ada data
if (mysqli_num_rows($result) > 0) {
    // Buat array untuk menyimpan data
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    // Encode data menjadi format JSON
    echo json_encode($data);
} else {
    echo json_encode(array()); // Return empty JSON array if no data found
}

// Tutup koneksi
mysqli_close($conn);
?>
