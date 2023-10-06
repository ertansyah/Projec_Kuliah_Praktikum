<?php
session_start();

$jabatan = $_SESSION['jabatan'];
$bidang = $_SESSION['bidang'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['kirim'])) {
    
    $no_agenda = $_POST['no_agenda'];
    $sifat = $_POST['sifat'];
    $tanggal_diterima = $_POST['tanggal_diterima'];
    $no_surat = $_POST['no_surat'];
    $instansi = $_POST['instansi'];
    $bidang = $_POST['bidang'];
    $prihal = $_POST['prihal'];
    $tanggal_surat = $_POST['tanggal_surat'];
    $lampiran = $_POST['lampiran'];
    $tindak_lanjut = $_POST['tindak_lanjut'];
    $keterangan = $_POST['keterangan'];
    $berkas = $_POST['berkas'];
    $tanggal_ajuan = date('Y-m-d');
    $tindakan = $_POST['tindakan'];
    $catatan = isset($_POST['catatan']) && !empty($_POST['catatan']) ? $_POST['catatan'] : '-';

    // Insert data into "tb_konfirmasi" table
    $sql_insert = "INSERT INTO tb_konfirmasi (no_agenda, sifat, tanggal_diterima, no_surat, bidang,  instansi, prihal, tanggal_surat, lampiran, tindak_lanjut, keterangan, berkas, tanggal_ajuan, tindakan, catatan)
               VALUES ('$no_agenda', '$sifat', '$tanggal_diterima', '$no_surat', '$instansi', '$bidang', '$prihal', '$tanggal_surat', '$lampiran', '$tindak_lanjut', '$keterangan', '$berkas', '$tanggal_ajuan', '$tindakan', '$catatan')";

    if ($conn->query($sql_insert) === TRUE) {
        // Update status to 1 in "tb_disposisinya" table
        $updateQuery = "UPDATE tb_disposisinya SET status = 1 WHERE no_surat = '$no_surat'";
        mysqli_query($conn, $updateQuery);

        // Redirect to "pending.php" with notification
        header("Location: ../../serketaris/pending.php?notification=Data berhasil dikonfirmasi");
        
         require '../../PHPMailer/src/PHPMailer.php'; 
         require '../../PHPMailer/src/SMTP.php'; 
         require '../../PHPMailer/src/Exception.php'; 

         $emailQuery = "SELECT email FROM user WHERE jabatan = 'Kepala BPKAD' AND bidang = 'Kepala BPKAD'";
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
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$conn->close();
?>
