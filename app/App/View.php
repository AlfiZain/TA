<?php

namespace app\App;

use app\Config\Database;
use app\Repository\UserRepository;
use app\Repository\SessionRepository;
use app\Service\UserService;
use app\Service\SessionService;

class View
{

    public static function render(string $view, $model=[])
    {   
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);

        $sessionRepository = new SessionRepository($connection);
        $sessionService = new SessionService($sessionRepository, $userRepository);

        $user = $sessionService->current();
        if($user->getRole() == "admin"){
            $model = array_merge([
                'title' => "Pemilihan Siswa Berprestasi Pada SMKN 55 Jakarta",
                'by' => 'Muhammad Alfi Zain'
            ], $model);
            require __DIR__ . "/../View/header.php";
            require __DIR__ . "/../View/navigation_admin.php";
            require __DIR__ . "/../View/" . $view . ".php";
            require __DIR__ . "/../View/footer.php";
        }elseif($user->getRole() == "user"){
            $model = array_merge([
                'title' => "Pemilihan Siswa Berprestasi Pada SMKN 55 Jakarta",
                'by' => 'Muhammad Alfi Zain'
            ], $model);
            require __DIR__ . "/../View/header.php";
            require __DIR__ . "/../View/navigation.php";
            require __DIR__ . "/../View/" . $view . ".php";
            require __DIR__ . "/../View/footer.php";
        }
    }

    public static function renderNotLogin(string $view, $model=[])
    {   
        $model = array_merge([
            'title' => "Pemilihan Siswa Berprestasi Pada SMKN 55 Jakarta",
            'by' => 'Muhammad Alfi Zain'
        ], $model);
        require __DIR__ . "/../View/header.php";
        require __DIR__ . "/../View/" . $view . ".php";
        require __DIR__ . "/../View/footer.php";
    }


    public static function redirect(string $url)
    {
        header("Location: $url");
    }
}
