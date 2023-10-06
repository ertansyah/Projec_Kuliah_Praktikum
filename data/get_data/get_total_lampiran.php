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


$query = "SELECT COUNT(*) as totalLampiran FROM tb_lampiran";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalLampiran = $row['totalLampiran'];
    
    $response = array(
        "totalLampiran" => $totalLampiran
    );
    
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>
