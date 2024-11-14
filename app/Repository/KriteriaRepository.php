<?php

namespace app\Repository;

use app\Domain\Kriteria;

class KriteriaRepository
{
    private \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function save(Kriteria $kriteria): Kriteria
    {
        $statement = $this->connection->prepare("INSERT INTO kriteria (id, nama, bobot) VALUES (?, ?, ?)");
        $statement->execute([$kriteria->getId(), $kriteria->getNama(), $kriteria->getBobot()]);
        return $kriteria;
    }

    public function update(Kriteria $kriteria): Kriteria
    {
        $statement = $this->connection->prepare("UPDATE kriteria SET nama=?, bobot=? WHERE id=?");
        $statement->execute([$kriteria->getNama(), $kriteria->getBobot(), $kriteria->getId()]);
        return $kriteria;
    }

    public function delete(String $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM kriteria WHERE id=?");
        $statement->execute([$id]);
    }

    public function findByIdKriteria(String $id): ?Kriteria
    {
        $statement = $this->connection->prepare("SELECT id, nama, bobot FROM kriteria WHERE id=?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $kriteria = new Kriteria(
                    $row['id'],
                    $row['nama'],
                    $row['bobot']
                );
                return $kriteria;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAllKriteria(): array
    {
        try {
            $query = "SELECT * FROM kriteria";
            $result = $this->connection->query($query);

            $kriteriaList = [];
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $kriteria = new Kriteria(
                    $row['id'],
                    $row['nama'],
                    $row['bobot']
                );
                $kriteriaList[] = $kriteria;
            }

            return $kriteriaList;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
