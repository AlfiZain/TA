<?php

namespace app\Service;

use app\Config\Database;
use app\Domain\User;
use app\Exception\ValidationException;
use app\Repository\SessionRepository;
use app\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($username, $password): User
    {
        // Validasi input
        if (empty($username) || empty($password)) {
            throw new ValidationException("Username and Password tidak bisa kosong");
        }

        $user = $this->userRepository->findByUsername($username);

        if ($user == null || !password_verify($password, $user->getPassword())) {
            throw new ValidationException("Login gagal, Username atau Password salah");
        }

        return $user;
    }

    public function register($id, $name, $password, $role): User
    {
        // Validasi input
        if (empty($id) || empty($name) || empty($password) || empty($role)) {
            throw new ValidationException("ID, Name, Role and Password tidak bisa kosong");
        }

        try {
            Database::beginTransaction();
            // Cek apakah user dengan id yang sama sudah ada
            $user = $this->userRepository->findById($id);
            if ($user != null) {
                throw new ValidationException("User ID Sudah Ada");
            }

            // Buat instance User baru
            $user = new User($id, $name, password_hash($password, PASSWORD_BCRYPT), $role);

            // Simpan user ke dalam database
            $this->userRepository->save($user);

            Database::commitTransaction();
            return $user;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    // Melakukan update pada profile untuk merubah nama dan password
    public function updateProfile($id, $name, $oldPassword, $newPassword): User
    {
        // Validasi input
        if (empty($name)) {
            throw new ValidationException("Name tidak bisa kosong");
        } else if (empty($oldPassword) || empty($newPassword)) {
            throw new ValidationException("Old Password and New Password tidak bisa kosong");
        }

        try {
            Database::beginTransaction();
            // Temukan user berdasarkan ID
            $user = $this->userRepository->findById($id);

            // Validasi user
            if (!$user) {
                throw new ValidationException("User tidak ditemukan");
            }

            // Validasi user dan password
            if (!$user || !password_verify($oldPassword, $user->getPassword())) {
                throw new ValidationException("Password lama salah");
            }

            // Update user
            $user->setUsername($name);
            // Update password
            $user->setPassword(password_hash($newPassword, PASSWORD_BCRYPT));
            $this->userRepository->update($user);

            Database::commitTransaction();
            return $user;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    // Melakukan update user untuk merubah nama dan role
    public function updateUser($id, $name, $role): User
    {
        // Validasi input
        if (empty($name)) {
            throw new ValidationException("Name tidak bisa kosong");
        } else if (empty($role)) {
            throw new ValidationException("Role tidak bisa kosong");
        }

        try {
            Database::beginTransaction();
            // Temukan user berdasarkan ID
            $user = $this->userRepository->findById($id);

            // Validasi user
            if (!$user) {
                throw new ValidationException("User tidak ditemukan");
            }

            // Update user
            $user->setUsername($name);
            $user->setRole($role);
            $this->userRepository->update($user);

            Database::commitTransaction();
            return $user;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    // Mereset password menjadi sama dengan id user
    public function resetPassword($id): user
    {
        try {
            Database::beginTransaction();
            // Temukan user berdasarkan ID
            $user = $this->userRepository->findById($id);

            // Validasi user
            if (!$user) {
                throw new ValidationException("User tidak ditemukan");
            }

            // Update password berdasarkan ud
            $user->setPassword(password_hash($id, PASSWORD_BCRYPT));
            $this->userRepository->update($user);

            Database::commitTransaction();
            return $user;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function deleteUser(string $id, string $currentIdUser): void
    {
        // Validasi penghapusan apabila id yang dihapus adalah id yang sedang login maka tidak bisa dihapus
        if ($id == $currentIdUser) {
            throw new ValidationException("Tidak Dapat Menghapus User Yang Sedang Login");
        }

        try {
            Database::beginTransaction();
            // Panggil method delete dari UserRepository
            $this->userRepository->delete($id);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function getAllUser(): array
    {
        try {
            // Panggil method dari UserRepository untuk mengambil semua data siswa
            return $this->userRepository->findAllUser();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
