<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/PHPMailer.php'; 
require '../../PHPMailer/src/SMTP.php'; 
require '../../PHPMailer/src/Exception.php'; 

$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

$notificationMessage = ""; 
$notificationType = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $no_tlp = $_POST['no_tlp'];
    $jabatan = $_POST['jabatan'];
    $bidang = $_POST['bidang'];

    // Enkripsi password menggunakan password_hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Pengecekan NIP terdaftar
    $checkQuery = "SELECT nip FROM user WHERE nip = '$nip'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        $notificationMessage = "GAGAL, NIP $nip sudah terdaftar.";
        $notificationType = "danger"; 
    } else {
        $query = "INSERT INTO user (nip, nama, email, pass, no_tlp, jabatan, bidang) VALUES ('$nip', '$nama', '$email', '$hashedPassword', '$no_tlp', '$jabatan', '$bidang')";
        
        if (mysqli_query($conn, $query)) {
            // Kirim email menggunakan PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'arsipbpkad2023@gmail.com'; 
                $mail->Password = 'uznotlfcmbbswffn'; 
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587; 

                $mail->setFrom('no-reply@arsip.bpkad.com', 'Admin Arsip BPKAD');
                $mail->addAddress($email, $nama);
                $mail->Subject = 'Pendaftaran Akun';
                $mail->Body = " Anda Telah Di Daftarkan Di Aplikasi Arsip BPKAD\n Jabatan : $jabatan\n Bidang : $bidang\n NIP: $nip\n Password: $password \n Anda Dapat Mencoba Login Di Arsip BPKAD , Jika Ada Kesalahan Silahkan Hubungi ADMIN";

                $mail->send();

                $notificationMessage = "NIP $nip berhasil didaftarkan. Email berhasil dikirim.";
                $notificationType = "success";
            } catch (Exception $e) {
                $notificationMessage = "NIP $nip berhasil didaftarkan, tetapi terjadi kesalahan saat mengirim email: {$mail->ErrorInfo}";
                $notificationType = "warning"; 
            }
        } else {
            $errorMessage = "Terjadi kesalahan saat menambahkan data user: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);


if (!empty($notificationMessage)) {
    header("Location: ../../menu/output/user.php?notification=" . urlencode($notificationMessage) . "&notificationType=" . $notificationType);
} else {
    header("Location: ../../menu/output/user.php");
}
exit();
?>
