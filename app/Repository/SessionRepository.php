<?php 
namespace app\Repository;

use app\Domain\Session;

class SessionRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }
    
    public function save(Session $session): Session
    {
        $statement = $this->connection->prepare("INSERT INTO sessions(id, user_id) VALUES (?, ?)");
        $statement->execute([$session->getId(), $session->getUserId()]);
        return $session;
    }

    public function findById(String $id): ?Session
    {
        $statement = $this->connection->prepare("SELECT id, user_id FROM sessions WHERE id = ?");
        $statement->execute([$id]);

        try{
            if($row = $statement->fetch()){
                $session = new Session($row['id'], $row['user_id']);
                return $session;
            } else{
                return null;
            }
        } finally{
            $statement->closeCursor();
        }
    }

    public function deleteById(String $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM sessions WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $statement = $this->connection->exec("DELETE FROM sessions");
    }
}

?>