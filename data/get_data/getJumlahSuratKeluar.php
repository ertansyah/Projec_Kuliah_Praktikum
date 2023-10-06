<?php
include '../../config.php';

$queryJumlahSuratKeluar = "SELECT COUNT(*) as jumlah FROM tb_tsk"; // Ganti nama tabel sesuai dengan tabel yang benar
$resultJumlahSuratKeluar = mysqli_query(koneksiDB(), $queryJumlahSuratKeluar);

if ($resultJumlahSuratKeluar) {
    $dataJumlahSuratKeluar = mysqli_fetch_assoc($resultJumlahSuratKeluar);
    $jumlahSuratKeluar = $dataJumlahSuratKeluar['jumlah'];
    echo json_encode(['jumlah' => $jumlahSuratKeluar]);
} else {
    echo json_encode(['error' => 'Gagal mendapatkan jumlah surat keluar']);
}

mysqli_close(koneksiDB());
?>
