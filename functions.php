<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "penitipansnack");

// ambil data dari database
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;

    // Ambil data dari form
    $nama_snack = htmlspecialchars($data['nama_snack']);
    $kategori = htmlspecialchars($data['kategori']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);

    // Proses upload gambar
    $gambar = uploadGambar();
    if (!$gambar) {
        return 0; // Gagal upload
    }

    // Query tambah data
    $query = "INSERT INTO snack (`nama_snack`, `kategori`, `harga`, `stok`, `gambar`)
              VALUES ('$nama_snack', '$kategori', '$harga', '$stok', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadGambar()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah file adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg'];
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('File yang diunggah bukan gambar!');</script>";
        return false;
    }

    // Cek ukuran file (maksimal 2MB)
    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran file terlalu besar!');</script>";
        return false;
    }

    // Generate nama file baru
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($ID)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM snack WHERE ID = $ID");
    return mysqli_affected_rows($conn);
}

function tambahStok($namaSnack, $jumlah)
{
    global $conn;

    // Ambil stok saat ini dari database
    $result = mysqli_query($conn, "SELECT stok FROM snack WHERE `nama_snack` = '$namaSnack'");
    if ($row = mysqli_fetch_assoc($result)) {
        // Tambahkan jumlah ke stok saat ini
        $stokBaru = $row['stok'] + $jumlah;

        // Query untuk memperbarui stok
        $query = "UPDATE snack SET stok = $stokBaru WHERE `nama_snack` = '$namaSnack'";
        mysqli_query($conn, $query);

        // Cek apakah data berhasil diperbarui
        return mysqli_affected_rows($conn);
    } else {
        // Jika snack tidak ditemukan
        return -1;
    }
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $emial = mysqli_real_escape_string($conn, $data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert('Username sudah terdaftar!');
                window.location.href = 'login.php';
				</script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
				alert('Konfirmasi password tidak sesuai!');
				</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password', '$emial')");

    return mysqli_affected_rows($conn);
}
