<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Ambil nama file foto dulu untuk dihapus dari folder
        $stmt_select = $pdo->prepare("SELECT foto_sampul FROM buku WHERE id = :id");
        $stmt_select->execute(['id' => $id]);
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $foto = $row['foto_sampul'];
            if ($foto != '' && file_exists('uploads/' . $foto)) {
                unlink('uploads/' . $foto); // Hapus file fisik
            }

            // Hapus data dari database
            $stmt_delete = $pdo->prepare("DELETE FROM buku WHERE id = :id");
            $stmt_delete->execute(['id' => $id]);

            header("Location: index.php?pesan=" . urlencode("Data berhasil dihapus!"));
            exit();
        }
    } catch(PDOException $e) {
        die("Error menghapus data: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
}
?>