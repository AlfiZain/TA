<?php

namespace app\Repository;

use app\Domain\User;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    // Parameter user yang terdapat pada Domain
    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users (id, username, password, role) VALUES (?, ?, ?, ?)");
        $statement->execute([$user->getId(), $user->getUsername(), $user->getPassword(), $user->getRole()]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE users SET username=?, password=?, role=? WHERE id=?");
        $statement->execute([$user->getUsername(), $user->getPassword(), $user->getRole(), $user->getId()]);
        return $user;
    }

    public function findById(String $id): ?User
    {
        $statement = $this->connection->prepare("SELECT id, username, password, role FROM users WHERE id = ? ");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User($row['id'], $row['username'], $row['password'], $row['role']);
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByUsername($username)
    {
        $statement = $this->connection->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User($row['id'], $row['username'], $row['password'], $row['role']);
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAllUser(): array
    {
        try {
            // Lakukan query ke database untuk mengambil semua data siswa
            $query = "SELECT * FROM users";
            $result = $this->connection->query($query);

            // Lakukan mapping hasil query ke objek Siswa
            $userList = [];
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $user = new User(
                    $row['id'],
                    $row['username'],
                    $row['password'],
                    $row['role']
                );
                $userList[] = $user;
            }

            return $userList;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function delete(String $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE id=?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $statement = $this->connection->exec('DELETE FROM users');
    }
}
