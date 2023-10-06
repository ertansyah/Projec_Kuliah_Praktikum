function getTotalBidang() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../data/get_data/get_total_bidang.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var totalBidang = response.totalBidang;
            document.getElementById("jumlahbidang").textContent = totalBidang;
        }
    };
    xhr.send();
}
