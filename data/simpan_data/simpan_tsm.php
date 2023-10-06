<?php
session_start();

include '../../Koneksi.php';


$id_tsm = $_POST['id_tsm'];
$no_surat = $_POST['no_surat'];
$nama_surat = $_POST['nama_surat'];
$instansi = $_POST['instansi'];
$no_agenda = $_POST['no_agenda'];
$tanggal_surat = $_POST['tanggal_surat'];
$tanggal_diterima = $_POST['tanggal_diterima'];
$prihal = $_POST['prihal'];
$lampiran = $_POST['lampiran'];
$sifat = $_POST['sifat'];
$namaFile = $_FILES['berkas']['name'];
$x = explode('.', $namaFile);
$ekstensiFile = strtolower(end($x));
$ukuranFile = $_FILES['berkas']['size'];
$file_tmp = $_FILES['berkas']['tmp_name'];

// Lokasi Penempatan file
$dirUpload = "../../file/";
$linkBerkas = $dirUpload . $namaFile;

// Menyimpan file
$terupload = move_uploaded_file($file_tmp, $linkBerkas);

// Cek apakah nomor surat sudah terdaftar sebelumnya
$koneksi = koneksiDB();
$query_check = "SELECT COUNT(*) as count FROM tb_tsm WHERE no_surat = ?";
$stmt_check = mysqli_prepare($koneksi, $query_check);
mysqli_stmt_bind_param($stmt_check, "s", $no_surat);
mysqli_stmt_execute($stmt_check);
$result_check = mysqli_stmt_get_result($stmt_check);
$row_check = mysqli_fetch_assoc($result_check);

if ($row_check['count'] > 0) {
    $_SESSION['upload_message'] = "Upload Gagal! Nomor surat $no_surat telah terdaftar.";
    header("Location: ../../menu/output/arsip_sm.php", true, 301);
    exit();
}

$idUser = $_SESSION['idUser'];
$dataArr = array(
    'idUser' => $idUser,
    'id_tsm' => $id_tsm,
    'no_surat' => $no_surat,
    'nama_surat' => $nama_surat,
    'instansi' => $instansi,
    'no_agenda' => $no_agenda,
    'tanggal_surat' => $tanggal_surat,
    'tanggal_diterima' => $tanggal_diterima,
    'prihal' => $prihal,
    'lampiran' => $lampiran,
    'sifat' => $sifat,
    'title' => $namaFile,
    'size' => $ukuranFile,
    'ekstensi' => $ekstensiFile,
    'berkas' => $linkBerkas,
);


if ($terupload && (insertData($dataArr) == 1)) {
    $_SESSION['upload_message'] = "No Surat $no_surat Berhasil Di simpan !";
    header("Location: ../../menu/output/arsip_sm.php", true, 301);
    exit();
} else {
    $_SESSION['upload_message'] = "No Surat $no_surat Gagal Di simpan !";
    header("Location: ../../menu/output/arsip_sm.php", true, 301);
    exit();
}
?>
