<?php

namespace app\Domain;

class Session
{
    private string $id;
    private string $userId;

    public function __construct(string $id, string $userId)
    {
        $this->id = $id;
        $this->userId = $userId;
    }

    // Getter dan setter untuk properti
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
