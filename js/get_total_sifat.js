function getTotalSifat() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../data/get_data/get_total_sifat.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var totalSifat = response.totalSifat;
            document.getElementById("jumlahsifat").textContent = totalSifat;
        }
    };
    xhr.send();
}
