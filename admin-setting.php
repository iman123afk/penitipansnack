<?php session_start();

if (!isset($_SESSION["Login"])) {
    header("Location: Login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Snack</title>
    <link rel="stylesheet" href="css/admin-styles.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">Admin</div>
        <div class="profile-pic"></div>
        <div class="username">Username</div>
        <ul class="menu">
            <li><a href="admin-dashboard.php">Dashboard</a></li>
            <li><a href="admin-snack.php">Snack</a></li>
            <li><a href="#" class="active">Setting</a></li>
            <li><a href="login-admin.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="form-section">
            <div class="form-card">
                <h2>Profil Admin</h2>
                <form action="#">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div>
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male" class="gender-label">Laki-Laki</label>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female" class="gender-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob">Tanggal Lahir</label>
                        <input type="date" id="dob" name="dob">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" id="address" name="address">
                    </div>
                    <button type="submit" class="btn-submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>