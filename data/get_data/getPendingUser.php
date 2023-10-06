<?php
                            $host = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "bpkad";

                            $conn = mysqli_connect($host, $username, $password, $dbname);

                            if (!$conn) {
                                die("Koneksi Database Gagal : " . mysqli_connect_error());
                            }

                            // Pagination setup
                            $total_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_disposisinya"));
                            $data_per_page = 5;
                            $total_pages = ceil($total_data / $data_per_page);

                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $starting_limit = ($current_page - 1) * $data_per_page;

                            // Filter data based on selected date or search_no_surat
                            if (isset($_GET['selected_date']) && !empty($_GET['selected_date'])) {
                                $selectedDate = $_GET['selected_date'];
                                $formattedDate = mysqli_real_escape_string($conn, $selectedDate);

                                $sql = "SELECT d.*, k.tindakan, k.catatan, ke.tindakan
                                    FROM tb_disposisinya d 
                                    LEFT JOIN tb_konfirmasi k ON d.no_surat = k.no_surat
                                    LEFT JOIN tb_kepala ke ON d.no_surat = ke.no_surat
                                    WHERE DATE(d.tanggal_ajuan) = '$formattedDate'
                                    LIMIT $starting_limit, $data_per_page";
                            } elseif (isset($_GET['search_no_surat']) && !empty($_GET['search_no_surat'])) {
                                $searchNoSurat = $_GET['search_no_surat'];
                                $escapedSearchNoSurat = mysqli_real_escape_string($conn, $searchNoSurat);

                                $sql = "SELECT d.*, k.tindakan, k.catatan, ke.tindakan
                                    FROM tb_disposisinya d 
                                    LEFT JOIN tb_konfirmasi k ON d.no_surat = k.no_surat
                                    LEFT JOIN tb_kepala ke ON d.no_surat = ke.no_surat
                                    WHERE d.no_surat LIKE '%$escapedSearchNoSurat%'
                                    LIMIT $starting_limit, $data_per_page";
                            } else {
                                $sql = "SELECT d.*, k.tindakan, k.catatan, ke.tindakan
                                    FROM tb_disposisinya d 
                                    LEFT JOIN tb_konfirmasi k ON d.no_surat = k.no_surat
                                    LEFT JOIN tb_kepala ke ON d.no_surat = ke.no_surat
                                    LIMIT $starting_limit, $data_per_page";
                            }

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $no = $starting_limit + 1; // Inisialisasi nomor urut
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $no . "</td>";
                                    echo "<td>" . $row["no_surat"] . "</td>";
                                    echo "<td>" . $row["jabatan"] . "</td>";
                                    echo "<td>" . $row["bidang"] . "</td>";
                                    echo "<td>" . $row["tindak_lanjut"] . "</td>";
                                    echo "<td>" . $row["tanggal_ajuan"] . "</td>";
                                    echo '<td style="text-align: center;">'; // Tengahkan konten
                                    if ($row["tindakan"] == "Ditolak") {
                                        echo '<span class="badge badge-danger" style="border-radius: 50px; font-size: 16px; display: inline-block; width: 80px; text-align: center;">Ditolak</span>';
                                    } elseif ($row["tindakan"] == "Ajukan ke Kepala BPKAD") {
                                        echo '<span class="badge badge-primary" style="border-radius: 50px; font-size: 16px; display: inline-block; width: 80px; text-align: center;">Pending</span>';
                                    } elseif ($row["tindakan"] == "Disetujui") {
                                        echo '<span class="badge badge-success" style="border-radius: 50px; font-size: 16px; display: inline-block; width: 80px; text-align: center;">Disetujui</span>';
                                    } elseif (empty($row["tindakan"])) {
                                        echo '<span class="badge badge-primary" style="border-radius: 50px; font-size: 16px; display: inline-block; width: 80px; text-align: center;">Pending</span>';
                                    } else {
                                        // Jika tindakan tidak sesuai dengan kondisi di atas
                                        echo '<span class="badge badge-primary" style="border-radius: 50px; font-size: 16px; display: inline-block; width: 80px; text-align: center;">Pending</span>';
                                    }
                                    echo '</td>';
                                    echo '<td style="text-align: center;">'; // Tengahkan konten

                                    // Tambahkan tombol Check dengan link ke halaman yang sesuai (ganti 'tb_konfirmasi' dengan link yang sesuai)
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