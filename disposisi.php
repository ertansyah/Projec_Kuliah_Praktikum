<?php
session_start();
$jabatan = $_SESSION['jabatan'];
$bidang = $_SESSION['bidang'];
$no_surat = $_GET['no_surat'];
$nama_surat = $_GET['nama_surat'];
$instansi = $_GET['instansi'];
$no_agenda = $_GET['no_agenda'];
$tanggal_surat = $_GET['tanggal_surat'];
$tanggal_diterima = $_GET['tanggal_diterima'];
$prihal = $_GET['prihal'];
$lampiran = $_GET['lampiran'];
$sifat = $_GET['sifat'];
$berkas = $_GET['berkas'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dasboard - Arsip BPKAD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/table_disposisi.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="User/index.php">
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
                        <a class="nav-link" href="User/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="menu/output/arsip_sm.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-inbox"></i></div>
                            Surat Masuk
                        </a>
                        <a class="nav-link" href="menu/output/arsip_sk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Surat Keluar
                        </a>
                        <a class="nav-link" href="menu/output/pending.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Status Disposisi
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
                <div class="container mt-4">
                    <h2 class="text-center">Disposisi Surat</h2>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="table-responsive" mb-4>
                                <form action="data/simpan_data/simpan_disposisi.php" method="post">
                                    <table class="table table-hover table-striped   ">
                                        <thead class="table-primary">
                                            <tr>
                                                <th class="text-center" colspan="2" style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: 1px solid #D3D3D3; border-top: 1px solid #D3D3D3;">Deskripsi Surat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="short-col" style="height: 49px; border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">No Surat</td>
                                                <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;"><?php echo $no_surat; ?>
                                                    <input type="hidden" name="no_surat" value="<?php echo $no_surat; ?>">
                                                    <input type="hidden" name="berkas" value="<?php echo $berkas; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="short-col" style=" height: 49px;border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">Judul Surat</td>
                                                <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;"><?php echo $nama_surat; ?>
                                                    <input type="hidden" name="nama_surat" value="<?php echo $nama_surat; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="short-col" style=" height: 49px;border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">No Agenda</td>
                                                <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;"><?php echo $no_agenda; ?>
                                                    <input type="hidden" name="no_agenda" value="<?php echo $no_agenda; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="short-col" style=" height: 49px;border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">Prihal</td>
                                                <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;"><?php echo $prihal; ?>
                                                    <input type="hidden" name="prihal" value="<?php echo $prihal; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="short-col" style=" height: 49px;border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">Sifat</td>
                                                <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;"><?php echo $sifat; ?>
                                                    <input type="hidden" name="sifat" value="<?php echo $sifat; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="short-col" style=" height: 49px;border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">Instansi</td>
                                                <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;"><?php echo $instansi; ?>
                                                    <input type="hidden" name="instansi" value="<?php echo $instansi; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="short-col" style=" height: 49px;border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">Lampiran</td>
                                                <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;"><?php echo $lampiran; ?>
                                                    <input type="hidden" name="lampiran" value="<?php echo $lampiran; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="short-col" style=" height: 49px;border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">Tanggal Surat</td>
                                                <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;"><?php echo $tanggal_surat; ?>
                                                    <input type="hidden" name="tanggal_surat" value="<?php echo $tanggal_surat; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="short-col" style=" height: 49px;border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: 1px solid #D3D3D3; border-top: none;">Tanggal Diterima</td>
                                                <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: 1px solid #D3D3D3; border-top: none;"><?php echo $tanggal_diterima; ?>
                                                    <input type="hidden" name="tanggal_diterima" value="<?php echo $tanggal_diterima; ?>">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table class="table-footer">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="table-responsive" mb-4>
                                <table class="table table-hover table-striped">
                                    <thead class="table-success">
                                        <tr>
                                            <th class="text-center" style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: 1px solid #D3D3D3; border-top: 1px solid #D3D3D3;">Tindak Lanjut Disposisi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">
                                                <input type="checkbox" name="tindak_lanjut[]" value="Tanggapan dan saran"> Tanggapan dan saran
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">
                                                <input type="checkbox" name="tindak_lanjut[]" value="Proses Lebih lanjut"> Proses Lebih lanjut
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">
                                                <input type="checkbox" name="tindak_lanjut[]" value="Koordinasi / konfirmasi"> Koordinasi / konfirmasi
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: 1px solid #D3D3D3; border-top: none;">
                                                <input type="checkbox" id="checkbox4" name="tindak_lanjut_lainnya[]" value="Lainnya" onclick="handleCheckboxClick(this, 'inputText4')">
                                                <input type="text" id="inputText4" name="tindak_lanjut_lainnya" placeholder="Lainnya" disabled>
                                            </td>
                                        </tr>

                                    </tbody>
                            </div>
                            <div class="table-responsive mt-6">
                                <table class="table table-hover table-striped ">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="text-center" colspan="2" style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: 1px solid #D3D3D3; border-top: 1px solid #D3D3D3;">Diteruskan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="short-col" style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">Kepada</td>
                                            <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">
                                                <select class="form-select" id="jabatan" name="jabatan">
                                                    <option value="" disabled selected>Pilih jabatan</option>
                                                    <!-- Data jabatan yang diperoleh dari Ajax akan diisi di sini -->
                                                </select>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="short-col" style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">Keterangan</td>
                                            <td style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: none; border-top: none;">
                                                <textarea class="form-control" rows="3" name="keterangan"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2" style="border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;border-bottom: 1px solid #D3D3D3; border-top: 1px solid #D3D3D3;">
                                                <input type="hidden" name="tanggal_ajuan" id="tanggalAjuanInput">
                                                <button class="btn btn-primary" id="btnKirim"><i class="fas fa-paper-plane"></i> Kirim</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function handleCheckboxClick(checkbox, inputId) {
            var inputText = document.getElementById(inputId);
            if (checkbox.checked) {
                inputText.removeAttribute('disabled');
                inputText.focus();
            } else {
                inputText.setAttribute('disabled', 'true');
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengisi tanggal ajuan ke dalam input hidden saat tombol "Kirim" ditekan
            $("#btnKirim").click(function() {
                var currentDate = new Date();
                var formattedDate = currentDate.toISOString().split('T')[0]; // Format tanggal ke YYYY-MM-DD

                // Isi tanggal ajuan ke input hidden dengan id "tanggalAjuanInput"
                $("#tanggalAjuanInput").val(formattedDate);
            });
        });
    </script>
    <script>
$(document).ready(function () {
    // Menggunakan AJAX untuk mengambil data jabatan dari server
    $.ajax({
        url: 'data/get_data/getDataJabatan.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var select = $('#jabatan');
            select.empty();
            select.append('<option value="" disabled selected>Pilih jabatan</option>');
            
            // Loop melalui data dan hanya tambahkan opsi "Kepala BPKAD"
            $.each(data, function (key, value) {
                if (value.nama_jabatan === 'Kepala BPKAD') {
                    select.append('<option value="' + value.id + '">' + value.nama_jabatan + '</option>');
                }
            });
        },
        error: function () {
            console.log('Error fetching data.');
        }
    });
});
</script>

</body>

</html>