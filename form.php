<?php

require_once 'functions.php';

$nama = $_POST['nama'] ?? '';
$nim = $_POST['nim'] ?? '';
$email = $_POST['email'] ?? '';
$prodi = $_POST['prodi'] ?? '';
$kegiatan = $_POST['kegiatan'] ?? '';
$jumlah = $_POST['jumlah'] ?? '';
$persetujuan = $_POST['persetujuan'] ?? '';

$errors = [];

$prodiList = [
    'Manajemen Informatika',
    'Teknik Informatika',
    'Sistem Informasi'
];

$kegiatanList = [
    'Seminar',
    'Workshop',
    'Pelatihan'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = trim($nama);
    $nim = trim($nim);
    $email = trim($email);
    $jumlah = trim($jumlah);

    if ($nama === '') {
        $errors['nama'] = 'Nama wajib diisi.';
    } elseif (strlen($nama) < 3) {
        $errors['nama'] = 'Nama minimal 3 karakter.';
    }

    if (!validNIM($nim)) {
        $errors['nim'] = 'NIM harus berupa 8-15 digit angka.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid.';
    }

    if (!validPilihan($prodi, $prodiList)) {
        $errors['prodi'] = 'Program studi tidak valid.';
    }

    if (!validPilihan($kegiatan, $kegiatanList)) {
        $errors['kegiatan'] = 'Kegiatan tidak valid.';
    }

    if (!filter_var($jumlah, FILTER_VALIDATE_INT) ||
        $jumlah < 1 ||
        $jumlah > 3) {

        $errors['jumlah'] = 'Jumlah peserta harus 1-3.';
    }

    if ($persetujuan !== 'setuju') {
        $errors['persetujuan'] = 'Persetujuan wajib dicentang.';
    }

    if (empty($errors)) {

        $query = http_build_query([
            'nama' => $nama,
            'nim' => $nim,
            'email' => $email,
            'prodi' => $prodi,
            'kegiatan' => $kegiatan,
            'jumlah' => $jumlah
        ]);

        header("Location: sukses.php?$query");
        exit;
    }
}

require 'components/header.php';
?>

<div class="container">

    <h1>Pendaftaran Kegiatan Mahasiswa</h1>

    <form method="POST">

        <label>Nama</label>
        <input
            type="text"
            name="nama"
            value="<?= e($nama) ?>"
        >

        <?php if (isset($errors['nama'])): ?>
            <div class="error"><?= e($errors['nama']) ?></div>
        <?php endif; ?>


        <label>NIM</label>
        <input
            type="text"
            name="nim"
            value="<?= e($nim) ?>"
        >

        <?php if (isset($errors['nim'])): ?>
            <div class="error"><?= e($errors['nim']) ?></div>
        <?php endif; ?>


        <label>Email</label>
        <input
            type="email"
            name="email"
            value="<?= e($email) ?>"
        >

        <?php if (isset($errors['email'])): ?>
            <div class="error"><?= e($errors['email']) ?></div>
        <?php endif; ?>


        <label>Program Studi</label>

        <select name="prodi">

            <option value="">-- Pilih Program Studi --</option>

            <?php foreach ($prodiList as $item): ?>

                <option
                    value="<?= e($item) ?>"
                    <?= $prodi === $item ? 'selected' : '' ?>
                >
                    <?= e($item) ?>
                </option>

            <?php endforeach; ?>

        </select>

        <?php if (isset($errors['prodi'])): ?>
            <div class="error"><?= e($errors['prodi']) ?></div>
        <?php endif; ?>


        <label>Kegiatan</label>

        <select name="kegiatan">

            <option value="">-- Pilih Kegiatan --</option>

            <?php foreach ($kegiatanList as $item): ?>

                <option
                    value="<?= e($item) ?>"
                    <?= $kegiatan === $item ? 'selected' : '' ?>
                >
                    <?= e($item) ?>
                </option>

            <?php endforeach; ?>

        </select>

        <?php if (isset($errors['kegiatan'])): ?>
            <div class="error"><?= e($errors['kegiatan']) ?></div>
        <?php endif; ?>


        <label>Jumlah Peserta</label>

        <input
            type="number"
            name="jumlah"
            value="<?= e($jumlah) ?>"
            min="1"
            max="3"
        >

        <?php if (isset($errors['jumlah'])): ?>
            <div class="error"><?= e($errors['jumlah']) ?></div>
        <?php endif; ?>


        <label>
            <input
                type="checkbox"
                name="persetujuan"
                value="setuju"
                <?= $persetujuan === 'setuju' ? 'checked' : '' ?>
                style="width:auto;"
            >
            Saya menyetujui pendaftaran kegiatan
        </label>

        <?php if (isset($errors['persetujuan'])): ?>
            <div class="error"><?= e($errors['persetujuan']) ?></div>
        <?php endif; ?>


        <button type="submit">
            Daftar
        </button>

    </form>

</div>

<?php require 'components/footer.php'; ?>