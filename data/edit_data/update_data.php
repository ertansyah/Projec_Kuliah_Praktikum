<?php
session_start();
include '../../Koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_tsm = $_POST['id_tsm']; 
    $no_surat = $_POST['no_surat'];
    $nama_surat = $_POST['nama_surat'];
    $no_agenda = $_POST['no_agenda']; 
    $prihal = $_POST['prihal'];
    $sifat = $_POST['sifat'];
    $instansi = $_POST['instansi'];
    $lampiran = $_POST['lampiran'];
    $tanggal_surat = $_POST['tanggal_surat'];
    $tanggal_diterima = $_POST['tanggal_diterima'];

    // Mengambil ID pengguna dari sesi
    $idUser = $_SESSION['idUser'];

    // Panggil fungsi untuk melakukan update data
    $result = updateData($id_tsm, $no_surat, $nama_surat, $no_agenda, $prihal, $sifat, $instansi, $lampiran, $tanggal_surat, $tanggal_diterima, $idUser);

    if ($result) {
        $_SESSION['update_message'] = "Data berhasil diperbarui.";
        header("Location: ../../menu/output/arsip_sm.php");
        exit();
    } else {
        $_SESSION['update_message'] = "Gagal memperbarui data.";
        header("Location: ../../menu/output/arsip_sm.php");
        exit();
    }
}
?>
