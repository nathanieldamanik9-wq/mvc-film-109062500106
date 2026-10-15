CREATE DATABASE IF NOT EXISTS db_film
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE db_film;

CREATE TABLE IF NOT EXISTS film (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    sutradara VARCHAR(100) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    tahun_rilis SMALLINT NOT NULL,
    rating DECIMAL(4,1) NOT NULL,
    durasi SMALLINT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_judul_tahun (judul, tahun_rilis)
);

INSERT INTO film (judul, sutradara, genre, tahun_rilis, rating, durasi) VALUES
('Fast X', 'Louis Leterrier', 'Action', 2023, 5.8, 141),
('The Big Four', 'Timo Tjahjanto', 'Action', 2022, 6.1, 140),
('Avengers: Endgame', 'Anthony Russo, Joe Russo', 'Action', 2019, 8.4, 181),
('Spider-Man: No Way Home', 'Jon Watts', 'Action', 2021, 8.2, 148),
('Inception', 'Christopher Nolan', 'Sci-Fi', 2010, 8.8, 148),
('Interstellar', 'Christopher Nolan', 'Sci-Fi', 2014, 8.7, 169),
('Parasite', 'Bong Joon-ho', 'Drama', 2019, 8.5, 132),
('Laskar Pelangi', 'Riri Riza', 'Drama', 2008, 7.7, 124),
('Pengabdi Setan', 'Joko Anwar', 'Horror', 2017, 6.5, 107),
('KKN di Desa Penari', 'Awi Suryadi', 'Horror', 2022, 6.0, 130),
('Dilan 1990', 'Fajar Bustomi', 'Romance', 2018, 6.6, 110);