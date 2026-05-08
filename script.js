// Fungsi untuk validasi form sebelum data dikirim ke server
function validasiForm() {
  let judul = document.getElementById("judul_buku").value;
  let pengarang = document.getElementById("nama_pengarang").value;
  let tahun = document.getElementById("tahun_terbit").value;
  let fotoInput = document.getElementById("foto_sampul");
  let id = document.getElementsByName("id")[0].value;

  // 1. Validasi field teks kosong
  if (judul.trim() === "" || pengarang.trim() === "" || tahun.trim() === "") {
    alert("Gagal: Semua kolom teks harus diisi!");
    return false;
  }

  // 2. Validasi File Upload
  if (fotoInput.files.length > 0) {
    let file = fotoInput.files[0];

    // Cek ukuran (< 2MB)
    let maxSize = 2 * 1024 * 1024; // 2MB
    if (file.size > maxSize) {
      alert("Gagal: Ukuran foto tidak boleh lebih dari 2 MB!");
      return false;
    }

    // Cek ekstensi (hanya menerima gambar)
    let tipeFile = file.type;
    if (
      tipeFile !== "image/jpeg" &&
      tipeFile !== "image/png" &&
      tipeFile !== "image/jpg"
    ) {
      alert("Gagal: Format foto harus JPG, JPEG, atau PNG!");
      return false;
    }
  } else {
    // Jika form tambah data (ID kosong) dan foto tidak diunggah
    if (id === "") {
      alert("Gagal: Foto sampul wajib diunggah untuk data baru!");
      return false;
    }
  }

  return true; // Jika semua lolos, form akan dikirim (submit)
}

// Fungsi konfirmasi sebelum menghapus data
function konfirmasiHapus() {
  return confirm(
    "Apakah Anda yakin ingin menghapus buku ini? Data yang dihapus tidak dapat dikembalikan.",
  );
}
