<?php
include 'config.php';

// Ambil data tanggal dari URL
$startDate = isset($_GET['dari']) ? $_GET['dari'] : '';
$endDate = isset($_GET['sampai']) ? $_GET['sampai'] : '';

// Query untuk mengambil data transaksi yang sudah selesai dalam rentang tanggal yang dipilih
$query = "SELECT invoice.idinvoice, invoice.waktu_selesai, akun.nama_lengkap, iklan.judul, invoice.jumlah, invoice.bank_manual, invoice.tipe_progress, invoice.harga_i
          FROM invoice
          INNER JOIN akun ON invoice.id_user = akun.id
          INNER JOIN iklan ON invoice.id_iklan = iklan.id
          WHERE tipe_progress = 'Selesai'
          AND DATE(invoice.waktu_selesai) BETWEEN '$startDate' AND '$endDate'";

$result = mysqli_query($server, $query);

// Fungsi untuk mengonversi tanggal MySQL menjadi format yang lebih mudah dibaca
function formatDate($date) {
    return date('d-m-Y H:i:s', strtotime($date));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Transaksi Selesai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Gaya untuk baris total */
        .total-row {
            font-weight: bold;
        }

        /* Gaya untuk Diketahui Oleh dan garis tanda tangan */
        .signature {
            margin-top: 20px;
        }

        .signature p {
            text-align: center;
        }

        .signature .line {
            width: 200px;
            margin: 0 auto;
            border-top: 1px solid #000;
        }
    </style>
</head>
<body>
    <h1>DATA TRANSAKSI PENJUALAN</h1>
    <?php
    // Tampilkan periode tanggal jika telah diinput
    if (!empty($startDate) && !empty($endDate)) {
        echo "<p>Dari tanggal " . $startDate . " / Sampai tanggal " . $endDate . "</p>";
    }
    ?>
    <table>
        <tr>
            <th>No. Pesanan</th>
            <th>Tanggal Selesai</th>
            <th>Nama Pembeli</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Metode Pembayaran</th>
            <th>Status</th>
            <th>Total Pembayaran</th>
        </tr>
        <?php
        // Tampilkan data transaksi dalam tabel
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['idinvoice'] . "</td>";
            echo "<td>" . formatDate($row['waktu_selesai']) . "</td>";
            echo "<td>" . $row['nama_lengkap'] . "</td>"; // Menggunakan kolom nama_lengkap dari tabel akun
            echo "<td>" . $row['judul'] . "</td>"; // Menggunakan kolom judul dari tabel iklan
            echo "<td>" . $row['jumlah'] . "</td>";
            echo "<td>" . $row['bank_manual'] . "</td>";
            echo "<td>" . $row['tipe_progress'] . "</td>";
            echo "<td>" . $row['harga_i'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <br>
    <div class="signature">
        <p>Diketahui Oleh:</p>
        <br>
        <br>
        <br>
        <br>
        <div class="line"></div>
    </div>
    <script>
        // Membuka dialog cetak saat halaman dimuat
        window.onload = function () {
            window.print();
        }
    </script>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($server);
?>
