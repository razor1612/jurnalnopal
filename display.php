<?php
// Koneksi ke database (ganti nilainya sesuai dengan informasi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jurnal";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Ambil entri jurnal dari database
$sql = "SELECT entry_text FROM catatan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered table-striped">';
    echo '<thead class="thead-dark">';
    echo '<tr><th scope="col">No</th>';
    echo '<th scope="col">Tanggal</th>';
    echo '<th scope="col">Kategori</th>';
    echo '<th scope="col">Deskripsi</th>';
    echo '<th scope="col">Target</th>';
    echo '<th scope="col">Status</th>';
    echo '<th scope="col">Aksi</th>';
    echo '</tr>';


    $i = 1;
    // Output data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>' . $i++ . '</td><td>' . htmlspecialchars($row["entry_text"]) . '</td></tr>';
    }

    echo '</tbody></table>';
    echo '</div>';
} else {
    echo '<p class="text-muted">Belum ada jurnal yang tertulis</p>';
}

// Tutup koneksi
$conn->close();
?>