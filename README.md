# MVC PHP Native - Data Film

Aplikasi CRUD sederhana untuk mempelajari pola Model-View-Controller pada PHP Native dengan tema data film.

## Kebutuhan
- PHP 8.0 atau lebih baru
- MySQL/MariaDB
- Web server lokal seperti XAMPP atau Laragon
- Git

## Instalasi
1. Clone atau salin project ke folder `htdocs` (XAMPP).
2. Import `database/film.sql` melalui phpMyAdmin.
3. Sesuaikan koneksi pada `config/database.php`.
4. Buka `http://localhost/mvc-film/public/index.php`.

## Struktur MVC
- `app/models/` : akses dan operasi data.
- `app/controllers/` : alur request dan pemanggilan Model/View.
- `app/views/` : tampilan HTML.
- `config/` : konfigurasi koneksi database.
- `database/` : skema dan data awal SQL.
- `public/` : entry point aplikasi dan CSS.

## Fitur
- Menampilkan data film
- Menambah data film
- Mengubah data film
- Menghapus data film
- Validasi input dan pesan sukses/gagal

## Histori Git
Perintah: `git log --oneline --graph --decorate`

```
b22bc86 (HEAD -> main) style: add basic stylesheet for film pages
* b225185 feat: add complete CRUD routing
* 34da63f feat: add complete film CRUD views
* 09260df feat: add complete film CRUD controller with validation and flash messages
* ff70458 feat: add complete film CRUD model
* c876ea3 feat: add PDO database connection
* 15c2654 feat: add film database schema and seed data
* ea36046 chore: initialize mvc php native film project