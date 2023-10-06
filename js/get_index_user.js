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
                row += '<td>' + item.prihal + '</td>';
                row += '<td>' + item.lampiran + '</td>';
                row += '<td>' + item.sifat + '</td>';
                row += '<td>' + item.tanggal_masuk + '</td>';
                row += '<td>' + item.tanggal_diterima + '</td>';
                row += '<td>' + item.indexs + '</td>';
                row += '<td>' + (item.size / (1024 * 1024)).toFixed(2) + ' MB</td>';
                row += '<td>' + item.ekstensi + '</td>';
                row += '<td>' + item.title + '</td>';
                row += '<td><a href="' + item.berkas + '" class="btn btn-primary" download>Download</a></td>';
                row += '</tr>';
                tableBody.append(row);
            });
        } else {
            tableBody.html('<tr><td colspan="9">Tidak ada surat masuk hari ini.</td></tr>');
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
$.ajax({
    url: '../data/get_data/getJumlahSuratMasuk.php', // Ganti dengan URL yang benar
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        var jumlahSuratMasuk = data.jumlah;
        $('#jumlahSuratMasuk').text(jumlahSuratMasuk);
    },
    error: function(xhr, status, error) {
        console.error(error);
        $('#jumlahSuratMasuk').text('Error');
    }
});
$.ajax({
    url: '../data/get_data/getJumlahSuratKeluar.php', // Ganti dengan URL yang benar
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        var jumlahSuratKeluar = data.jumlah;
        $('#jumlahSuratKeluar').text(jumlahSuratKeluar);
    },
    error: function(xhr, status, error) {
        console.error(error);
        $('#jumlahSuratKEluar').text('Error');
    }
});
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
                row += '<td>' + item.tanggal_keluar + '</td>';
                row += '<td>' + item.indexs + '</td>';
                row += '<td>' + (item.size / (1024 * 1024)).toFixed(2) + ' MB</td>';
                row += '<td>' + item.ekstensi + '</td>';
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