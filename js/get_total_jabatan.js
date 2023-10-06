function getTotalJabatan() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../data/get_data/get_total_jabatan.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var totalJabatan = response.totalJabatan;
            document.getElementById("jumlahjabatan").textContent = totalJabatan;
        }
    };
    xhr.send();
}
