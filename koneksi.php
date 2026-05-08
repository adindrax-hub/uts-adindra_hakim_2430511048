<?php
$host = "localhost";
$user = "root";       // Default user Laragon
$password = "";       // Default password Laragon kosong
$database = "db_proyek_buku";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    // Atur mode error PDO menjadi exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>