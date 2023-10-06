<?php
session_start();

$jabatan = $_SESSION['jabatan'];
$bidang = $_SESSION['bidang'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bpkad";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        die("Koneksi Database Gagal : " . mysqli_connect_error());
    }

    // Ambil data dari form
    $no_surat = $_POST['no_surat'];
    $nama_surat = $_POST['nama_surat'];
    $instansi = $_POST['instansi'];
    $no_agenda = $_POST['no_agenda'];
    $tanggal_surat = $_POST['tanggal_surat'];
    $tanggal_diterima = $_POST['tanggal_diterima'];
    $prihal = $_POST['prihal'];
    $bidang = $_POST['bidang'];
    $tindak_lanjut = $_POST['tindak_lanjut'];
    $lampiran = $_POST['lampiran'];
    $sifat = $_POST['sifat'];
    $berkas = $_POST['berkas'];
    $keterangan = $_POST['keterangan'];
    $tanggal_ajuan = $_POST['tanggal_ajuan'];
    $tindakan = $_POST['tindakan'];
    $catatan = $_POST['catatan'];

    // Cek apakah catatan kosong, jika kosong isi dengan "-"
    if (empty($catatan)) {
        $catatan = "-";
    }

    // Query untuk menyimpan data ke tabel tb_kepala
    $sql = "INSERT INTO tb_kepala (no_surat, nama_surat, instansi, no_agenda, tanggal_surat, tanggal_diterima, prihal, bidang, tindak_lanjut, lampiran, sifat, berkas, keterangan, tanggal_ajuan, tindakan, catatan)
            VALUES ('$no_surat', '$nama_surat', '$instansi', '$no_agenda', '$tanggal_surat', '$tanggal_diterima', '$prihal', '$bidang', '$tindak_lanjut', '$lampiran', '$sifat', '$berkas', '$keterangan', '$tanggal_ajuan', '$tindakan', '$catatan')";

    if (mysqli_query($conn, $sql)) {
        // Perbarui status pada tb_disposisinya
        $update_status_query = "UPDATE tb_disposisinya SET st = 1 WHERE no_surat = '$no_surat'";
        mysqli_query($conn, $update_status_query);

        // Kirim email ke Kepala BPKAD
        require '../../PHPMailer/src/PHPMailer.php'; 
        require '../../PHPMailer/src/SMTP.php'; 
        require '../../PHPMailer/src/Exception.php'; 

        // Ambil email Kepala BPKAD
        $emailQuery = "SELECT email FROM user WHERE jabatan = 'Kepala BPKAD'";
        $emailResult = $conn->query($emailQuery);

        if ($emailResult->num_rows > 0) {
            $emailRow = $emailResult->fetch_assoc();
            $emailTujuan = $emailRow['email'];

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ganti dengan server SMTP yang sesuai
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'arsipbpkad2023@gmail.com';
            $mail->Password = 'uznotlfcmbbswffn';
            $mail->setFrom('no-reply@arsip.bpkad.com', 'Admin');
            $mail->addAddress($emailTujuan);
            $mail->Subject = 'Surat yang perlu dikonfirmasi';
            $mail->isHTML(true);
            $emailContent = '
            <html>
            <head>
            </head>
            <body>
                <a href="https://imgbb.com/"><img src="https://i.ibb.co/Svg6gnr/bpkad1.png" alt="bpkad1" border="0"></a>
                <p>Surat Sudah Terkonfirmasi Oleh ' . $_SESSION['jabatan'] . ' Silakan cek sistem.</p>
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

        // Set a success message in a session
        $_SESSION['success_message'] = "Data berhasil disimpan.";

        header("Location: ../../Kepala_BPKAD/pending.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Tutup koneksi setelah semua operasi selesai
}
?>