$(document).ready(function() {
    $.ajax({
        url: '../../data/get_data/getDataSifat.php', // Fetch data from this PHP file
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var dropdown = $('#sifat');
            if (data.length > 0) {
                data.forEach(function(item) {
                    dropdown.append($('<option>', {
                        value: item.append,
                        text: item.sifat
                    }));
                });
            } else {
                dropdown.append($('<option>', {
                    value: '',
                    text: 'Tidak ada data Lampiran'
                }));
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Display an error message in case of failure
            var dropdown = $('#sifat');
            dropdown.append($('<option>', {
                value: '',
                text: 'Terjadi kesalahan saat mengambil data lampiran'
            }));
        }
    });

    // Populate sifat dropdown
    $.ajax({
        url: '../output/sifat.php', // Create sifat.php similarly
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var options = '<option value="" disabled selected>Pilih Sifat</option>';
            data.forEach(function(item) {
                options += '<option value="' + item.id + '">' + item.sifat + '</option>';
            });
            $('#sifat').html(options);
        }
    });
});