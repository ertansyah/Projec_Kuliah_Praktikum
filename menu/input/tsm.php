<?php
session_start();
$jabatan = $_SESSION['jabatan'];
$bidang = $_SESSION['bidang'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Surat Masuk - BPKAD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        /* Adjust z-index for the datepicker */
        .datepicker {
            z-index: 1600 !important;
            /* Change this value as needed */
        }

        /* Ensure calendar dropdown is not cut off */
        .datepicker.dropdown-menu {
            top: auto;
            transform: translate3d(0, 100%, 0);
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">
            <img src="../../assets/img/bpkad1.png" alt="BPKAD Logo" style="max-width: 150px; height: auto;" />
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
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
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="../../User/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="../output/arsip_sm.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-inbox"></i></div>
                            Surat Masuk
                        </a>
                        <a class="nav-link" href="../output/arsip_sk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Surat Keluar
                        </a>
                        <a class="nav-link" href="../output/pending.php">
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
            <main class="container" style="width: 800px; margin: auto; padding: 10px;">
            <div class="p-4">
                    <div class="card shadow ">
                        <div class="card-body">
                        <h2 class="text-center">Form Upload Surat Masuk</h2>
                    </div>
                    <div class="card-body">
                        <form action="../../data/simpan_data/simpan_tsm.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="no_surat" class="form-label">Nomor Surat :</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                                            <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Masukkan Nomor Surat">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="instansi" class="form-label">Instansi :</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                            <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Masukkan Nama Instansi">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nama_surat" class="form-label">Judul Surat :</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                            <input type="text" class="form-control" id="nama_surat" name="nama_surat" placeholder="Masukkan Judul Surat">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_agenda" class="form-label">Nomor Agenda :</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                                            <input type="text" class="form-control" id="no_agenda" name="no_agenda" placeholder="Masukkan Nomor Agenda">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="tanggal_diterima" class="form-label">Tanggal Diterima:</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="text" class="form-control datepicker" id="tanggal_diterima" name="tanggal_diterima" placeholder="yyyy-mm-dd" readonly data-provide="datepicker">
                                            <button type="button" class="btn btn-primary" id="btnToday_tanggal_diterima">Hari Ini</button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_surat" class="form-label">Tanggal Surat:</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="text" class="form-control datepicker" id="tanggal_surat" name="tanggal_surat" placeholder="yyyy-mm-dd" readonly data-provide="datepicker">
                                            <button type="button" class="btn btn-primary" id="btnToday_tanggal_surat">Hari Ini</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="prihal" class="form-label">Prihal :</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-certificate"></i></span>
                                                <input type="text" class="form-control" id="prihal" name="prihal" placeholder="Masukkan Prihal">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lampiran" class="form-label">Lampiran :</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
                                            <select class="form-select" id="lampiran" name="lampiran">
                                                <option value="" disabled selected>Pilih Lampiran</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="sifat" class="form-label">Sifat :</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                            <select class="form-select" id="sifat" name="sifat">
                                                <option value="" disabled selected>Pilih Sifat</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="berkas" class="form-label">Upload File :</label>
                                        <input class="form-control" type="file" id="berkas" name="berkas" accept=".pdf, .jpg, .jpeg, .png">
                                        <span class="form-text text-muted">Hanya mendukung file PDF, JPEG, dan PNG.</span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Upload File</button>
                    </div>
                    </form>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../../js/get_lampiran.js"></script>
    <script src="../../js/get_sifat.js"></script>
    <script>
        function getTodayDate() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Tambahkan event listener untuk tombol "Hari Ini"
        document.getElementById('btnToday_tanggal_surat').addEventListener('click', function() {
            document.getElementById('tanggal_surat').value = getTodayDate();
        });

        document.getElementById('btnToday_tanggal_diterima').addEventListener('click', function() {
            document.getElementById('tanggal_diterima').value = getTodayDate();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd', // Mengatur format tanggal menjadi 'yyyy-mm-dd'
                autoclose: true
            });
        });
    </script>
</body>

</html>