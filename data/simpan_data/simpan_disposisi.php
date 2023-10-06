<?php
session_start();

$jabatan = $_SESSION['jabatan'];
$bidang = $_SESSION['bidang'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



$no_surat = $_POST['no_surat'];
$nama_surat = $_POST['nama_surat'];
$instansi = $_POST['instansi'];
$no_agenda = $_POST['no_agenda'];
$tanggal_surat = $_POST['tanggal_surat'];
$tanggal_diterima = $_POST['tanggal_diterima'];
$prihal = $_POST['prihal'];
$lampiran = $_POST['lampiran'];
$sifat = $_POST['sifat'];
$berkas = $_POST['berkas'];

// Ambil data dari checkbox tindak_lanjut yang telah dipilih
if (isset($_POST['tindak_lanjut']) && is_array($_POST['tindak_lanjut'])) {
    $selected_tindak_lanjut = $_POST['tindak_lanjut'];

    // Jika input tindak_lanjut_lainnya memiliki nilai, gunakan nilai tersebut
    if (!empty($_POST['tindak_lanjut_lainnya'])) {
        $tindak_lanjut = $_POST['tindak_lanjut_lainnya'];
    } else {
        // Jika tidak, gunakan nilai dari checkbox yang dipilih
        $tindak_lanjut = implode(", ", $selected_tindak_lanjut);
    }
} else {
    $tindak_lanjut = ""; // Jika tidak ada yang dipilih
}

$jabatan = $_POST['jabatan'];

// Periksa bidang dan keterangan, jika kosong, ganti dengan tanda "-"
$bidang = empty($_POST['bidang']) ? "-" : $_POST['bidang'];
$keterangan = empty($_POST['keterangan']) ? "-" : $_POST['keterangan'];

$tanggal_ajuan = $_POST['tanggal_ajuan'];

// Lakukan penyimpanan data ke dalam tabel tb_disposisinya (asumsi Anda menggunakan MySQL)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk menyimpan data disposisi
$sql = "INSERT INTO tb_disposisinya (no_surat, nama_surat, instansi, no_agenda, tanggal_surat, tanggal_diterima, prihal, lampiran, sifat, berkas, tindak_lanjut, jabatan, bidang, keterangan, tanggal_ajuan)
        VALUES ('$no_surat', '$nama_surat', '$instansi', '$no_agenda', '$tanggal_surat', '$tanggal_diterima', '$prihal', '$lampiran', '$sifat', '$berkas', '$tindak_lanjut', '$jabatan', '$bidang', '$keterangan', '$tanggal_ajuan')";

if ($conn->query($sql) === TRUE) {
    // Jika penyimpanan berhasil, alihkan pengguna ke halaman "menu/output/pending.php"
    header("Location: ../../menu/output/pending.php");

    require '../../PHPMailer/src/PHPMailer.php'; 
    require '../../PHPMailer/src/SMTP.php'; 
    require '../../PHPMailer/src/Exception.php'; 
    

    // Ambil email tujuan dari tb_user berdasarkan kriteria
    $emailQuery = "SELECT email FROM user WHERE jabatan = 'Sekretaris' AND bidang = 'Sekretariat'";
    $emailResult = $conn->query($emailQuery);

    if ($emailResult->num_rows > 0) {
        $emailRow = $emailResult->fetch_assoc();
        $emailTujuan = $emailRow['email'];

        // Konfigurasi PHPMailer
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan server SMTP yang sesuai
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'arsipbpkad2023@gmail.com';
        $mail->Password = 'uznotlfcmbbswffn';
        $mail->setFrom('no-reply@arsip.bpkad.com', 'Arsip BPKAD');
        $mail->addAddress($emailTujuan);
        $mail->Subject = 'Surat yang perlu dikonfirmasi';
        $mail->isHTML(true);
        $emailContent = '
            <html>
            <head>
            </head>
            <body>
                <a href="https://imgbb.com/"><img src="https://i.ibb.co/Svg6gnr/bpkad1.png" alt="bpkad1" border="0"></a>
                <p>Ada surat yang perlu dikonfirmasi dari ' . $_SESSION['jabatan'] . ' (' . $_SESSION['bidang'] . '). Silakan cek sistem.</p>
            </body>
            </html>
        ';
            $mail->Body =  $emailContent;

        // Kirim email
        if (!$mail->send()) {
            echo 'Email could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Email has been sent.';
        }
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
