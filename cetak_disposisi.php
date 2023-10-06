<?php
$no_surat = isset($_GET['no_surat']) ? $_GET['no_surat'] : "";
$sifat = isset($_GET['sifat']) ? $_GET['sifat'] : "";
$instansi = isset($_GET['instansi']) ? $_GET['instansi'] : "";
$no_agenda = isset($_GET['no_agenda']) ? $_GET['no_agenda'] : "";
$tanggal_surat = isset($_GET['tanggal_surat']) ? $_GET['tanggal_surat'] : "";
$tanggal_diterima = isset($_GET['tanggal_diterima']) ? $_GET['tanggal_diterima'] : "";
$prihal = isset($_GET['prihal']) ? $_GET['prihal'] : "";
$keterangan = isset($_GET['keterangan']) ? $_GET['keterangan'] : "";
$tanggal_surat_formatted = date("d-F-Y", strtotime($tanggal_surat));
$tanggal_diterima_formatted = date("d-F-Y", strtotime($tanggal_diterima));

$koneksi = new mysqli("localhost", "root", "", "bpkad");
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

$no_surat = isset($_GET['no_surat']) ? $_GET['no_surat'] : "";

$query = "SELECT tanggal_ajuan, jabatan, tindak_lanjut FROM tb_disposisinya WHERE no_surat = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("s", $no_surat);
$stmt->execute();
$stmt->bind_result($tanggal_ajuan, $jabatan, $tindak_lanjut);
$stmt->fetch();
$tanggal_ajuan_formatted = date("d-F-Y", strtotime($tanggal_ajuan));
$stmt->close();

$koneksi->close();

$tindak_lanjut_array = explode(', ', $tindak_lanjut);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo and Text Alignment</title>
    <link href="css/cetak_disposisi.css" rel="stylesheet" />
</head>

<body>
    <div class="logo-container">
        <img src="assets/img/garut.png" alt="Garut Logo" class="logo">
        <div class="text-container">
            <div class="text">PEMERINTAHAN KABUPATEN GARUT</div>
            <div class="text bold-text">BADAN PENGELOLAAN DAN ASET DAERAH</div>
            <div class="text">Jl.Kiansantang No.03 Telp/Fax (0262) 234620 Garut 44100</div>
            <div class="line"></div>
        </div>
    </div>
    <div class="table-container">
        <table class="table">
            <tr>
                <td class="table-header " colspan="2">LEMBAR DISPOSISI</td>
            </tr>
            <tr>
                <td class="short-col" style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">Surat Dari : <?php echo $instansi; ?></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;">Diterima Tgl : <?php echo $tanggal_diterima_formatted; ?></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;"></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;">No. Agenda : <?php echo $no_agenda; ?></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">No. Surat : <?php echo $no_surat; ?></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;">Sifat : <?php echo $sifat; ?></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">Tgl. Surat : <?php echo $tanggal_surat_formatted; ?></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;"></td>
            </tr>
            <tr class="no-border-bottom">
                <td colspan="2">Perihal : <?php echo $prihal; ?></td>
            </tr>
            <tr class="no-border-top">
                <td colspan="2"></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">Diteruskan kepada sdr :</td>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">Dengan hormat harap :</td>
            </tr>
            <tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">
                    <label class="checkbox-container">
                        <input type="checkbox" name="jabatan[]" value="Sekretaris" <?php if ($jabatan === "Sekretaris") echo "checked"; ?> disabled>
                        <span class="checkbox-checkmark"></span> Sekretaris
                    </label>
                </td>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">
                    <label class="checkbox-container">
                        <input type="checkbox" name="tindak_lanjut[]" value="Tanggapan dan saran" <?php if (strpos($tindak_lanjut, "Tanggapan dan saran") !== false) echo "checked"; ?> disabled>
                        <span class="checkbox-checkmark"></span> Tanggapan dan Saran
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">
                    <label class="checkbox-container">
                        <input type="checkbox" name="jabatan[]" value="Kabid" <?php if ($jabatan === "Kabid") echo "checked"; ?> disabled>
                        <span class="checkbox-checkmark"></span> Kabid
                    </label>
                </td>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">
                    <label class="checkbox-container">
                        <input type="checkbox" name="tindak_lanjut[]" value="Proses Lebih lanjut" <?php if (strpos($tindak_lanjut, "Proses Lebih lanjut") !== false) echo "checked"; ?> disabled>
                        <span class="checkbox-checkmark"></span> Proses Lebih lanjut
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">
                    <label class="checkbox-container">
                        <input type="checkbox" name="jabatan[]" value="Kasih/Kasubag" <?php if ($jabatan === "Kasih/Kasubag") echo "checked"; ?> disabled>
                        <span class="checkbox-checkmark"></span> Kasih/Kasubag
                    </label>
                </td>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">
                    <label class="checkbox-container">
                        <input type="checkbox" name="tindak_lanjut[]" value="Koordinasi / konfirmasi" <?php if (strpos($tindak_lanjut, "Koordinasi / konfirmasi") !== false) echo "checked"; ?> disabled>
                        <span class="checkbox-checkmark"></span> Koordinasi / konfirmasi
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">Dan seterusnya.....</td>
                <td style="border-left: 1px solid #333; border-right: 1px solid #333; border-top: none; border-bottom: none;">
                    <label class="checkbox-container">
                        <input type="checkbox" name="tindak_lanjut[]" value="Lainnya" <?php if (strpos($tindak_lanjut, "Lainnya") !== false) echo "checked"; ?> disabled>
                        <span class="checkbox-checkmark"></span> Lainnya
                    </label>
                </td>
            </tr>


            <tr class="no-border-bottom">
                <td colspan="2">Catatan : </td>
            </tr>
            <tr class="no-border-bottom-up ">
                <td colspan="2"><?php echo $keterangan; ?></td>
            </tr>
            <tr class="no-border-bottom-up ">
                <td colspan="2"></td>
            </tr>
            <tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: none; border-top: none; border-bottom: none;"></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Garut, <?php echo $tanggal_ajuan_formatted; ?></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: none; border-top: none; border-bottom: none;"></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;"></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: none; border-top: none; border-bottom: none;"></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;"></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: none; border-top: none; border-bottom: none;"></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;"></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: none; border-top: none; border-bottom: none;"></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;"></td>
            </tr>
            <tr>
                <td style="border-left: 1px solid #333; border-right: none; border-top: none; border-bottom: none;"></td>
                <td style="border-left: none; border-right: 1px solid #333; border-top: none; border-bottom: none;"></td>
            </tr>
            <tr>
                <td class="left-align" style="border-top: none; border-bottom: 1px solid #333; text-align: right;" colspan="2">
                    <hr style="border: 1px solid #333; width: 25%; margin-left: 55%; margin-right: 10%; margin-top: -30px;">
                </td>
            </tr>
            </tr>
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