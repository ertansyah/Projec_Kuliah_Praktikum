<?php
include '../../Koneksi.php';

// Ambil data surat dari database menggunakan fungsi selectAllData()
$result = selectAllData();
$data_surat = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data_surat[] = $row;
}

// Konversi data surat ke format JSON dan kirimkan sebagai respons
header('Content-Type: application/json');
echo json_encode($data_surat);
?>
