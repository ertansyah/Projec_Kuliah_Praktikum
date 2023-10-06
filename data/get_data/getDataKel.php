<?php
require_once '../../config.php';

// Fungsi untuk mengambil surat masuk per hari ini
function selectSuratKeluarHariIni() {
    $tanggalHariIni = date("Y-m-d");
    $query = "SELECT * FROM tb_tsk WHERE tanggal_keluar = '$tanggalHariIni'";
    $result = mysqli_query(koneksiDB(), $query);
    return $result;
}

// Mengambil data surat masuk
$suratKeluarHariIni = selectSuratKeluarHariIni();
$dataSuratKeluar = array();
while ($row = mysqli_fetch_assoc($suratKeluarHariIni)) {
    $dataSuratKeluar[] = $row;
}

// Mengirimkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($dataSuratKeluar);
?>
