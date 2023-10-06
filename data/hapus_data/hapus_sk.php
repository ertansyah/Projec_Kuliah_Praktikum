<?php
session_start();
include '../../config.php';

// Fungsi untuk menghapus data berdasarkan id_tsk
function deleteData($id_tsk)
{
    $conn = koneksiDB();

    // Query SQL untuk mendapatkan path berkas sebelum menghapus data
    $getFileQuery = "SELECT berkas FROM tb_tsk WHERE id_tsk = ?";
    $getFileStmt = mysqli_prepare($conn, $getFileQuery);
    mysqli_stmt_bind_param($getFileStmt, "s", $id_tsk);
    mysqli_stmt_execute($getFileStmt);
    mysqli_stmt_bind_result($getFileStmt, $fileToDelete);
    mysqli_stmt_fetch($getFileStmt);
    mysqli_stmt_close($getFileStmt);

    // Query SQL untuk menghapus data dengan prepared statement
    $sql = "DELETE FROM tb_tsk WHERE id_tsk = ?";

    // Buat prepared statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameter id_tsk ke prepared statement
    mysqli_stmt_bind_param($stmt, "s", $id_tsk);

    // Hapus berkas terkait jika ditemukan
    if (!empty($fileToDelete)) {
        unlink($fileToDelete);
    }

    // Eksekusi prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Set pesan notifikasi untuk penghapusan berhasil
        $_SESSION['delete_message'] = "Data dan berkas terkait berhasil dihapus.";
    } else {
        // Set pesan notifikasi untuk penghapusan gagal
        $_SESSION['delete_message'] = "Error: " . mysqli_stmt_error($stmt);
    }

    // Tutup prepared statement
    mysqli_stmt_close($stmt);

    // Tutup koneksi
    mysqli_close($conn);
}

// Cek apakah parameter id_tsk ada pada URL
if (isset($_GET['id_tsk'])) {
    // Mendapatkan id_tsk dari URL
    $id_tsk = $_GET['id_tsk'];

    // Panggil fungsi untuk menghapus data
    deleteData($id_tsk);

    // Redirect kembali ke halaman sebelumnya (arsip_sm.php)
    header("Location: ../../menu/output/arsip_sk.php");
    exit();
} else {
    // Jika parameter id_tsk tidak ada pada URL, tampilkan pesan error
    $_SESSION['delete_message'] = "id_tsk tidak ditemukan.";
    header("Location: ../../menu/output/arsip_sk.php");
    exit();
}
?>
