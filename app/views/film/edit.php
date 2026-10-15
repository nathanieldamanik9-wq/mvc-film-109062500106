<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Film</h2>

    <?php if (!empty($flash)): ?>
        <div class="alert <?= $flash['type'] === 'success' ? 'alert-success' : 'alert-error' ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?page=film&action=update">
        <input type="hidden" name="id" value="<?= (int) $film['id'] ?>">

        <label>Judul</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($film['judul']) ?>" required>

        <label>Sutradara</label>
        <input type="text" name="sutradara" value="<?= htmlspecialchars($film['sutradara']) ?>" required>

        <label>Genre</label>
        <input type="text" name="genre" value="<?= htmlspecialchars($film['genre']) ?>" required>

        <label>Tahun Rilis</label>
        <input type="number" name="tahun_rilis" min="1888" max="2100"
               value="<?= htmlspecialchars((string) $film['tahun_rilis']) ?>" required>

        <label>Rating (0 - 10)</label>
        <input type="number" name="rating" min="0" max="10" step="0.1"
               value="<?= htmlspecialchars((string) $film['rating']) ?>" required>

        <label>Durasi (menit)</label>
        <input type="number" name="durasi" min="1"
               value="<?= htmlspecialchars((string) $film['durasi']) ?>" required>

        <button type="submit" class="btn">Update</button>
        <a href="index.php?page=film">Kembali</a>
    </form>
</div>
</body>
</html>