<?php

    $kataKunci = trim($_GET['q'] ?? '');
    $kategori = $_GET['kategori'] ?? 'semua';
    $kategoriValid = ['semua', 'minuman', 'makanan', 'alat-tulis'];
    if (!in_array($kategori, $kategoriValid, true)) {
        $kategori = 'semua';
    }

?>

<!doctype html>

<html lang="id">
    <head>
        <meta charset="utf-8">
        <title>Pencarian</title>
    </head>
    
    <body>
        <h1>Pencarian Produk</h1>
        <form method="get">
            <label>Kata kunci
                <input name="q" value="<?= htmlspecialchars($kataKunci, ENT_QUOTES, 'UTF-8') ?>">
            </label>
            
            <label>Kategori
                <select name="kategori">
                    <?php foreach ($kategoriValid as $item): ?>
                        <option value="<?= $item ?>" <?= $kategori === $item ? 'selected' : '' ?>>
                            <?= htmlspecialchars(ucwords(str_replace('-', ' ', $item))) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            
            <button type="submit">Cari</button>
        </form>
        
        <?php if ($kataKunci !== ''): ?>
            <p>Mencari: <b><?= htmlspecialchars($kataKunci) ?></b></p>
        <?php endif; ?>    
    </body>
</html>