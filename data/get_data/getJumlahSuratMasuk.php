<?php
include '../../Koneksi.php';

$queryJumlahSuratMasuk = "SELECT COUNT(*) as jumlah FROM tb_tsm"; // Ganti nama tabel sesuai dengan tabel yang benar
$resultJumlahSuratMasuk = mysqli_query(koneksiDB(), $queryJumlahSuratMasuk);

if ($resultJumlahSuratMasuk) {
    $dataJumlahSuratMasuk = mysqli_fetch_assoc($resultJumlahSuratMasuk);
    $jumlahSuratMasuk = $dataJumlahSuratMasuk['jumlah'];
    echo json_encode(['jumlah' => $jumlahSuratMasuk]);
} else {
    echo json_encode(['error' => 'Gagal mendapatkan jumlah surat masuk']);
}

mysqli_close(koneksiDB());
?>
