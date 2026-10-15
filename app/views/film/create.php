<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Film</h2>

    <?php if (!empty($flash)): ?>
        <div class="alert <?= $flash['type'] === 'success' ? 'alert-success' : 'alert-error' ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?page=film&action=store">
        <label>Judul</label>
        <input type="text" name="judul" required>

        <label>Sutradara</label>
        <input type="text" name="sutradara" required>

        <label>Genre</label>
        <input type="text" name="genre" required>

        <label>Tahun Rilis</label>
        <input type="number" name="tahun_rilis" min="1888" max="2100" required>

        <label>Rating (0 - 10)</label>
        <input type="number" name="rating" min="0" max="10" step="0.1" required>

        <label>Durasi (menit)</label>
        <input type="number" name="durasi" min="1" required>

        <button type="submit" class="btn">Simpan</button>
        <a href="index.php?page=film">Kembali</a>
    </form>
</div>
</body>
</html>