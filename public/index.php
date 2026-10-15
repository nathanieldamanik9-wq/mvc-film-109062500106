<?php
session_start();

require '../config/database.php';
require '../app/models/Film.php';
require '../app/controllers/FilmController.php';

try {
    $db = (new Database())->connect();
} catch (PDOException $e) {
    http_response_code(500);
    exit('Koneksi database gagal. Pastikan MySQL di XAMPP aktif dan periksa config/database.php.');
}

$model      = new Film($db);
$controller = new FilmController($model);

$page   = $_GET['page'] ?? 'film';
$action = $_GET['action'] ?? 'index';

if ($page !== 'film') {
    http_response_code(404);
    exit('Halaman tidak ditemukan.');
}

match ($action) {
    'index'  => $controller->index(),
    'create' => $controller->create(),
    'store'  => $controller->store(),
    'edit'   => $controller->edit(),
    'update' => $controller->update(),
    'delete' => $controller->delete(),
    default  => (function () {
        http_response_code(404);
        exit('Action tidak ditemukan.');
    })()
};
?>