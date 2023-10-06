<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

$notificationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = $_POST['editnip'];
    $nama = $_POST['editNama'];
    $noTlp = $_POST['editNoTlp'];
    $jabatan = $_POST['editJabatan'];
    $bidang = $_POST['editBidang'];

    $sql = "UPDATE user SET nama='$nama', no_tlp='$noTlp', jabatan='$jabatan', bidang='$bidang' WHERE nip='$nip'";

    if (mysqli_query($conn, $sql)) {
        $notificationMessage = "Data berhasil diperbarui.";
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

if (!empty($notificationMessage)) {
    header("Location: ../../menu/output/user.php?notification=" . urlencode($notificationMessage));
} else {
    header("Location: ../../menu/output/user.php");
}
exit();
