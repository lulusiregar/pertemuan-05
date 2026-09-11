<?php

    $nama = trim($_GET['nama'] ?? 'Peserta');

?>

<!doctype html>

<html lang="id">
    <head>
        <meta charset="utf-8">
        <title>Berhasil</title>
    </head>
    <body>
        <h1>Pendaftaran Berhasil</h1>
        <p>Terima kasih, <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>.</p>
        <a href="form.php">Kembali ke form</a>
    </body>
</html>