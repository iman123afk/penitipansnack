<?php session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://ai-public.creatie.ai/gen_page/tailwind-custom.css" rel="stylesheet">
    <script
        src="https://cdn.tailwindcss.com/3.4.5?plugins=forms@0.5.7,typography@0.5.13,aspect-ratio@0.4.2,container-queries@0.1.1"></script>
    <script src="https://ai-public.creatie.ai/gen_page/tailwind-config.min.js" data-color="#000000"
        data-border-radius="small"></script>
</head>
</head>

<body>
    <header>
        <div class="logo">
            <img src="./img/Snack Logo - Original - 5000x5000 6.png" alt="Snack Logo">
        </div>
        <nav>
            <a href="index.php">
                <button>Home</button>
            </a>
            <a href="keranjang.php">
                <button>Keranjang</button>
            </a>
            <a href="notifikasi.php">
                <button class="active">Notifikasi</button>
            </a>
            <a href="profile-user.php">
                <button>Profil</button>
            </a>
        </nav>
    </header>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">(DALAM PROSES PENGEMBANGAN)</h3>
                        <h3 class="text-lg font-semibold text-gray-900">Nomor pesanan</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Nama snack</p>
                            <p class="text-sm text-gray-600">Harga</p>
                            <jum class="text-sm text-gray-600">jumlah snack</p>
                                <p class="text-sm text-gray-600">Status pembayaran</p>
                                <h4 class="text-lg font-semibold text-gray-900">Total pembayaran</h4>
                        </div>

                    </div>
                    <img src="./img/img1.jpg" alt="foto snack" class="w-24 h-24 object-cover rounded-lg">
                </div>
            </div>




        </div>
    </main>


</body>

</html>