<?php
session_start();
$jabatan = $_SESSION['jabatan'];
$bidang = $_SESSION['bidang'];
$notificationMessage = isset($_GET['notification']) ? $_GET['notification'] : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pendding - Disposisi BPKAD </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../User/index_skre.php">
            <img src="../assets/img/bpkad1.png" alt="BPKAD Logo" style="max-width: 150px; height: auto;" />
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="" method="get">
            <div class="input-group">
                <input class="form-control" type="text" name="search_no_surat" placeholder="Cari No Surat" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                        <a class="nav-link" href="../User/index_skre.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="pending.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-inbox"></i></div>
                            Perlu Konfirmasi
                        </a>
                        <a class="nav-link" href="history.php">
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
            <main class="container mt-5">
            <div class="p-4">
                    <div class="card shadow ">
                        <div class="card-body">
                <?php
                if (!empty($notificationMessage)) {
                    echo '<div class="alert alert-success">' . htmlspecialchars($notificationMessage) . '</div>';
                }
                ?>

                <h1>Perlu Konfirmasi</h1>
                <div class="row justify-content-end mb-3">
                    <div class="col-md-4 col-lg-2">
                        <form class="form-inline" method="GET">
                            <div class="input-group">
                                <input class="form-control" type="date" name="selected_date" id="selected_date" placeholder="Select Date" aria-label="Select Date" />
                                <button class="btn btn-primary" id="btnFilter" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover  table-striped table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 10px">No</th>
                                <th style="width: 200px">No Surat</th>
                                <th style="width: 200px">Dari </th>
                                <th style="width: 200px">Bidang</th>
                                <th style="width: 200px">Tindak Lanjut</th>
                                <th style="width: 200px">tanggal Ajuan</th>
                                <th style="width: 120px">Status</th>
                                <th style="width: 120px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        <?php include '../data/get_data/getPendingSkre.php'; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination justify-content-left mt-3">
                    <ul class="pagination">
                        <?php
                        // Tombol Prev (Sebelumnya)
                        $prevPage = ($current_page > 1) ? $current_page - 1 : 1;
                        echo "<li class='page-item'><a class='page-link' href='?page=$prevPage'>Prev</a></li>";

                        // Tampilkan nomor halaman saat ini
                        echo "<li class='page-item active'><a class='page-link'>$current_page</a></li>";

                        // Tombol Next (Selanjutnya)
                        $nextPage = ($current_page < $total_pages) ? $current_page + 1 : $total_pages;
                        echo "<li class='page-item'><a class='page-link' href='?page=$nextPage'>Next</a></li>";
                        ?>
                    </ul>
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
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script>
        function refreshTable() {
            $.ajax({
                url: '../data/get_data/getPendingSkre.php',
                method: 'GET',
                success: function(response) {
                    $('#table-body').html(response); 
                }
            });
        }
        setInterval(refreshTable, 2000); 
    </script>
</body>

</html>