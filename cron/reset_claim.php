<?php
$mysqli = new mysqli(
    'localhost',
    'u3218221_anakmagang',
    'anakmagang10',
    'u3218221_terasjapan'
);

// Cek koneksi
if ($mysqli->connect_error) {
    die('Koneksi gagal: ' . $mysqli->connect_error);
}

// Reset is_claimed_today ke 0
$query = "UPDATE login_status SET is_claimed_today = 0";

if ($mysqli->query($query) === TRUE) {
    echo "Reset sukses jam " . date('Y-m-d H:i:s');
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();
?>
