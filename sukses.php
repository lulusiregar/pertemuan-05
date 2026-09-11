<?php

require_once 'functions.php';

$nama = $_GET['nama'] ?? '';
$nim = $_GET['nim'] ?? '';
$email = $_GET['email'] ?? '';
$prodi = $_GET['prodi'] ?? '';
$kegiatan = $_GET['kegiatan'] ?? '';
$jumlah = $_GET['jumlah'] ?? '';

require 'components/header.php';
?>

<div class="container">

    <h1>Pendaftaran Berhasil</h1>

    <div class="success">

        <p><strong>Nama:</strong> <?= e($nama) ?></p>

        <p><strong>NIM:</strong> <?= e($nim) ?></p>

        <p><strong>Email:</strong> <?= e($email) ?></p>

        <p><strong>Program Studi:</strong> <?= e($prodi) ?></p>

        <p><strong>Kegiatan:</strong> <?= e($kegiatan) ?></p>

        <p><strong>Jumlah Peserta:</strong> <?= e($jumlah) ?></p>

    </div>

</div>

<?php require 'components/footer.php'; ?>
