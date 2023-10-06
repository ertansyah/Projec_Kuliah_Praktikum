<?php
session_start();
include '../../Koneksi.php';

function deleteData($no_surat)
{
    $conn = koneksiDB();

    // Query SQL untuk mendapatkan path berkas sebelum menghapus data
    $getFileQuery = "SELECT berkas FROM tb_tsm WHERE no_surat = ?";
    $getFileStmt = mysqli_prepare($conn, $getFileQuery);
    mysqli_stmt_bind_param($getFileStmt, "s", $no_surat);
    mysqli_stmt_execute($getFileStmt);
    mysqli_stmt_bind_result($getFileStmt, $fileToDelete);
    mysqli_stmt_fetch($getFileStmt);
    mysqli_stmt_close($getFileStmt);

    // Hapus data dari tb_disposisinya
    $sql_disposisi = "DELETE FROM tb_disposisinya WHERE no_surat = ?";
    $stmt_disposisi = mysqli_prepare($conn, $sql_disposisi);
    mysqli_stmt_bind_param($stmt_disposisi, "s", $no_surat);
    mysqli_stmt_execute($stmt_disposisi);
    mysqli_stmt_close($stmt_disposisi);

    // Hapus data dari tb_kepala
    $sql_kepala = "DELETE FROM tb_kepala WHERE no_surat = ?";
    $stmt_kepala = mysqli_prepare($conn, $sql_kepala);
    mysqli_stmt_bind_param($stmt_kepala, "s", $no_surat);
    mysqli_stmt_execute($stmt_kepala);
    mysqli_stmt_close($stmt_kepala);

    // Hapus data dari tb_konfirmasi
    $sql_konfirmasi = "DELETE FROM tb_konfirmasi WHERE no_surat = ?";
    $stmt_konfirmasi = mysqli_prepare($conn, $sql_konfirmasi);
    mysqli_stmt_bind_param($stmt_konfirmasi, "s", $no_surat);
    mysqli_stmt_execute($stmt_konfirmasi);
    mysqli_stmt_close($stmt_konfirmasi);

    // Query SQL untuk menghapus data dengan prepared statement
    $sql_tsm = "DELETE FROM tb_tsm WHERE no_surat = ?";
    $stmt_tsm = mysqli_prepare($conn, $sql_tsm);
    mysqli_stmt_bind_param($stmt_tsm, "s", $no_surat);

    // Hapus berkas terkait jika ditemukan
    if (!empty($fileToDelete)) {
        unlink($fileToDelete);
    }

    if (mysqli_stmt_execute($stmt_tsm)) {
        $_SESSION['delete_message'] = "Data dan berkas terkait berhasil dihapus.";
    } else {
        $_SESSION['delete_message'] = "Error: " . mysqli_stmt_error($stmt_tsm);
    }
    
    mysqli_stmt_close($stmt_tsm);
    mysqli_close($conn);
}

if (isset($_GET['no_surat'])) {
    $no_surat = $_GET['no_surat'];
    deleteData($no_surat);
    header("Location: ../../menu/output/arsip_sm.php");
    exit();
} else {
    $_SESSION['delete_message'] = "No. Surat tidak ditemukan.";
    header("Location: ../../menu/output/arsip_sm.php");
    exit();
}
?>
