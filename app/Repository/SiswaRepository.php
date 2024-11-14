<?php

namespace app\Repository;

use app\Domain\Siswa;

class SiswaRepository
{
    private \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Parameter siswa yang terdapat pada Domain
    public function save(Siswa $siswa): Siswa
    {
        $statement = $this->connection->prepare("INSERT INTO siswa (nis, nama, kelas, jenis_kelamin, alamat, tanggal_lahir) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->execute([$siswa->getNis(), $siswa->getNama(), $siswa->getKelas(), $siswa->getJenisKelamin(), $siswa->getAlamat(), $siswa->getTanggalLahir()]);
        return $siswa;
    }

    public function update(Siswa $siswa): Siswa
    {
        $statement = $this->connection->prepare("UPDATE siswa SET nama=?, kelas=?, jenis_kelamin=?, alamat=?, tanggal_lahir=? WHERE nis=?");
        $statement->execute([$siswa->getNama(), $siswa->getKelas(), $siswa->getJenisKelamin(), $siswa->getAlamat(), $siswa->getTanggalLahir(), $siswa->getNis()]);
        return $siswa;
    }

    public function delete(string $nis): void
    {
        $statement = $this->connection->prepare("DELETE FROM siswa WHERE nis=?");
        $statement->execute([$nis]);
    }

    public function findByNisSiswa(string $nis): ?Siswa
    {
        $statement = $this->connection->prepare("SELECT nis, nama, kelas, jenis_kelamin, alamat, tanggal_lahir FROM siswa WHERE nis=?");
        $statement->execute([$nis]);

        try {
            // Lakukan query ke database untuk mengambil data siswa berdasarkan id yang sesuai
            if ($row = $statement->fetch()) {
                $siswa = new Siswa(
                    $row['nis'],
                    $row['nama'],
                    $row['kelas'],
                    $row['jenis_kelamin'],
                    $row['alamat'],
                    $row['tanggal_lahir']
                );
                return $siswa;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAllSiswa(): array
    {
        try {
            // Lakukan query ke database untuk mengambil semua data siswa
            $query = "SELECT nis, nama, kelas, jenis_kelamin, alamat, tanggal_lahir FROM siswa";
            $result = $this->connection->query($query);

            // Lakukan mapping hasil query ke objek Siswa
            $siswaList = [];
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $siswa = new Siswa(
                    $row['nis'],
                    $row['nama'],
                    $row['kelas'],
                    $row['jenis_kelamin'],
                    $row['alamat'],
                    $row['tanggal_lahir']
                );
                $siswaList[] = $siswa;
            }

            return $siswaList;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
?>
