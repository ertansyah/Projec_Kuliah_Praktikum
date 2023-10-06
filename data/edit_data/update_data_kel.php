<?php
session_start();
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_tsk = $_POST['id_tsk']; 
    $no_surat = $_POST['no_surat'];
    $nama_surat = $_POST['nama_surat'];
    $no_agenda = $_POST['no_agenda']; 
    $prihal = $_POST['prihal'];
    $sifat = $_POST['sifat'];
    $instansi = $_POST['instansi'];
    $lampiran = $_POST['lampiran'];
    $tanggal_surat = $_POST['tanggal_surat'];
    $tanggal_keluar = $_POST['tanggal_keluar'];

    $idUser = $_SESSION['idUser'];
    // Panggil fungsi untuk melakukan update data
    $result = updateData($id_tsk, $no_surat, $nama_surat, $no_agenda, $prihal, $sifat, $instansi, $lampiran, $tanggal_surat, $tanggal_keluar, $idUser);

    if ($result) {
       
        $_SESSION['update_message'] = "Data berhasil diperbarui.";
        header("Location: ../../menu/output/arsip_sk.php");
        exit();
    } else {
        $_SESSION['update_message'] = "Gagal memperbarui data.";
        header("Location: ../../menu/output/arsip_sk.php");
        exit();
    }
}
?>
