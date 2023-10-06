function getTotalUsers() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../data/get_data/get_total_users.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var totalUsers = response.totalUsers;
            document.getElementById("jumlahuser").textContent = totalUsers;
        }
    };
    xhr.send();
}
