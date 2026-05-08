<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h2>Data Buku Perpustakaan</h2>
        
        <?php if(isset($_GET['pesan'])): ?>
            <div class="pesan"><?= htmlspecialchars($_GET['pesan']); ?></div>
        <?php endif; ?>

        <a href="form.php" class="btn btn-tambah">+ Tambah Data Buku</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sampul</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Tahun Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM buku ORDER BY id DESC");
                $no = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><img src="uploads/<?= htmlspecialchars($row['foto_sampul']); ?>" class="thumbnail" alt="Sampul"></td>
                    <td><strong><?= htmlspecialchars($row['judul_buku']); ?></strong></td>
                    <td><?= htmlspecialchars($row['nama_pengarang']); ?></td>
                    <td><?= htmlspecialchars($row['tahun_terbit']); ?></td>
                    <td>
                        <a href="form.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-hapus" onclick="return konfirmasiHapus();">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="script.js"></script>
</body>
</html>