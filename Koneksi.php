<?php 

function koneksiDB() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "bpkad";

    $conn = mysqli_connect($host, $username, $password, $db);

    if(!$conn) {
        die("Koneksi Database Gagal : " .mysqli_connect_error());
    } else {
        return $conn;
    }
}

function selectAllData() {
    $query = "SELECT * FROM tb_tsm";
    $result = mysqli_query(koneksiDB(), $query);
    return $result;
}

function insertData($data) {
    // Menghindari SQL injection dengan menggunakan prepared statement
    $query = "INSERT INTO tb_tsm (no_surat, nama_surat, no_agenda, prihal, sifat, instansi, lampiran, tanggal_surat, tanggal_diterima, idUser, title, size, ekstensi, berkas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $conn = koneksiDB();

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die("Error in preparing statement: " . mysqli_error($conn));
    }

    // Binding parameter
    mysqli_stmt_bind_param($stmt, "ssssssssssssss", $data['no_surat'], $data['nama_surat'], $data['no_agenda'], $data['prihal'], $data['sifat'], $data['instansi'], $data['lampiran'], $data['tanggal_surat'], $data['tanggal_diterima'], $data['idUser'], $data['title'], $data['size'], $data['ekstensi'], $data['berkas']);

    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    if (!$result) {
        return 0;
    } else {
        return 1;
    }
}

function updateData($id_tsm, $no_surat, $nama_surat, $no_agenda, $prihal, $sifat, $instansi, $lampiran, $tanggal_surat, $tanggal_diterima, $idUser) {
    $query = "UPDATE tb_tsm SET no_surat = ?, nama_surat = ?, no_agenda = ?, prihal = ?, sifat = ?, instansi = ?, lampiran = ?, tanggal_surat = ?, tanggal_diterima = ?, idUser = ? WHERE id_tsm = ?";
    $conn = koneksiDB();

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die("Error in preparing statement: " . mysqli_error($conn));
    }

    // Binding parameter
    mysqli_stmt_bind_param($stmt, "ssssssssssi", $no_surat, $nama_surat, $no_agenda, $prihal, $sifat, $instansi, $lampiran, $tanggal_surat, $tanggal_diterima, $idUser, $id_tsm);

    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    if (!$result) {
        return false;
    } else {
        return true;
    }
}
