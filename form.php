<?php
include 'koneksi.php';

$id = ''; $judul = ''; $pengarang = ''; $tahun = ''; $foto = '';
$judul_form = 'Tambah Data Buku';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $judul = $data['judul_buku'];
        $pengarang = $data['nama_pengarang'];
        $tahun = $data['tahun_terbit'];
        $foto = $data['foto_sampul'];
        $judul_form = 'Edit Data Buku';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul_form; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container" style="max-width: 600px;"> <h2><?= $judul_form; ?></h2>

        <form action="proses.php" method="POST" enctype="multipart/form-data" onsubmit="return validasiForm()">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
            <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($foto); ?>">

            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" id="judul_buku" name="judul_buku" value="<?= htmlspecialchars($judul); ?>" placeholder="Masukkan judul buku...">
            </div>

            <div class="form-group">
                <label>Nama Pengarang</label>
                <input type="text" id="nama_pengarang" name="nama_pengarang" value="<?= htmlspecialchars($pengarang); ?>" placeholder="Masukkan nama pengarang...">
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" id="tahun_terbit" name="tahun_terbit" value="<?= htmlspecialchars($tahun); ?>" placeholder="Contoh: 2023">
            </div>

            <div class="form-group">
                <label>Foto Sampul (Maks 2MB, JPG/PNG)</label>
                <input type="file" id="foto_sampul" name="foto_sampul" accept=".jpg, .jpeg, .png">
                <?php if($foto != ''): ?>
                    <span class="keterangan-foto">*Biarkan kosong jika tidak ingin mengganti foto saat ini.</span>
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-tambah" style="margin-bottom: 0;">Simpan Data</button>
                <a href="index.php" class="btn btn-batal">Batal</a>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>