<?php
require_once '../../koneksi.php';

// Fungsi untuk mengambil surat masuk per hari ini
function selectSuratMasukHariIni() {
    $tanggalHariIni = date("Y-m-d");
    $query = "SELECT * FROM tb_tsm WHERE tanggal_diterima = '$tanggalHariIni'";
    $result = mysqli_query(koneksiDB(), $query);
    return $result;
}

// Mengambil data surat masuk
$suratMasukHariIni = selectSuratMasukHariIni();
$dataSuratMasuk = array();
while ($row = mysqli_fetch_assoc($suratMasukHariIni)) {
    $dataSuratMasuk[] = $row;
}

// Mengirimkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($dataSuratMasuk);
?>
