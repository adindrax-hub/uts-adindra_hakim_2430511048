<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $judul_buku = $_POST['judul_buku'];
    $nama_pengarang = $_POST['nama_pengarang'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $foto_lama = $_POST['foto_lama'];
    
    $foto_baru = $_FILES['foto_sampul']['name'];
    $tmp_name = $_FILES['foto_sampul']['tmp_name'];
    
    $nama_file_final = $foto_lama; // Default gunakan foto lama (jika edit tanpa ganti foto)

    // Jika ada file baru yang diunggah
    if ($foto_baru != "") {
        // Mengubah nama file secara otomatis dengan uniqid()
        $ekstensi = strtolower(pathinfo($foto_baru, PATHINFO_EXTENSION));
        $nama_file_final = uniqid() . '.' . $ekstensi;
        
        $direktori = 'uploads/' . $nama_file_final;
        
        // Pindahkan file ke folder uploads
        move_uploaded_file($tmp_name, $direktori);
        
        // Hapus foto lama jika ini adalah proses update
        if ($id != '' && $foto_lama != '' && file_exists('uploads/' . $foto_lama)) {
            unlink('uploads/' . $foto_lama);
        }
    }

    try {
        if ($id == '') {
            // PROSES TAMBAH DATA (INSERT)
            $stmt = $pdo->prepare("INSERT INTO buku (judul_buku, nama_pengarang, tahun_terbit, foto_sampul) VALUES (:judul, :pengarang, :tahun, :foto)");
            $stmt->execute([
                'judul' => $judul_buku,
                'pengarang' => $nama_pengarang,
                'tahun' => $tahun_terbit,
                'foto' => $nama_file_final
            ]);
            $pesan = "Data berhasil ditambahkan!";
        } else {
            // PROSES UBAH DATA (UPDATE)
            $stmt = $pdo->prepare("UPDATE buku SET judul_buku = :judul, nama_pengarang = :pengarang, tahun_terbit = :tahun, foto_sampul = :foto WHERE id = :id");
            $stmt->execute([
                'judul' => $judul_buku,
                'pengarang' => $nama_pengarang,
                'tahun' => $tahun_terbit,
                'foto' => $nama_file_final,
                'id' => $id
            ]);
            $pesan = "Data berhasil diperbarui!";
        }
        
        // Arahkan kembali ke index dengan pesan sukses
        header("Location: index.php?pesan=" . urlencode($pesan));
        exit();

    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>