<?php
session_start();
$jabatan = $_SESSION['jabatan'];
$bidang = $_SESSION['bidang'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
<script>
            // Store the current URL
            var currentUrl = window.location.href;
         
            // Disable back button on the browser
            history.pushState(null, null, currentUrl);
            window.onpopstate = function () {
               history.go(1);
            };
        </script> 
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dasboard - Arsip BPKAD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/slideshow.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">
            <img src="../assets/img/bpkad1.png" alt="BPKAD Logo" style="max-width: 150px; height: auto;" />
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
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
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="../menu/output/arsip_sm.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-inbox"></i></div>
                            Surat Masuk
                        </a>
                        <a class="nav-link" href="../menu/output/arsip_sk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Surat Keluar
                        </a>
                        <a class="nav-link" href="../menu/output/pending.php">
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
            <div class="p-4">
                    <div class="card shadow ">
                        <div class="card-body">
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-0">Jumlah Surat Masuk</p>
                                        <p class="mb-0" id="jumlahSuratMasuk">Loading...</p>

                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fas fas fa-download fa-2x mr-3"></i>
                                        <div class="small text-white"><i class=""></i></div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../menu/output/arsip_sm.php">Lihat
                                        Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-0">Jumlah Surat Keluar</p>
                                        <p class="mb-0" id="jumlahSuratKeluar">Loading...</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fas fas fa-upload fa-2x mr-3"></i>
                                        <div class="small text-white"><i class=""></i></div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../menu/output/arsip_sk.php">Lihat
                                        Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-0">Status Disposisi</p>
                                        <p class="mb-0" id="julmahDisposisi">Loading...</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt fa-2x mr-3"></i>
                                        <div class="small text-white"><i class=""></i></div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../menu/output/pending.php">Lihat
                                        Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="mb-4">Surat Diterima Hari Ini</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover  table-striped table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>No Surat</th>
                                    <th>Nama Surat</th>
                                    <th>Instansi</th>
                                    <th>No Agenda</th>
                                    <th>Tanggal Surat</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Prihal</th>
                                    <th>Lampiran</th>
                                    <th>Sifat</th>
                                    <th>Berkas</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody id="suratMasukTable">
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <!-- Pagination Content -->
                            </ul>
                        </nav>
                    </div>

                    <h1 class="mb-4">Surat Keluar Hari Ini</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover  table-striped table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>No Surat</th>
                                    <th>Nama Surat</th>
                                    <th>Instansi</th>
                                    <th>No Agenda</th>
                                    <th>Tanggal Surat</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Prihal</th>
                                    <th>Lampiran</th>
                                    <th>Sifat</th>
                                    <th>Berkas</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody id="suratKeluarTable">

                                <!-- Data akan ditampilkan di sini oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <!-- Pagination Content -->
                            </ul>
                        </nav>
                    </div>

                </div>
                        </div></div></div>
                        <div id="slideShow" class="slide-show">
                    <div id="slideButton" class="slide-button" onclick="toggleSlide()">
                        <span class="slide-text"><i class="fas fa-question-circle"></i> Bantuan</span>
                    </div>
                    <div id="slideContent" class="slide-content">
                        <div class="card">
                            <div class="card-body">
                                <h5><i class="fas fa-file-pdf"></i> Buku Petunjuk Lengkap </h5>
                                <a href="../file/Umum - Buku Petunjuk Arsip BPKAD.pdf" target="_blank"><i class="fas fa-file-pdf"></i>Lihat Buku Petunjuk </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- Isi slide content di sini -->
                                <iframe width="800" height="450" src="https://www.youtube.com/embed/O-K6YnljnWo" frameborder="0" allowfullscreen></iframe>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var slideContent = document.getElementById("slideContent");
        var slideButton = document.getElementById("slideButton");

        function toggleSlide() {
            if (slideContent.style.display === "none" || slideContent.style.display === "") {
                slideContent.style.display = "block";
                slideContent.style.animation = "none";
                setTimeout(function() {
                    slideContent.style.animation = "slide 0.5s ease-out forwards";
                }, 100);

                // Menambah event listener untuk menutup konten saat di luar konten diklik
                window.addEventListener("click", closeOutsideContent);
            }
        }

        function closeOutsideContent(event) {
            if (!slideButton.contains(event.target) && !slideContent.contains(event.target)) {
                slideContent.style.animation = "none";
                setTimeout(function() {
                    slideContent.style.animation = "slide-reverse 0.5s ease-out forwards";
                    slideContent.style.display = "none";
                }, 100);
                window.removeEventListener("click", closeOutsideContent);
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            var data_per_halaman = 5;
            var halaman_aktif = 1;
            var jumlah_data = 0;
            var data_surat = []; // Menyimpan data surat dari server

            function tampilkanData(halaman) {
                var data_awal = (halaman - 1) * data_per_halaman;
                var data_akhir = data_awal + data_per_halaman;
                var data_tampil = data_surat.slice(data_awal, data_akhir);

                var tableBody = $('#suratMasukTable');
                tableBody.empty();

                if (data_tampil.length > 0) {
                    data_tampil.forEach(function (item) {
                        var row = '<tr>';
                        row += '<td>' + item.no_surat + '</td>';
                        row += '<td>' + item.nama_surat + '</td>';
                        row += '<td>' + item.instansi + '</td>';
                        row += '<td>' + item.no_agenda + '</td>';
                        row += '<td>' + item.tanggal_surat + '</td>';
                        row += '<td>' + item.tanggal_diterima + '</td>';
                        row += '<td>' + item.prihal + '</td>';
                        row += '<td>' + item.lampiran + '</td>';
                        row += '<td>' + item.sifat + '</td>';
                        row += '<td>' + item.title + '</td>';
                        row += '<td><a href="' + item.berkas + '" class="btn btn-primary" download>Download</a></td>';
                        row += '</tr>';
                        tableBody.append(row);
                    });
                } else {
                    tableBody.html('<tr><td colspan="9">Tidak ada surat diterima hari ini.</td></tr>');
                }
            }

            function buatTombolHalaman() {
                var jumlah_halaman = Math.ceil(jumlah_data / data_per_halaman);
                var pagination = $('.pagination');
                pagination.empty();

                var prevBtn = $('<li class="page-item"><a class="page-link" href="#">Prev</a></li>');
                if (halaman_aktif === 1) {
                    prevBtn.addClass('disabled');
                } else {
                    prevBtn.click(function (e) {
                        e.preventDefault();
                        halaman_aktif--;
                        tampilkanData(halaman_aktif);
                        buatTombolHalaman();
                    });
                }
                pagination.append(prevBtn);

                var li = $('<li class="page-item"><a class="page-link" href="#">' + halaman_aktif + '</a></li>');
                li.addClass('active');
                pagination.append(li);

                var nextBtn = $('<li class="page-item"><a class="page-link" href="#">Next</a></li>');
                if (halaman_aktif === jumlah_halaman) {
                    nextBtn.addClass('disabled');
                } else {
                    nextBtn.click(function (e) {
                        e.preventDefault();
                        halaman_aktif++;
                        tampilkanData(halaman_aktif);
                        buatTombolHalaman();
                    });
                }
                pagination.append(nextBtn);
            }

            $.ajax({
                url: '../data/get_data/getData.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    data_surat = data;
                    jumlah_data = data_surat.length;
                    tampilkanData(halaman_aktif);
                    buatTombolHalaman();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Mengambil data jumlah surat masuk dari server
            $.ajax({
                url: '../data/get_data/getJumlahSuratMasuk.php', // Ganti dengan URL yang benar
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    var jumlahSuratMasuk = data.jumlah;
                    $('#jumlahSuratMasuk').text(jumlahSuratMasuk);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    $('#jumlahSuratMasuk').text('Error');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Mengambil data jumlah surat masuk dari server
            $.ajax({
                url: '../data/get_data/getJumlahSuratKeluar.php', // Ganti dengan URL yang benar
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    var jumlahSuratKeluar = data.jumlah;
                    $('#jumlahSuratKeluar').text(jumlahSuratKeluar);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    $('#jumlahSuratKEluar').text('Error');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var data_per_halaman = 5;
            var halaman_aktif = 1;
            var jumlah_data = 0;
            var data_surat = []; // Menyimpan data surat dari server

            function tampilkanData(halaman) {
                var data_awal = (halaman - 1) * data_per_halaman;
                var data_akhir = data_awal + data_per_halaman;
                var data_tampil = data_surat.slice(data_awal, data_akhir);

                var tableBody = $('#suratKeluarTable');
                tableBody.empty();

                if (data_tampil.length > 0) {
                    data_tampil.forEach(function (item) {
                        var row = '<tr>';
                        row += '<td>' + item.no_surat + '</td>';
                        row += '<td>' + item.nama_surat + '</td>';
                        row += '<td>' + item.instansi + '</td>';
                        row += '<td>' + item.no_agenda + '</td>';
                        row += '<td>' + item.tanggal_surat + '</td>';
                        row += '<td>' + item.tanggal_keluar + '</td>';
                        row += '<td>' + item.prihal + '</td>';
                        row += '<td>' + item.lampiran + '</td>';
                        row += '<td>' + item.sifat + '</td>';
                        row += '<td>' + item.title + '</td>';
                        row += '<td><a href="' + item.berkas + '" class="btn btn-primary" download>Download</a></td>';
                        row += '</tr>';
                        tableBody.append(row);
                    });
                } else {
                    tableBody.html('<tr><td colspan="9">Tidak ada surat Keluar hari ini.</td></tr>');
                }
            }

            function buatTombolHalaman() {
                var jumlah_halaman = Math.ceil(jumlah_data / data_per_halaman);
                var pagination = $('.pagination');
                pagination.empty();

                var prevBtn = $('<li class="page-item"><a class="page-link" href="#">Prev</a></li>');
                if (halaman_aktif === 1) {
                    prevBtn.addClass('disabled');
                } else {
                    prevBtn.click(function (e) {
                        e.preventDefault();
                        halaman_aktif--;
                        tampilkanData(halaman_aktif);
                        buatTombolHalaman();
                    });
                }
                pagination.append(prevBtn);

                var li = $('<li class="page-item"><a class="page-link" href="#">' + halaman_aktif + '</a></li>');
                li.addClass('active');
                pagination.append(li);

                var nextBtn = $('<li class="page-item"><a class="page-link" href="#">Next</a></li>');
                if (halaman_aktif === jumlah_halaman) {
                    nextBtn.addClass('disabled');
                } else {
                    nextBtn.click(function (e) {
                        e.preventDefault();
                        halaman_aktif++;
                        tampilkanData(halaman_aktif);
                        buatTombolHalaman();
                    });
                }
                pagination.append(nextBtn);
            }

            $.ajax({
                url: '../data/get_data/getDataKel.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    data_surat = data;
                    jumlah_data = data_surat.length;
                    tampilkanData(halaman_aktif);
                    buatTombolHalaman();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '../data/get_data/get_total_disposisi.php',
                method: 'GET',
                dataType: 'text',
                success: function (response) {
                    $('#julmahDisposisi').text(response);
                },
                error: function () {
                    $('#julmahDisposisi').text('Failed to fetch data');
                }
            });
        });
    </script>
</body>

</html>