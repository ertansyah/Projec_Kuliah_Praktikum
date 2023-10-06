<?php
// Ambil data dari parameter URL
$id_tsm = $_GET['id_tsm'];
$no_surat = $_GET['no_surat'];
$prihal = $_GET['prihal'];
$tanggal_surat = $_GET['tanggal_surat'];
$tanggal_diterima = $_GET['tanggal_diterima'];
$instansi = $_GET['instansi'];

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kueri SQL untuk mengambil data jabatan dari tb_disposisinya
$sql = "SELECT jabatan FROM tb_disposisinya WHERE no_surat = '$no_surat'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jabatan = $row['jabatan'];
} else {
    $jabatan = "Jabatan Tidak Ditemukan";
}

// Ubah format tanggal menjadi "dd-F-y"
$tanggal_surat_formatted = date('d-F-y', strtotime($tanggal_surat));
$tanggal_diterima_formatted = date('d-F-y', strtotime($tanggal_diterima));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo and Text Alignment</title>
    <style>
        /* Styles untuk tampilan cetak */
        @media print {
            body {
                display: block;
                margin: 0;
                padding: 0;
                font-size: 12pt;
                background-color: #fff;
            }

            .table {
                border-collapse: collapse;
                width: 100%;
            }

            .table td {
                border: 1px solid #333;
                padding: 5px;
            }

            /* Ubah ukuran kertas ke r5 */
            @page {
                size: r5;
            }
        }

        /* Styles untuk tampilan layar normal */
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            /* Atur perataan konten dalam kolom */
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            padding-top: 40px;
        }

        .logo {
            max-height: 60px;
            /* Memperbesar logo */
            width: auto;
            margin-top: -45px;
            /* Geser logo sedikit ke atas */
        }

        .text {
            font-size: 15px;
            text-align: center;

        }

        .bold-text {
            font-weight: bold;
        }

        .text-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-top: -30px;
        }

        .line {
            width: 120%;
            /* Mengatur panjang garis */
            border: 1px solid #333;
            /* Warna dan ketebalan garis */
            margin-top: 0px;
            /* Ruang di atas garis */
            margin-bottom: 0;
            /* Hapus ruang di bawah garis */
            margin-left: -70px;
        }

        .left-align {
            width: 50%;
            /* Mengatur panjang garis */
            border: 1px solid #333;
            /* Warna dan ketebalan garis */
            margin-top: 0px;
            /* Ruang di atas garis */
            margin-bottom: 0;
            /* Hapus ruang di bawah garis */
            margin-left: -70px;
        }

        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: -10px;
            /* Ubah jarak kecil di sini */
            margin-left: -26px;
            margin-bottom: -100px;
            /* Atur jarak di bawah tabel */
            transform: translate(20px, -20px);
            /* Menggeser tabel ke kanan dan ke atas */
        }

        .table {
            border-collapse: collapse;
            width: fit-content;
            /* Lebar tabel mengikuti konten */
            table-layout: auto;
            /* Lebar tabel mengikuti konten */
        }

        .table td {
            border: 1px solid #333;
            /* Menambahkan border pada sel tabel */
            padding: 10px;
            /* Menambahkan ruang padding pada sel tabel */
        }

        .table td:not(:first-child):not(:last-child) {
            border-left: none;
            border-right: none;
            width: 200px;
        }

        .divider {
            width: 100%;
            border: 1px solid #333;
            /* Warna dan ketebalan garis */
            margin-top: 20px;
            /* Ruang di atas garis */
            margin-bottom: 20px;
            /* Ruang di bawah garis */
        }

        .table-header {
            text-align: center;
            font-weight: bold;
            padding: 10px;
            border-bottom: none;
            border-top: none;
        }

        .no-border-top td {
            border-top: none;
        }

        .no-border-bottom td {
            border-bottom: none;
        }

        .bno-order-bottom-up td {
            border-top: none;
            border-bottom: none;
        }

        .right-align td {
            text-align: right;
            border-top: none;
            border-bottom: none;
        }

        .multiline {
            display: inline-block;
            white-space: pre-line;
        }

        .label-cell {
            width: 160px;
            /* Sesuaikan lebar kolom pertama sesuai kebutuhan */
            padding-right: 10px;
            /* Sesuaikan jarak antara ":" dan isi label */
            text-align: right;
        }

        .short-col {
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="table-container" style="border-top: 1px solid #333;">
        <table class="table">
            <tr class="bno-order-bottom-up">
                <td colspan="2">
                    <div class="logo-container">
                        <img src="assets/img/garut.png" alt="Garut Logo" class="logo">
                        <div class="text-container">
                            <div class="text">PEMERINTAHAN KABUPATEN GARUT</div>
                            <div class="text bold-text">BADAN PENGELOLAAN DAN ASET DAERAH</div>
                            <div class="text">Jl.Kiansantang No.03 Telp/Fax (0262) 234620 Garut 44100</div>
                            <div class="line"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="table-header" style="border-bottom: none;border-top: none; font-size: 30px;" colspan="2">TANDA TERIMA</td>
            </tr>
            <tr class="bno-order-bottom-up">
                <td colspan="2"></td>
            </tr>
            <tr>
                <td class="short-col" style="border-left: 1px solid #333;border-right: none;border-bottom: none; border-top: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dari: </td>
                <td style="border-left: none;border-right: 1px solid #333;border-bottom: none; border-top: none;"><?php echo $instansi; ?></td>

            </tr>
            <tr>
                <td class="short-col" style="border-left: 1px solid #333;border-right: none;border-bottom: none; border-top: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prihal: </td>
                <td style="border-left: none;border-right: 1px solid #333;border-bottom: none; border-top: none;"><?php echo $prihal; ?></td>
            </tr>
            <tr>
                <td class="short-col" style="border-left: 1px solid #333;border-right: none;border-bottom: none; border-top: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. Surat: </td>
                <td style="border-left: none;border-right: 1px solid #333;border-bottom: none; border-top: none;"><?php echo $no_surat; ?></td>
            </tr>
            <tr>
                <td class="short-col" style="border-left: 1px solid #333;border-right: none;border-bottom: none; border-top: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal Surat : </td>
                <td style="border-left: none;border-right: 1px solid #333;border-bottom: none; border-top: none;"><?php echo $tanggal_surat_formatted; ?></td>
            </tr>
            <tr>
                <td class="short-col" style="border-left: 1px solid #333;border-right: none;border-bottom: none; border-top: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diarah ke :</td>
                <td style="border-left: none;border-right: 1px solid #333;border-bottom: none; border-top: none;"><?php echo $jabatan; ?></td>
            </tr>

            <tr class="right-align">
                <td colspan="2">Garut,&nbsp;<?php echo $tanggal_diterima_formatted; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>

            <tr>
                <td class="right-align" style="border-top: none;border-bottom: none; text-align: right;" colspan="2">Yang Menerima &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr class="bno-order-bottom-up">
                <td colspan="2"></td>
            </tr>
            <tr>
                <td class="left-align" style="border-top: none; border-bottom: none; text-align: right;" colspan="2">
                    <div style="position: relative;">
                        <hr style="border: none; width: 80%; margin-left: 65%; margin-right: 10%;">
                        <img src="" alt="" style="position: absolute; top: -120px; left: 65%;width: 150px; height: auto;">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="left-align" style="border-top: none; border-bottom: none; text-align: right;" colspan="2">
                    <hr style="border: 1px solid #333; width: 25%; margin-left: 65%; margin-right: 10%; margin-top: -30px;">
                </td>
            </tr>


            <tr class="bno-order-bottom-up">
                <td colspan="2">&nbsp;&nbsp;&nbsp;Catatan :</td>
            </tr>
            <tr class="no-border-top">
                <td colspan="2">
                    <div>&nbsp;&nbsp;&nbsp;Saat konfirmasi bukti tanda terima ini harap di bawa,<br>&nbsp;&nbsp;&nbsp;Apabila hilang di luar bukan tanggung jawab kami, trimakasih</div>
                </td>
            </tr>
        </table>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>