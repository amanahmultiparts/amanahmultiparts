<?php
include '../config.php'; // Sesuaikan nama file dengan konfigurasi koneksi database Anda

// Query untuk mengambil data transaksi yang sudah selesai
$query = "SELECT idinvoice, waktu_selesai, id_user, id_iklan, jumlah, bank_manual, tipe_progress, harga_i
          FROM invoice
          WHERE tipe_progress = 'Selesai'"; // Sesuaikan dengan kondisi Anda

$result = mysqli_query($koneksi, $query);

// Fungsi untuk mengonversi tanggal MySQL menjadi format yang lebih mudah dibaca
function formatDate($date) {
    return date('d-m-Y H:i:s', strtotime($date));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Selesai</title>
</head>
<body>
    <h1>Laporan Transaksi Selesai</h1>
    <table border="1">
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
            echo "<td>" . $row['id_user'] . "</td>"; // Sesuaikan dengan kolom yang sesuai untuk nama pembeli
            echo "<td>" . $row['id_iklan'] . "</td>"; // Sesuaikan dengan kolom yang sesuai untuk nama produk
            echo "<td>" . $row['jumlah'] . "</td>";
            echo "<td>" . $row['bank_manual'] . "</td>"; // Sesuaikan dengan kolom yang sesuai untuk metode pembayaran
            echo "<td>" . $row['tipe_progress'] . "</td>";
            echo "<td>" . $row['harga_i'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($koneksi);
?>
