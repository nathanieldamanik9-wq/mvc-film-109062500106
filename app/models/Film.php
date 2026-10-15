<?php
class Film
{
    public function __construct(private PDO $db) {}

    public function getAll(): array
    {
        $stmt = $this->db->query(
            'SELECT id, judul, sutradara, genre, tahun_rilis, rating, durasi
             FROM film ORDER BY judul'
        );
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT id, judul, sutradara, genre, tahun_rilis, rating, durasi
             FROM film WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function insert(array $data): bool
    {
        $sql = 'INSERT INTO film (judul, sutradara, genre, tahun_rilis, rating, durasi)
                VALUES (:judul, :sutradara, :genre, :tahun_rilis, :rating, :durasi)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':judul'       => $data['judul'],
            ':sutradara'   => $data['sutradara'],
            ':genre'       => $data['genre'],
            ':tahun_rilis' => $data['tahun_rilis'],
            ':rating'      => $data['rating'],
            ':durasi'      => $data['durasi']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = 'UPDATE film
                SET judul = :judul, sutradara = :sutradara, genre = :genre,
                    tahun_rilis = :tahun_rilis, rating = :rating, durasi = :durasi
                WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'          => $id,
            ':judul'       => $data['judul'],
            ':sutradara'   => $data['sutradara'],
            ':genre'       => $data['genre'],
            ':tahun_rilis' => $data['tahun_rilis'],
            ':rating'      => $data['rating'],
            ':durasi'      => $data['durasi']
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM film WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
?>