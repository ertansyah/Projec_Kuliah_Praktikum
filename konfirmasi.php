<?php
session_start();
$jabatan = $_SESSION['jabatan'];
$bidang = $_SESSION['bidang'];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $no_surat = isset($_GET['no_surat']) ? $_GET['no_surat'] : "";
    $nama_surat = isset($_GET['nama_surat']) ? $_GET['nama_surat'] : "";
    $instansi = isset($_GET['instansi']) ? $_GET['instansi'] : "";
    $no_agenda = isset($_GET['no_agenda']) ? $_GET['no_agenda'] : "";
    $tanggal_surat = isset($_GET['tanggal_surat']) ? $_GET['tanggal_surat'] : "";
    $tanggal_diterima = isset($_GET['tanggal_diterima']) ? $_GET['tanggal_diterima'] : "";
    $prihal = isset($_GET['prihal']) ? $_GET['prihal'] : "";
    $lampiran = isset($_GET['lampiran']) ? $_GET['lampiran'] : "";
    $sifat = isset($_GET['sifat']) ? $_GET['sifat'] : "";
    $berkas = isset($_GET['berkas']) ? $_GET['berkas'] : "";
    $bidang = isset($_GET['bidang']) ? $_GET['bidang'] : "";
    $keterangan = isset($_GET["keterangan"]) ? $_GET["keterangan"] : "";
    $tanggal_ajuan = isset($_GET["tanggal_ajuan"]) ? $_GET["tanggal_ajuan"] : "";
    $tindak_lanjut = isset($_GET["tindak_lanjut"]) ? explode(', ', $_GET["tindak_lanjut"]) : [];

    // Upload berkas jika ada
    if (isset($_FILES['berkas']) && $_FILES['berkas']['error'] === UPLOAD_ERR_OK) {
        $namaFile = $_FILES['berkas']['name'];
        $ukuranFile = $_FILES['berkas']['size'];
        $tmpFilePath = $_FILES['berkas']['tmp_name'];

        // Pindahkan berkas dari temporary folder ke folder tujuan
        $tujuan = "file/" . $namaFile;
        if (move_uploaded_file($tmpFilePath, $tujuan)) {
            // Lanjutkan dengan proses lainnya (misalnya, menyimpan data ke database)
        } else {
            echo "Terjadi kesalahan saat mengunggah berkas.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Konfirmasi - Disposisi BPKAD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <style>
        .short-col {
            width: 15%;
        }

        .table-header {
            border-top: 1px solid #333;
            border-bottom: 1px solid #333;
        }

        .table-footer {
            border-bottom: 1px solid #333;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="User/index_skre.php">
            <img src="assets/img/bpkad1.png" alt="BPKAD Logo" style="max-width: 150px; height: auto;" />
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Utama</div>
                        <a class="nav-link" href="User/index_skre.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="serketaris/pending.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-inbox"></i></div>
                            Perlu Konfirmasi
                        </a>
                        <a class="nav-link" href="serketaris/history.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            History
                        </a>
                        <div class="sb-sidenav-menu-heading"></div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <div><?php echo "Jabatan : $jabatan"; ?></div>
                    <div><?php echo "Bidang : $bidang"; ?></div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
            <div class="p-4">
                    <div class="card shadow ">
                        <div class="card-body">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-hover table-striped">
                                <form action="data/simpan_data/simpan_konfirmasi.php" method="post">
                                    <thead class="table-primary">
                                        <tr>
                                            <th colspan="2" style="border: 1px solid #D3D3D3;">
                                                <span class="me-2"><i class="fas fa-calendar-alt"></i></span>
                                                Nomor Agenda(<?php echo $no_agenda; ?><input type="hidden" name="no_agenda" value="<?php echo $no_agenda; ?>">)
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="border: 1px solid #D3D3D3;">
                                            <th scope="row" class="short-col" style="border: 1px solid #D3D3D3;">Sifat</th>
                                            <td><?php echo $sifat; ?>
                                                <input type="hidden" name="sifat" value="<?php echo $sifat; ?>">
                                                <input type="hidden" name="bidang" value="<?php echo $bidang; ?>">
                                            </td>
                                        </tr>
                                        <tr style="border: 1px solid #D3D3D3; ">
                                            <th scope="row" class="short-col" style="border: 1px solid #D3D3D3;">Diterima</th>
                                            <td><?php echo $tanggal_diterima; ?>
                                                <input type="hidden" name="tanggal_diterima" value="<?php echo $tanggal_diterima; ?>">
                                            </td>
                                        </tr>

                                    </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-hover table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th colspan="2" style="border: 1px solid #D3D3D3; position: relative;">
                                            <i class="fas fa-file-alt" style=" margin-right: 5px;"></i>
                                            <span style="font-weight: bold; ">Status Surat</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th scope="row" class="short-col" style="border: 1px solid #D3D3D3;">Status</th>
                                        <td>
                                            <span style="background-color: rgba(255, 0, 0, 0.5); color: white; padding: 5px 10px; border-radius: 10px;">Menunggu Konfirmasi</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="short-col" style="border: 1px solid #D3D3D3;">Tanggal</th>
                                        <td id="tanggalCell"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-striped">
                                <thead class="table-danger">
                                    <tr>
                                        <th colspan="2" style="border: 1px solid #D3D3D3; position: relative;">
                                            <i class="fas fa-info-circle" style=" margin-right: 5px;"></i>
                                            <span style="font-weight: bold; ">Informasi Detail Surat</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col" scope="row">No Surat</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $no_surat; ?>
                                            <input type="hidden" name="no_surat" value="<?php echo $no_surat; ?>">
                                            <input type="hidden" name="berkas" value="<?php echo $berkas; ?>">
                                            <input type="hidden" name="nama_surat" value="<?php echo $nama_surat; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col" scope="row">Instansi</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $instansi; ?>
                                            <input type="hidden" name="instansi" value="<?php echo $instansi; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col" scope="row">Prihal</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $prihal; ?>
                                            <input type="hidden" name="prihal" value="<?php echo $prihal; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col" scope="row">Tanggal Surat</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $tanggal_surat; ?>
                                            <input type="hidden" name="tanggal_surat" value="<?php echo $tanggal_surat; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col" scope="row">Lampiran</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $lampiran; ?>
                                            <input type="hidden" name="lampiran" value="<?php echo $lampiran; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col" scope="row">Tindak lanjut</th>
                                        <td style="border: 1px solid #D3D3D3;">
                                            <?php
                                            if (in_array("Lainnya", $tindak_lanjut)) {
                                                echo "<p>" . (isset($_GET["tindak_lanjut_lainnya"]) ? $_GET["tindak_lanjut_lainnya"] : "") . "</p>";
                                            } else {
                                                echo "<p>" . (implode(', ', $tindak_lanjut) ?: "Tidak ada tindak lanjut") . "</p>";
                                            }
                                            ?>
                                            <input type="hidden" name="tindak_lanjut" value="<?php echo implode(', ', $tindak_lanjut); ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col" scope="row">Catatan</th>
                                        <td style="border: 1px solid #D3D3D3;">
                                            <?php
                                            // Cek apakah catatan ada atau tidak diisi
                                            if (!empty($keterangan)) {
                                                echo $keterangan; // Tampilkan isi catatan
                                            } else {
                                                echo '-'; // Jika catatan tidak diisi, tampilkan tanda "-"
                                            }
                                            ?>
                                            <input type="hidden" name="keterangan" value="<?php echo $keterangan; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col" scope="row">File</th>
                                        <td style="border: 1px solid #D3D3D3;">
                                            <a href="DownloadFile.php?url=<?php echo urlencode($berkas); ?>" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Download">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                            <a href="viewfile.php?url=<?php echo urlencode($berkas); ?>" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            <tr style="border: 1px solid #D3D3D3; ">
                                                <td style="vertical-align: top;">
                                                    <i class="fas fa-calendar-alt" style="color: blue; margin-right: 5px;"></i>
                                                    <span style="font-weight: bold; color: blue;">Tanggal Ajuan
                                                        <br>
                                                        <br>
                                                    </span><?php echo $tanggal_ajuan; ?>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-hover table-striped" style="width: 100%;">
                                        <tbody>
                                            <tr style="border: 1px solid #D3D3D3;">
                                                <td style="vertical-align: top; width: 60%;">
                                                    <span style="font-weight: bold; color: blue; font-size: 15px;">
                                                        <i class="fas fa-tasks"></i> Tindakan
                                                    </span>
                                                    <br>
                                                    <select class="form-select border-0" name="tindakan" id="tindakanSelect" style="background-color: inherit; font-size: 20px;">
                                                        <option value="" disabled selected>-- Pilih tindakan --</option>
                                                        <option value="Ajukan ke Kepala BPKAD">Ajukan ke Kepala BPKAD</option>
                                                        <option value="Ditolak">Koreksi Kembali</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr id="catatanRow" style="display: none;">
                                        <td colspan="2" for="catatan">Catatan
                                            <textarea class="form-control" name="catatan" rows="4"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 text-right mt-4">

                        <button type="submit" class="btn btn-primary" name="kirim" value="true">
                            <i class="fas fa-paper-plane"></i> Kirim
                        </button>
                    </div>
                    </form>
                </div>
                        </div></div></div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Arsip BPKAD 2023</div>

                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/tanggal_konfirmasi.js"></script>
    <script>
        $(document).ready(function() {
            $("#tindakanSelect").change(function() {
                if ($(this).val() === "Ditolak") {
                    $("#catatanRow").show();
                } else {
                    $("#catatanRow").hide();
                }
            });
        });
    </script>

</body>

</html>