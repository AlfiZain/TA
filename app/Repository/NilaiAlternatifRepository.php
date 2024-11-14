<?php

namespace app\Repository;

use app\Domain\NilaiAlternatif;

class NilaiAlternatifRepository
{
    private \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function save(NilaiAlternatif $nilaiAlternatif): NilaiAlternatif
    {
        $statement = $this->connection->prepare("INSERT INTO nilai_alternatif (nis, id_kriteria, nilai) VALUES (?, ?, ?)");
        $statement->execute([$nilaiAlternatif->getNis(), $nilaiAlternatif->getIdKriteria(), $nilaiAlternatif->getNilai()]);
        return $nilaiAlternatif;
    }

    public function update(NilaiAlternatif $nilaiAlternatif): NilaiAlternatif
    {
        $statement = $this->connection->prepare("UPDATE nilai_alternatif SET nilai=? WHERE nis=? AND id_kriteria=?");
        $statement->execute([$nilaiAlternatif->getNilai(), $nilaiAlternatif->getNis(), $nilaiAlternatif->getIdKriteria()]);
        return $nilaiAlternatif;
    }

    public function delete(String $nis, String $idKriteria): void
    {
        $statement = $this->connection->prepare("DELETE FROM nilai_alternatif WHERE nis=? AND id_kriteria=?");
        $statement->execute([$nis, $idKriteria]);
    }

    public function findByNisAndIdKriteria(String $nis, String $idKriteria): ?NilaiAlternatif
    {
        $statement = $this->connection->prepare("SELECT nis, id_kriteria, nilai FROM nilai_alternatif WHERE nis=? AND id_kriteria=?");
        $statement->execute([$nis, $idKriteria]);

        try {
            if ($row = $statement->fetch()) {
                $nilaiAlternatif = new NilaiAlternatif(
                    $row['nis'],
                    $row['id_kriteria'],
                    $row['nilai']
                );
                return $nilaiAlternatif;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAllNilaiAlternatif(): array
    {
        try {
            $query = "SELECT * FROM nilai_alternatif";
            $result = $this->connection->query($query);

            $nilaiAlternatifList = [];
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $nilaiAlternatif = new NilaiAlternatif(
                    $row['nis'],
                    $row['id_kriteria'],
                    $row['nilai']
                );
                $nilaiAlternatifList[] = $nilaiAlternatif;
            }

            return $nilaiAlternatifList;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
?>
