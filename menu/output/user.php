<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}
session_start();
$jabatan = $_SESSION['jabatan'] ?? 'Tidak Diketahui';
$bidang = $_SESSION['bidang'] ?? 'Tidak Diketahui';

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
    <title>Data User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../../admin/index.php">
            <img src="../../assets/img/bpkad1.png" alt="BPKAD Logo" style="max-width: 150px; height: auto;" />
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="" method="post">
            <div class="input-group">
                <input class="form-control" type="text" name="cari_user" placeholder="Cari user" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
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
                        <div class="sb-sidenav-menu-heading">Utama</div>
                        <a class="nav-link" href="../../admin/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                            Tambah user
                        </a>
                        <a class="nav-link" href="jabatan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-address-card "></i></div>
                            Tambah Jabatan
                        </a>
                        <a class="nav-link" href="bidang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
                            Tambah Bidang
                        </a>
                        <a class="nav-link" href="lampiran.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-paperclip"></i></div>
                            Tambah Lampiran
                        </a>
                        <a class="nav-link" href="sifat.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-certificate"></i></div>
                            Tambah Sifat
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
                if (isset($_GET['notification']) && isset($_GET['notificationType'])) {
                    $notificationMessage = $_GET['notification'];
                    $notificationType = $_GET['notificationType'];
                    echo '<div class="alert alert-' . $notificationType . '">' . htmlspecialchars($notificationMessage) . '</div>';
                }
                ?>
                <h1>Data User</h1>
                <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahModal">Tambah Data User</a>


                <!-- Tabel Data User -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover  table-striped table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                
                                <th>Jabatan</th>
                                <th>Bidang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Kode untuk mengambil data user dari database
                            $sql = "SELECT * FROM user";

                            // Proses pencarian jika ada input pencarian
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $searchTerm = $_POST["cari_user"];
                                $sql = "SELECT * FROM user WHERE nama LIKE '%$searchTerm%' OR nip LIKE '%$searchTerm%'";
                            }

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $no = 1;
                                $records_per_page = 5;
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $start = ($current_page - 1) * $records_per_page;
                                $end = $start + $records_per_page;

                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($no > $end) {
                                        break;
                                    }
                                    if ($no > $start) {
                                        echo "<tr>";
                                        echo "<td>" . $no . "</td>";
                                        echo "<td>" . $row['nip'] . "</td>";
                                        echo "<td>" . $row['nama'] . "</td>";
                                        echo "<td>" . $row['no_tlp'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        
                                        echo "<td>" . $row['jabatan'] . "</td>";
                                        echo "<td>" . $row['bidang'] . "</td>";
                                        echo '<td>
                <button class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editModal" 
                        data-nip="' . $row['nip'] . '" data-nama="' . $row['nama'] . '" 
                        data-no_tlp="' . $row['no_tlp'] . '" data-jabatan="' . $row['jabatan'] . '"
                        data-bidang="' . $row['bidang'] . '">Edit</button>
                <a class="btn btn-danger" href="../../data/hapus_data/hapus_data_user.php?nip=' . $row['nip'] . '">Hapus</a>
            </td>';
                                        echo "</tr>";
                                    }
                                    $no++;
                                }
                            } else {
                                echo "<tr><td colspan='7'>Tidak ada data user.</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <!-- Tombol Pagination -->
                <div class="pagination justify-content-left mt-3">
                    <ul class="pagination">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            $total_pages = ceil(mysqli_num_rows($result) / $records_per_page);

                            // Tombol Prev (Sebelumnya)
                            $prevPage = ($current_page > 1) ? $current_page - 1 : 1;
                            echo "<li class='page-item'><a class='page-link' href='?page=$prevPage'>Prev</a></li>";

                            // Tampilkan nomor halaman saat ini
                            echo "<li class='page-item active'><a class='page-link'>$current_page</a></li>";

                            // Tombol Next (Selanjutnya)
                            $nextPage = ($current_page < $total_pages) ? $current_page + 1 : $total_pages;
                            echo "<li class='page-item'><a class='page-link' href='?page=$nextPage'>Next</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Data User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" action="../../data/edit_data/update_data_user.php" method="post">
                                    <div class="form-group">
                                        <label for="editnip">NIP</label>
                                        <input type="text" class="form-control" id="editnip" name="editnip" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="editNama">Nama</label>
                                        <input type="text" class="form-control" id="editNama" name="editNama">
                                    </div>
                                    <div class="form-group">
                                        <label for="editNoTlp">No Telepon</label>
                                        <input type="text" class="form-control" id="editNoTlp" name="editNoTlp">
                                    </div>
                                    <div class="form-group">
                                        <label for="editJabatan">Jabatan</label>
                                        <select class="form-control" id="editJabatan" name="editJabatan"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="editBidang">Bidang</label>
                                        <select class="form-control" id="editBidang" name="editBidang"></select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
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
                                <!-- Isi slide content di sini -->
                                <iframe width="800" height="450" src="https://www.youtube.com/embed/7MYyVzf6KuE" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            mysqli_close($conn);
            ?>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Arsip BPKAD 2023</div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Modal Tambah Data User -->
        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="tambahForm" action="../../data/simpan_data/simpan_data_user.php" method="post">
                                        <!-- Kolom kiri -->
                                        <div class="form-group">
                                            <label for="nip"><i class="fas fa-id-card"></i> NIP</label>
                                            <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama"><i class="fas fa-user"></i> Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bidang" class="form-label"><i class="fas fa-suitcase"></i> Bidang</label>
                                            <select class="form-select" id="bidang" name="bidang">
                                                <option value="" disabled selected>Pilih Bidang</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Kolom kanan -->
                                    <div class="form-group">
                                        <label for="pass"><i class="fas fa-lock"></i> Password</label>
                                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Masukkan Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_tlp"><i class="fas fa-phone"></i> No Telepon</label>
                                        <input type="text" class="form-control" id="no_tlp" name="no_tlp" pattern="[0-9]+" placeholder="Masukkan No Telepon" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan" class="form-label"><i class="fas fa-briefcase"></i> Jabatan</label>
                                        <select class="form-select" id="jabatan" name="jabatan">
                                            <option value="" disabled selected>Pilih jabatan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Tambah User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../../data/get_data/getDataJabatan.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var jabatanDropdown = $('#editJabatan');
                    var jabatanFormDropdown = $('#jabatan'); // Select the jabatan dropdown in the form
                    if (data.length > 0) {
                        // Populate the jabatan dropdown options dynamically
                        data.forEach(function(item) {
                            jabatanDropdown.append($('<option>', {
                                value: item.id_jabatan,
                                text: item.nama_jabatan
                            }));

                            // Also populate the jabatan dropdown in the form
                            jabatanFormDropdown.append($('<option>', {
                                value: item.id_jabatan,
                                text: item.nama_jabatan
                            }));
                        });
                    } else {
                        jabatanDropdown.append($('<option>', {
                            value: '',
                            text: 'Tidak ada data jabatan'
                        }));
                        jabatanFormDropdown.append($('<option>', {
                            value: '',
                            text: 'Tidak ada data jabatan'
                        }));
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Display an error message in case of failure
                    var jabatanDropdown = $('#editJabatan');
                    var jabatanFormDropdown = $('#jabatan'); // Select the jabatan dropdown in the form
                    jabatanDropdown.append($('<option>', {
                        value: '',
                        text: 'Terjadi kesalahan saat mengambil data jabatan'
                    }));
                    jabatanFormDropdown.append($('<option>', {
                        value: '',
                        text: 'Terjadi kesalahan saat mengambil data jabatan'
                    }));
                }
            });

            // Fetch data for bidang dropdown options using AJAX
            $.ajax({
                url: '../../data/get_data/getDataBidang.php', // Change this URL to the appropriate PHP file
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var bidangDropdown = $('#editBidang');
                    var bidangFormDropdown = $('#bidang'); // Select the bidang dropdown in the form
                    if (data.length > 0) {
                        // Populate the bidang dropdown options dynamically
                        data.forEach(function(item) {
                            bidangDropdown.append($('<option>', {
                                value: item.id_bidang,
                                text: item.nama_bidang
                            }));

                            // Also populate the bidang dropdown in the form
                            bidangFormDropdown.append($('<option>', {
                                value: item.id_bidang,
                                text: item.nama_bidang
                            }));
                        });
                    } else {
                        bidangDropdown.append($('<option>', {
                            value: '',
                            text: 'Tidak ada data bidang'
                        }));
                        bidangFormDropdown.append($('<option>', {
                            value: '',
                            text: 'Tidak ada data bidang'
                        }));
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Display an error message in case of failure
                    var bidangDropdown = $('#editBidang');
                    var bidangFormDropdown = $('#bidang'); // Select the bidang dropdown in the form
                    bidangDropdown.append($('<option>', {
                        value: '',
                        text: 'Terjadi kesalahan saat mengambil data bidang'
                    }));
                    bidangFormDropdown.append($('<option>', {
                        value: '',
                        text: 'Terjadi kesalahan saat mengambil data bidang'
                    }));
                }
            });

        });
        $(document).on("click", ".edit-btn", function() {
            var nip = $(this).data("nip");
            var nama = $(this).data("nama");
            var noTlp = $(this).data("no_tlp");
            var jabatan = $(this).data("jabatan");
            var bidang = $(this).data("bidang");

            console.log(nip, nama, noTlp, jabatan, bidang); // Cek nilai di konsol

            $("#editnip").val(nip);
            $("#editNama").val(nama);
            $("#editNoTlp").val(noTlp);
            $("#editJabatan").val(jabatan);
            $("#editBidang").val(bidang);
        });
        $(".btn-danger").on("click", function(event) {
            if (!confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                event.preventDefault(); // Mencegah aksi default tombol jika konfirmasi ditolak
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../js/scripts.js"></script>
    
</body>

</html>