<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';
    // Query untuk mengambil data transaksi yang sudah selesai dalam rentang tanggal yang dipilih
    $query = "SELECT invoice.idinvoice, invoice.waktu_selesai, akun.nama_lengkap, iklan.judul, invoice.jumlah, invoice.bank_manual, invoice.tipe_progress, invoice.harga_i
              FROM invoice
              INNER JOIN akun ON invoice.id_user = akun.id
              INNER JOIN iklan ON invoice.id_iklan = iklan.id
              WHERE tipe_progress = 'Selesai'
              AND DATE(invoice.waktu_selesai) BETWEEN '$startDate' AND '$endDate'";

    $result = mysqli_query($server, $query);
} else {
    // Default query jika belum ada filter tanggal
    $query = "SELECT invoice.idinvoice, invoice.waktu_selesai, akun.nama_lengkap, iklan.judul, invoice.jumlah, invoice.bank_manual, invoice.tipe_progress, invoice.harga_i
              FROM invoice
              INNER JOIN akun ON invoice.id_user = akun.id
              INNER JOIN iklan ON invoice.id_iklan = iklan.id
              WHERE tipe_progress = 'Selesai'";

    $result = mysqli_query($server, $query);
}

// Fungsi untuk mengonversi tanggal MySQL menjadi format yang lebih mudah dibaca
function formatDate($date) {
    return date('d-m-Y H:i:s', strtotime($date));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DATA TRANSAKSI PENJUALAN</title>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="date"] {
            padding: 8px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .print-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
</head>
<body>
    <h1>DATA TRANSAKSI PENJUALAN</h1>
    
    <form method="post">
    <?php
    // Tampilkan periode tanggal jika telah diinput
    if (!empty($startDate) && !empty($endDate)) {
        echo "<p>Dari tanggal " . $startDate . " hingga tanggal " . $endDate . "</p>";
    }
    ?>
    <label for="start_date">Dari Tanggal:</label>
    <input type="date" id="start_date" name="start_date">
    
    <label for="end_date">Hingga Tanggal:</label>
    <input type="date" id="end_date" name="end_date">
    
    <input type="submit" name="submit" value="Tampilkan">
    <a href="cetak.php?dari=<?php echo $startDate; ?>&sampai=<?php echo $endDate; ?>" class="print-button">Cetak Laporan</a>
</form>

<!-- Perbarui tag <a> untuk tombol "Cetak Laporan" -->



    </form>


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

    <script>
        function printReport() {
            window.print(); // Membuka dialog cetak saat tombol ditekan
        }
    </script>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($server);
?>
