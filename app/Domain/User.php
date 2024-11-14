<?php
namespace app\Domain;

class User {
    private string $id;
    private string $username;
    private string $password;
    private string $role;

    public function __construct( $id, $username, $password, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    // Getter dan setter untuk properti
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }
}