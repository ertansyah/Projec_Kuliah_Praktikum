$(document).ready(function() {
    $.ajax({
        url: '../data/get_data/get_total_konfir_kepala.php', // Sesuaikan dengan path yang benar
        type: 'GET',
        dataType: 'html',
        success: function(response) {
            // Mencari elemen <tbody> dalam tabel
            var tbody = $(response).find('tbody');
            
            // Menghitung jumlah baris dalam elemen <tbody>
            var jumlahData = tbody.find('tr').length;
            
            // Memasukkan jumlah data ke dalam elemen teks loading
            $('#jumlahKonfirmasi').text(jumlahData);
        },
        error: function() {
            $('#jumlahKonfirmasi').text('Error loading data');
        }
    });
});