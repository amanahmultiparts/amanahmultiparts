<?php
include '../../../config.php';

if (isset($_GET['idinvoice'])) {
    $idinvoiceprint = $_GET['idinvoice'];
} else {
    // Tampilkan pesan error atau redirect ke halaman lain jika idinvoice tidak tersedia
    exit("ID Invoice tidak tersedia.");
}

// Selanjutnya, sambungkan kode yang Anda miliki untuk mencetak nota sesuai dengan ID invoice.
// ...
?>
