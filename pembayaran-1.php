<?php session_start();

if (!isset($_SESSION["login"])) {
    header("Location: Login.php");
    exit;
} ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran Berhasil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://ai-public.creatie.ai/gen_page/tailwind-custom.css" rel="stylesheet" />
    <script
        src="https://cdn.tailwindcss.com/3.4.5?plugins=forms@0.5.7,typography@0.5.13,aspect-ratio@0.4.2,container-queries@0.1.1"></script>
    <script src="https://ai-public.creatie.ai/gen_page/tailwind-config.min.js" data-color="#000000"
        data-border-radius="small"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center font-[&#39;Inter&#39;]">
    <div class="max-w-4xl w-full mx-auto bg-white p-12 rounded-lg shadow-sm">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-custom/10 mb-4">
                <i class="fas fa-check text-4xl text-custom"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Pembayaran Berhasil</h1>
        </div>
        <div class="space-y-6">
            <div class="text-center space-y-2">
                <div class="text-sm text-gray-600">Nomor Transaksi</div>
                <div class="font-semibold text-gray-900">#TRX123456789</div>
            </div>
            <div class="text-center space-y-2">
                <div class="text-sm text-gray-600">Waktu Pembayaran</div>
                <div class="font-semibold text-gray-900">22 Feb 2024, 15:30 WIB</div>
            </div>
            <div class="border-t border-gray-200 pt-6">
                <h2 class="font-semibold text-gray-900 mb-4">Detail Pembelian</h2>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Cheetos (2x)</span>
                        <span class="font-medium text-gray-900">Rp. 14.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Potato (4x)</span>
                        <span class="font-medium text-gray-900">Rp. 20.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Biaya Layanan</span>
                        <span class="font-medium text-gray-900">Rp. 2.000</span>
                    </div>
                    <div class="pt-3 border-t border-gray-200">
                        <div class="flex justify-between font-semibold text-gray-900">
                            <span>Total</span>
                            <span>Rp. 36.000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 pt-6">
                <h2 class="font-semibold text-gray-900 mb-4">Metode Pembayaran</h2>
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-wallet text-purple-600"></i>
                    </div>
                    <span class="text-gray-900">E-Wallet (OVO)</span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 pt-8 justify-center max-w-lg mx-auto">
                <button
                    class="!rounded-button flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom">
                    <i class="fas fa-download mr-2"></i>
                    Unduh
                </button>
                <button
                    class="!rounded-button flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom">
                    <i class="fas fa-print mr-2"></i>
                    Cetak
                </button>
                <button
                    class="!rounded-button flex items-center justify-center px-6 py-3 bg-custom text-base font-medium text-white hover:bg-custom/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom">
                    <i class="fas fa-share-alt mr-2"></i>
                    Bagikan
                </button>

            </div>

        </div>
        <br>
        <a href="user-dashboard.php">
            <button
                class="w-full bg-blue-500 text-white font-semibold py-4 rounded-lg hover:bg-blue-400 transition-colors">
                Home
            </button>
        </a>

    </div>