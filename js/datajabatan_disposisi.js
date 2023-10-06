$(document).ready(function() {
    $.ajax({
        url: 'data/get_data/getDataJabatan.php', 
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var jabatanDropdown = $('#editJabatan');
            var jabatanFormDropdown = $('#jabatan'); // Select the jabatan dropdown in the form
            if (data.length > 0) {
                
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
    $('#jabatan').on('change', function() {
        var selectedJabatan = $(this).val();
        var bidangDropdown = $('#bidang');

        if (selectedJabatan === 'Sekretaris') {
            bidangDropdown.prop('disabled', true); // Nonaktifkan dropdown "Bidang"
            bidangDropdown.val(''); // Reset nilai dropdown "Bidang"
        } else {
            bidangDropdown.prop('disabled', false); // Aktifkan dropdown "Bidang"
        }
    });
});