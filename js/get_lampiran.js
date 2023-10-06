$(document).ready(function() {
    // Populate lampiran dropdown
    $.ajax({
        url: '../../data/get_data/getDataLampiran.php', // Fetch data from this PHP file
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var dropdown = $('#lampiran');
            if (data.length > 0) {
                // Populate the dropdown options dynamically
                data.forEach(function(item) {
                    dropdown.append($('<option>', {
                        value: item.id,
                        text: item.lampiran // Use 'item.lampiran' to display the content of lampiran
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
            var dropdown = $('#lampiran');
            dropdown.append($('<option>', {
                value: '',
                text: 'Terjadi kesalahan saat mengambil data lampiran'
            }));
        }
    });

    // Populate sifat dropdown
    $.ajax({
        url: '../output/lampiran.php', 
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var options = '<option value="" disabled selected>Pilih Lampiran</option>';
            data.forEach(function(item) {
                options += '<option value="' + item.id + '">' + item.nama_lampiran + '</option>'; // Use 'item.nama_lampiran'
            });
            $('#lampiran').html(options);
        }
    });
});