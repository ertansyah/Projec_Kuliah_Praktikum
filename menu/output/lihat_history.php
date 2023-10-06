<?php
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
    $tindakan = isset($_GET['tindakan']) ? $_GET['tindakan'] : "";
    $keterangan = isset($_GET["keterangan"]) ? $_GET["keterangan"] : "";
    $tanggal_ajuan = isset($_GET["tanggal_ajuan"]) ? $_GET["tanggal_ajuan"] : "";
    $tindak_lanjut = isset($_GET["tindak_lanjut"]) ? explode(', ', $_GET["tindak_lanjut"]) : [];
    $catatan = isset($_GET['catatan']) ? $_GET['catatan'] : "";
    $currentDate = new DateTime();
    $tanggalAjuanDate = new DateTime($tanggal_ajuan);
    $interval = $currentDate->diff($tanggalAjuanDate);
    $daysDifference = $interval->days;

    // Check if it has been more than a week (7 days)
    $hideAfterWeek = ($daysDifference > 1);


    // Upload berkas jika ada
    if (isset($_FILES['berkas']) && $_FILES['berkas']['error'] === UPLOAD_ERR_OK) {
        $namaFile = $_FILES['berkas']['name'];
        $ukuranFile = $_FILES['berkas']['size'];
        $tmpFilePath = $_FILES['berkas']['tmp_name'];

        // Pindahkan berkas dari temporary folder ke folder tujuan
        $tujuan = "../../file/" . $namaFile;
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
    <title>Konfirmasi - Arsip BPKAD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../css/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <style>
        .short-col {
            width: 30%;
        }

        .short-col-des {
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
        <a class="navbar-brand ps-3" href="../../User/index.php">
            <img src="../../assets/img/bpkad1.png" alt="BPKAD Logo" style="max-width: 150px; height: auto;" />
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
                    <li><a class="dropdown-item" href="../../logout.php">Logout</a></li>
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
                        <a class="nav-link" href="../../User/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="arsip_sm.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-inbox"></i></div>
                            Surat Masuk
                        </a>
                        <a class="nav-link" href="arsip_sk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Surat Keluar
                        </a>
                        <a class="nav-link" href="pending.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Status Disposisi
                        </a>
                        <div class="sb-sidenav-menu-heading"></div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="p-4">
                    <div class="card shadow">
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

                                            </td>
                                        </tr>
                                        <tr style="border: 1px solid #D3D3D3; ">
                                            <th scope="row" class="short-col" style="border: 1px solid #D3D3D3;">Diterima</th>
                                            <td><?php echo $tanggal_diterima; ?>
                                                <input type="hidden" name="tanggal_diterima" value="<?php echo $tanggal_diterima; ?>">
                                            </td>
                                        </tr>
                                        <!-- Example of hiding a table row after a week -->
                                        <tr style="border: 1px solid #D3D3D3; <?php echo ($hideAfterWeek) ? 'display: none;' : ''; ?>">
                                            <th scope="row" class="short-col" style="border: 1px solid #D3D3D3;">Tanggal Ajuan</th>
                                            <td><?php echo $tanggal_ajuan; ?></td>
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
                                            <?php
                                            if (empty($tindakan)) {
                                                echo '<span class="badge badge-primary" style="font-size: 16px; padding: 5px 10px; border-radius: 20px; font-weight: bold;">Pending</span>';
                                            } else {
                                                if ($tindakan === 'Ajukan ke Kepala BPKAD') {
                                                    echo '<span class="badge badge-success" style="font-size: 16px; padding: 5px 10px; border-radius: 10px; font-weight: bold;">' . $tindakan . '</span>';
                                                } elseif ($tindakan === 'Disetujui') {
                                                    echo '<span class="badge badge-success" style="font-size: 16px; padding: 5px 10px; border-radius: 10px; font-weight: bold;">' . $tindakan . '</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger" style="font-size: 16px; padding: 5px 10px; border-radius: 10px; font-weight: bold;">' . $tindakan . '</span>';
                                                }
                                            }
                                            ?>
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
                                        <th class="short-col-des" scope="row">No Surat</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $no_surat; ?>
                                            <input type="hidden" name="no_surat" value="<?php echo $no_surat; ?>">
                                            <input type="hidden" name="berkas" value="<?php echo $berkas; ?>">
                                            <input type="hidden" name="nama_surat" value="<?php echo $nama_surat; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col-des" scope="row">Instansi</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $instansi; ?>
                                            <input type="hidden" name="instansi" value="<?php echo $instansi; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col-des" scope="row">Prihal</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $prihal; ?>
                                            <input type="hidden" name="prihal" value="<?php echo $prihal; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col-des" scope="row">Tanggal Surat</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $tanggal_surat; ?>
                                            <input type="hidden" name="tanggal_surat" value="<?php echo $tanggal_surat; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col-des" scope="row">Lampiran</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $lampiran; ?>
                                            <input type="hidden" name="lampiran" value="<?php echo $lampiran; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col-des" scope="row">Koreksi</th>
                                        <td style="border: 1px solid #D3D3D3;"><?php echo $catatan; ?>
                                            <input type="hidden" name="catatan" value="<?php echo $catatan; ?>">
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid #D3D3D3;">
                                        <th class="short-col-des" scope="row">Tindak lanjut</th>
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
                                        <th class="short-col-des" scope="row">Catatan</th>
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
                                        <th class="short-col-des" scope="row">File</th>
                                        <td style="border: 1px solid #D3D3D3;">
                                            <?php if (isset($berkas) && in_array(pathinfo($berkas, PATHINFO_EXTENSION), ['pdf', 'jpg', 'jpeg', 'png'])) : ?>
                                                <a href="<?php echo $berkas; ?>" download class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Download">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            <?php elseif (isset($berkas)) : ?>
                                                <span class="text-muted">Invalid File Type</span>
                                            <?php endif; ?>
                                            <!-- Bagian tombol "View" -->
                                            <?php if (isset($berkas) && in_array(pathinfo($berkas, PATHINFO_EXTENSION), ['pdf', 'jpg', 'jpeg', 'png'])) : ?>
                                                <a href="<?php echo $berkas; ?>" target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            <?php elseif (isset($berkas)) : ?>
                                                <span class="text-muted">Invalid File Type</span>
                                            <?php endif; ?>
                                            <?php if ($tindakan === 'Disetujui') : ?>
                                                <a href="../../cetak_disposisi.php?no_surat=<?php echo urlencode($no_surat); ?>&sifat=<?php echo urlencode($sifat); ?>&keterangan=<?php echo urlencode($keterangan); ?>&instansi=<?php echo urlencode($instansi); ?>&no_agenda=<?php echo urlencode($no_agenda); ?>&tanggal_surat=<?php echo urlencode($tanggal_surat); ?>&tanggal_diterima=<?php echo urlencode($tanggal_diterima); ?>&prihal=<?php echo urlencode($prihal); ?>" target="_blank" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Cetak disposisi" <?php if ($tindakan === 'Ditolak') echo 'style="display: none;"'; ?>>
                                                    <i class="fas fa-print"></i> Cetak Disposisi
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    <script src="../../js/scripts.js"></script>
    <script src="../../js/tanggal_konfirmasi.js"></script>
    <script>
        $(document).ready(function() {
            $("#tindakanSelect").change(function() {
                if ($(this).val() === "koreksi") {
                    $("#catatanRow").show();
                } else {
                    $("#catatanRow").hide();
                }
            });
        });
    </script>

</body>

</html>