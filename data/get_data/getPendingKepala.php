<?php
                            $host = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "bpkad";

                            $conn = mysqli_connect($host, $username, $password, $dbname);

                            if (!$conn) {
                                die("Koneksi Database Gagal : " . mysqli_connect_error());
                            }

                            // Get search parameters
                            $selectedDate = isset($_GET['selected_date']) ? $_GET['selected_date'] : "";
                            $searchNoSurat = isset($_GET['search_no_surat']) ? $_GET['search_no_surat'] : "";

                            // Base SQL query
                            $sql = "SELECT d.*, k.tindakan
                    FROM tb_disposisinya d
                    JOIN tb_konfirmasi k ON d.no_surat = k.no_surat
                    WHERE k.tindakan = 'Ajukan ke Kepala BPKAD'
                    AND d.st = 0";

                            // Add conditions for search parameters
                            if (!empty($selectedDate)) {
                                $sql .= " AND d.tanggal_ajuan = '$selectedDate'";
                            }
                            if (!empty($searchNoSurat)) {
                                $sql .= " AND d.no_surat LIKE '%$searchNoSurat%'";
                            }

                            // Get total data
                            $total_data = mysqli_num_rows(mysqli_query($conn, $sql));

                            // Pagination settings
                            $data_per_page = 5;
                            $total_pages = ceil($total_data / $data_per_page);

                            // Get current page
                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                            // Determine starting limit
                            $starting_limit = ($current_page - 1) * $data_per_page;

                            // Append LIMIT to the SQL query
                            $sql .= " LIMIT $starting_limit, $data_per_page";

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
                                    echo '<td style="text-align: center;">';
                                    echo '<span class="badge badge-danger" style="border-radius: 50px; background-color: rgba(255, 0, 0, 0.7);">Perlu Konfirmasi</span>';
                                    echo '</td>'; // Kolom Status
                                    echo '<td>'; // Kolom Check
                                    echo '<a href="konfirmasi.php?' .
                                        'no_surat=' . urlencode($row["no_surat"]) . '&' .
                                        'nama_surat=' . urlencode($row["nama_surat"]) . '&' .
                                        'instansi=' . urlencode($row["instansi"]) . '&' .
                                        'no_agenda=' . urlencode($row["no_agenda"]) . '&' .
                                        'tanggal_surat=' . urlencode($row["tanggal_surat"]) . '&' .
                                        'tanggal_diterima=' . urlencode($row["tanggal_diterima"]) . '&' .
                                        'prihal=' . urlencode($row["prihal"]) . '&' .
                                        'lampiran=' . urlencode($row["lampiran"]) . '&' .
                                        'sifat=' . urlencode($row["sifat"]) . '&' .
                                        'berkas=' . urlencode($row["berkas"]) . '&' .
                                        'keterangan=' . urlencode($row["keterangan"]) . '&' .
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