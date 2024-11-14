<?php

namespace app\Controller;

use app\App\View;
use app\Config\Database;
use app\Repository\KriteriaRepository;
use app\Repository\NilaiAlternatifRepository;
use app\Repository\SessionRepository;
use app\Repository\SiswaRepository;
use app\Repository\UserRepository;
use app\Service\KriteriaService;
use app\Service\NilaiAlternatifService;
use app\Service\SiswaTerbaikService;
use app\Service\SessionService;
use app\Service\SiswaService;

class HomeController
{
    private SessionService $sessionService;
    private SiswaService $siswaService;
    private KriteriaService $kriteriaService;
    private NilaiAlternatifService $nilaiAlternatifService;
    private SiswaTerbaikService $siswaTerbaikService;

    public function __construct()
    {
        $connection = Database::getConnection();

        $userRepository = new UserRepository($connection);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $siswaRepository = new SiswaRepository($connection);
        $this->siswaService = new SiswaService($siswaRepository);

        $kriteriaRepository = new KriteriaRepository($connection);
        $this->kriteriaService = new KriteriaService($kriteriaRepository);

        $nilaiAlternatifRepository = new NilaiAlternatifRepository($connection);
        $this->nilaiAlternatifService = new NilaiAlternatifService($nilaiAlternatifRepository, $this->siswaService, $this->kriteriaService);

        $this->siswaTerbaikService = new SiswaTerbaikService();
    }

    function index(): void
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::renderNotLogin('Home/login', [
                'menu' => 'Login'
            ]);
        } else {
            $siswaList = $this->siswaService->getAllSiswa();
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $nilaiAlternatifList = $this->nilaiAlternatifService->getAllNilaiAlternatif();
            $peringkatSiswa = $this->siswaTerbaikService->getPeringkat();
            View::render('Home/dashboard', [
                "menu" => "Dashboard",
                "siswaList" => $siswaList,
                "kriteriaList" => $kriteriaList,
                "nilaiAlternatifList" => $nilaiAlternatifList,
                "peringkatSiswa" => $peringkatSiswa,
                "user" => [
                    "name" => $user->getUsername(),
                    "role" => $user->getRole()
                ]
            ]);
        }
    }
}
