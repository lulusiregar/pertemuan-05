<?php

    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $jumlah = filter_input(INPUT_POST, 'jumlah', FILTER_VALIDATE_INT);
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($nama === '') $errors['nama'] = 'Nama wajib diisi.';
        elseif (mb_strlen($nama) < 3) $errors['nama'] = 'Nama minimal 3 karakter.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Format email tidak valid.';
        if ($jumlah === false || $jumlah === null || $jumlah < 1 || $jumlah > 5)
            $errors['jumlah'] = 'Jumlah peserta harus 1 sampai 5.';
        if ($errors === []) {
            header('Location: sukses.php?nama=' . urlencode($nama));
            exit;
        }
    }

    function e(string $value): string {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

?>

<form method="post" novalidate>
    <label>Nama <input name="nama" value="<?= e($nama) ?>"></label>
    <small><?= e($errors['nama'] ?? '') ?></small><br>
    <label>Email <input type="email" name="email" value="<?= e($email) ?>"></label>
    <small><?= e($errors['email'] ?? '') ?></small><br>
    <label>Jumlah peserta
        <input type="number" name="jumlah" min="1" max="5"
            value="<?= e($_POST['jumlah'] ?? '1') ?>">
    </label>
    <small><?= e($errors['jumlah'] ?? '') ?></small><br>
    <button type="submit">Daftar</button>
</form>