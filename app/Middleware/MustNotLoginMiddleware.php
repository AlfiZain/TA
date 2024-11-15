<?php 
namespace app\Middleware;

use app\App\View;
use app\Config\Database;
use app\Repository\SessionRepository;
use app\Repository\UserRepository;
use app\Service\SessionService;

class MustNotLoginMiddleware implements Middleware
{
    private SessionService $sessionService;

    function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    function before(): void
    {
        $user = $this->sessionService->current();
        if($user != null){
            View::redirect('/');
        }
    }
}
?>