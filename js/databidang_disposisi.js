$(document).ready(function() {
    // Mengisi data bidang menggunakan AJAX
    $.getJSON("data/get_data/getDataBidang.php", function(data) {
        var bidangDropdown = $('#bidang');
        if (data.length > 0) {
            data.forEach(function(item) {
                // Tambahkan opsi hanya jika nama bidang bukan "Admin"
                if (item.nama_bidang !== 'Admin' && item.nama_bidang !== 'admin' && item.nama_bidang !== 'Kepala BPKAD' && item.nama_bidang !== 'Sekretaris Kepala') {
                    bidangDropdown.append($('<option>', {
                        value: item.id_bidang, // Ganti dengan kolom yang sesuai di tabel bidang
                        text: item.nama_bidang // Ganti dengan kolom yang sesuai di tabel bidang
                    }));
                }
            });
        } else {
            bidangDropdown.append($('<option>', {
                value: '',
                text: 'Tidak ada data bidang'
            }));
        }
    });
    
});