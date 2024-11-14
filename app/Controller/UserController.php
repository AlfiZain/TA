<?php

namespace app\Controller;

use app\App\View;
use app\Config\Database;
use app\Exception\ValidationException;
use app\Repository\SessionRepository;
use app\Repository\UserRepository;
use app\Service\SessionService;
use app\Service\UserService;

class UserController
{
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function kelolaUser()
    {
        $user = $this->sessionService->current();
        try {
            $userList = $this->userService->getAllUser();
            View::render('User/kelola_user', [
                'menu' => 'Kelola User',
                'userList' => $userList,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('User/kelola_user', [
                'menu' => 'Kelola User',
                'userList' => $userList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function tambahUser()
    {
        $id = $_POST['id'];
        $name = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $user = $this->sessionService->current();
        try {
            $this->userService->register($id, $name, $password, $role);
            $userList = $this->userService->getAllUser();
            View::redirect('/users/kelola-user');
        } catch (ValidationException $exception) {
            View::render('User/kelola_user', [
                'menu' => 'Kelola User',
                'userList' => $userList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function ubahUser()
    {
        $id = $_POST['id'];
        $name = $_POST['username'];
        $role = $_POST['role'];

        $user = $this->sessionService->current();
        try {
            $userList = $this->userService->getAllUser();
            $this->userService->updateUser($id, $name, $role);
            View::redirect('/users/kelola-user');
        } catch (ValidationException $exception) {
            View::render('User/kelola_user', [
                'menu' => 'Kelola User',
                'userList' => $userList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function hapusUser()
    {
        $id = $_GET['id'];
        $user = $this->sessionService->current();
        try{
            $userList = $this->userService->getAllUser();
            $this->userService->deleteUser($id, $user->getId());
            View::redirect('/users/kelola-user');
        } catch (ValidationException $exception) {
            View::render('User/kelola_user', [
                'menu' => 'Kelola User',
                'userList' => $userList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }
    
    public function resetPassword()
    {
        $id = $_GET['id'];
        $user = $this->sessionService->current();
        try{
            $userList = $this->userService->getAllUser();
            $this->userService->resetPassword($id);
            View::redirect('/users/kelola-user');
        } catch (ValidationException $exception) {
            View::render('User/kelola_user', [
                'menu' => 'Kelola User',
                'userList' => $userList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function postLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $user = $this->userService->login($username, $password);
            $this->sessionService->create($user->getId());
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::renderNotLogin('Home/login', [
                'menu' => 'Login User',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function profile()
    {
        $user = $this->sessionService->current();
        View::render(
            'User/profile',
            [
                'menu' => 'Profile',
                'user' => [
                    'id' => $user->getId(),
                    'name' => $user->getUsername(),
                    'role' => $user->getRole()
                ]
            ]
        );
    }


    public function postUpdateProfile()
    {
        $user = $this->sessionService->current();

        $id = $user->getId();
        $name = $_POST['name'];
        $oldPassword = $_POST['passwordLama'];
        $newPassword = $_POST['passwordBaru'];
        try {
            $this->userService->updateProfile($id, $name, $oldPassword, $newPassword);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render('User/profile', [
                'menu' => 'Pengaturan',
                'error' => $exception->getMessage(),
                'user' => [
                    'id' => $user->getId(),
                    'name' => $_POST['name']
                ]
            ]);
        }
    }

    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect("/");
    }
}
