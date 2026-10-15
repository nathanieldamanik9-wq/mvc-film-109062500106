<?php
class FilmController
{
    public function __construct(private Film $model) {}

    public function index(): void
    {
        $films = $this->model->getAll();
        $flash = $this->pullFlash();
        require __DIR__ . '/../views/film/index.php';
    }

    public function create(): void
    {
        $flash = $this->pullFlash();
        require __DIR__ . '/../views/film/create.php';
    }

    public function store(): void
    {
        $this->requirePost();
        [$data, $errors] = $this->validateInput($_POST);

        if ($errors) {
            $this->redirect('create', 'error', implode(' ', $errors));
        }

        try {
            $this->model->insert($data);
        } catch (PDOException $e) {
            $this->redirect('create', 'error', $this->dbErrorMessage($e));
        }

        $this->redirect('index', 'success', 'Film berhasil ditambahkan.');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $film = $this->model->findById($id);

        if (!$film) {
            $this->redirect('index', 'error', 'Data film tidak ditemukan.');
        }

        $flash = $this->pullFlash();
        require __DIR__ . '/../views/film/edit.php';
    }

    public function update(): void
    {
        $this->requirePost();
        $id = (int) ($_POST['id'] ?? 0);
        [$data, $errors] = $this->validateInput($_POST);

        if ($errors) {
            $this->redirect('edit', 'error', implode(' ', $errors), ['id' => $id]);
        }

        try {
            $this->model->update($id, $data);
        } catch (PDOException $e) {
            $this->redirect('edit', 'error', $this->dbErrorMessage($e), ['id' => $id]);
        }

        $this->redirect('index', 'success', 'Data film berhasil diperbarui.');
    }

    public function delete(): void
    {
        $this->requirePost();
        $id = (int) ($_POST['id'] ?? 0);

        try {
            $this->model->delete($id);
        } catch (PDOException $e) {
            $this->redirect('index', 'error', 'Gagal menghapus data film.');
        }

        $this->redirect('index', 'success', 'Data film berhasil dihapus.');
    }

    /* ---------- helper private ---------- */

    private function validateInput(array $input): array
    {
        $data = [
            'judul'       => trim($input['judul'] ?? ''),
            'sutradara'   => trim($input['sutradara'] ?? ''),
            'genre'       => trim($input['genre'] ?? ''),
            'tahun_rilis' => trim($input['tahun_rilis'] ?? ''),
            'rating'      => trim($input['rating'] ?? ''),
            'durasi'      => trim($input['durasi'] ?? '')
        ];

        $labels = [
            'judul' => 'Judul', 'sutradara' => 'Sutradara', 'genre' => 'Genre',
            'tahun_rilis' => 'Tahun rilis', 'rating' => 'Rating', 'durasi' => 'Durasi'
        ];

        $errors = [];
        foreach ($labels as $field => $label) {
            if ($data[$field] === '') {
                $errors[] = "$label wajib diisi.";
            }
        }

        if ($data['tahun_rilis'] !== ''
            && (!ctype_digit($data['tahun_rilis'])
                || (int) $data['tahun_rilis'] < 1888
                || (int) $data['tahun_rilis'] > (int) date('Y') + 5)) {
            $errors[] = 'Tahun rilis tidak valid.';
        }

        if ($data['rating'] !== ''
            && (!is_numeric($data['rating'])
                || (float) $data['rating'] < 0
                || (float) $data['rating'] > 10)) {
            $errors[] = 'Rating harus berupa angka 0 sampai 10.';
        }

        if ($data['durasi'] !== ''
            && (!ctype_digit($data['durasi']) || (int) $data['durasi'] < 1)) {
            $errors[] = 'Durasi harus berupa angka menit lebih dari 0.';
        }

        return [$data, $errors];
    }

    private function dbErrorMessage(PDOException $e): string
    {
        if ($e->getCode() === '23000') {
            return 'Film dengan judul dan tahun rilis yang sama sudah ada.';
        }
        return 'Terjadi kesalahan pada database. Data gagal disimpan.';
    }

    private function requirePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('index', 'error', 'Permintaan tidak valid.');
        }
    }

    private function redirect(string $action, string $type, string $message, array $params = []): void
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
        $query = http_build_query(array_merge(['page' => 'film', 'action' => $action], $params));
        header('Location: index.php?' . $query);
        exit;
    }

    private function pullFlash(): ?array
    {
        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        return $flash;
    }
}
?>