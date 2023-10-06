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

// Query untuk mengambil total jumlah jabatan
$query = "SELECT COUNT(*) as totalJabatan FROM jabatan";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalJabatan = $row['totalJabatan'];
    
    $response = array(
        "totalJabatan" => $totalJabatan
    );
    
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>
