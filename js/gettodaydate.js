function getTodayDate() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

// Tambahkan event listener untuk tombol "Hari Ini"
document.getElementById('btnToday_tglm').addEventListener('click', function() {
    document.getElementById('tglm').value = getTodayDate();
});

document.getElementById('btnToday_tgld').addEventListener('click', function() {
    document.getElementById('tgld').value = getTodayDate();
});