function getTotalLampiran() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../data/get_data/get_total_lampiran.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var totalLampiran = response.totalLampiran;
            document.getElementById("jumlahlampiran").textContent = totalLampiran;
        }
    };
    xhr.send();
}
