function cetakDisposisi() {
    var no_surat = "<?php echo $no_surat; ?>";
    var sifat = "<?php echo $sifat; ?>";
    var tgl_surat = "<?php echo $tanggal_surat; ?>";
    var instansi = "<?php echo $instansi; ?>";
    var tanggal_diterima = "<?php echo $tanggal_diterima; ?>";
    var tanggal_surat = "<?php echo $tanggal_surat; ?>";
    var catatan = "<?php echo $catatan; ?>";
    var no_agenda = "<?php echo $no_agenda; ?>";
    var prihal = "<?php echo $prihal; ?>";
    var tindak_lanjut = "<?php echo $tindak_lanjut; ?>";
    var jabatan = "<?php echo $jabatan; ?>";
    var bidang = "<?php echo $bidang; ?>";
    
    var url = "../cetak_disposisi.php" +
        "?no_surat=" + encodeURIComponent(no_surat) +
        "&sifat=" + encodeURIComponent(sifat) +
        "&tgl_surat=" + encodeURIComponent(tgl_surat) +
        "&instansi=" + encodeURIComponent(instansi) +
        "&tanggal_diterima=" + encodeURIComponent(tanggal_diterima) +
        "&tanggal_surat=" + encodeURIComponent(tanggal_surat) +
        "&no_agenda=" + encodeURIComponent(no_agenda) +
        "&prihal=" + encodeURIComponent(prihal) +
        "&tindak_lanjut=" + encodeURIComponent(tindak_lanjut) +
        "&jabatan=" + encodeURIComponent(jabatan) +
        "&bidang=" + encodeURIComponent(bidang) +
        "&catatan=" + encodeURIComponent(catatan);

    window.location.href = url;
}
