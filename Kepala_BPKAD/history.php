<?php
session_start();
$jabatan = $_SESSION['jabatan'];
$bidang = $_SESSION['bidang'];
$notificationMessage = isset($_GET['notification']) ? $_GET['notification'] : "";
$kirimButtonClicked = isset($_GET['kirim']) && $_GET['kirim'] === 'true';

if (isset($_GET['action']) && $_GET['action'] === 'getTotalData') {
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bpkad";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        die("Koneksi Database Gagal : " . mysqli_connect_error());
    }

    // Mengambil jumlah data dari tabel tb_konfirmasi
    $total_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_kepala"));

    echo $total_data;

    mysqli_close($conn);
    exit;
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
    <title>History - Disposisi BPKAD </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../User/index_kepala.php">
            <img src="../assets/img/bpkad1.png" alt="BPKAD Logo" style="max-width: 150px; height: auto;" />
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="" method="get">
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
                        <a class="nav-link" href="../User/index_kepala.php">
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
                                <th style="width: 200px">tanggal Ajuan</th>
                                <th style="width: 120px">Status</th>
                                <th style="width: 120px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $host = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "bpkad";

                            $conn = mysqli_connect($host, $username, $password, $dbname);

                            if (!$conn) {
                                die("Koneksi Database Gagal : " . mysqli_connect_error());
                            }

                            // Define data per page
                            $data_per_page = 5;

                            // Calculate the starting limit for pagination
                            if (isset($_GET['page'])) {
                                $current_page = $_GET['page'];
                            } else {
                                $current_page = 1;
                            }
                            $starting_limit = ($current_page - 1) * $data_per_page;

                            // Define the base SQL query
                            $baseSql = "SELECT * FROM tb_kepala";

                            // Initialize search conditions
                            $searchConditions = [];

                            // Check for search parameters and add them to the conditions array
                            if (isset($_GET['search_no_surat'])) {
                                $search_no_surat = $_GET['search_no_surat'];
                                $searchConditions[] = "no_surat LIKE '%$search_no_surat%'";
                            }

                            if (isset($_GET['selected_date'])) {
                                $selected_date = $_GET['selected_date'];
                                $searchConditions[] = "tanggal_ajuan = '$selected_date'";
                            }

                            // Add search conditions to the base SQL query if needed
                            if (!empty($searchConditions)) {
                                $sql = $baseSql . " WHERE " . implode(" AND ", $searchConditions);
                            } else {
                                $sql = $baseSql;
                            }

                            // Get the total number of data based on search conditions
                            $total_data = mysqli_num_rows(mysqli_query($conn, $sql));

                            // Calculate total pages
                            $total_pages = ceil($total_data / $data_per_page);

                            // Add pagination to the SQL query
                            $sql .= " LIMIT $starting_limit, $data_per_page";

                            // Execute the SQL query
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $no = $starting_limit + 1; // Inisialisasi nomor urut
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $no . "</td>";
                                    echo "<td>" . $row["no_surat"] . "</td>";
                                    echo "<td>" . $row["bidang"] . "</td>";
                                    echo "<td>" . $row["tanggal_ajuan"] . "</td>";
                                    echo '<td style="text-align: center;">';
                                    if ($row["tindakan"] == "Disetujui") {
                                        echo '<span class="badge badge-success" style="border-radius: 50px; font-size: 16px;">Disetujui</span>';
                                    } elseif ($row["tindakan"] == "Ditolak") {
                                        echo '<span class="badge badge-danger" style="border-radius: 50px; font-size: 16px;">Ditolak</span>';
                                    }
                                    echo '</td>'; // Ko
                                    echo '<td>'; // Kolom Check
                                    echo '<a href="lihat_history.php?' .
                                        'no_surat=' . urlencode($row["no_surat"]) . '&' .
                                        'instansi=' . urlencode($row["instansi"]) . '&' .
                                        'no_agenda=' . urlencode($row["no_agenda"]) . '&' .
                                        'tanggal_surat=' . urlencode($row["tanggal_surat"]) . '&' .
                                        'tanggal_diterima=' . urlencode($row["tanggal_diterima"]) . '&' .
                                        'prihal=' . urlencode($row["prihal"]) . '&' .
                                        'lampiran=' . urlencode($row["lampiran"]) . '&' .
                                        'sifat=' . urlencode($row["sifat"]) . '&' .
                                        'berkas=' . urlencode($row["berkas"]) . '&' .
                                        'keterangan=' . urlencode($row["keterangan"]) . '&' .
                                        'catatan=' . urlencode($row["catatan"]) . '&' .
                                        'tindakan=' . urlencode($row["tindakan"]) . '&' .
                                        'tanggal_ajuan=' . urlencode($row["tanggal_ajuan"]) . '&' .
                                        'tindak_lanjut=' . urlencode($row["tindak_lanjut"]) . '"' .
                                        ' class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View">' .
                                        '<i class="fas fa-eye"></i> Check' .
                                        '</a>';
                                    echo '</td>';
                                    echo "</tr>";
                                    $no++;
                                }
                            } else {
                                echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                            }

                            mysqli_close($conn);
                            ?>
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
</body>

</html>