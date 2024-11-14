<?php

namespace app\Controller;

use app\App\View;
use app\Config\Database;
use app\Exception\ValidationException;
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

class SiswaTerbaikController
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

    public function info()
    {
        $user = $this->sessionService->current();
        View::render('Siswa_Terbaik/info', [
            'menu' => 'Info Weighted Product',
            'user' => [
                'name' => $user->getUsername()
            ]
        ]);
    }

    public function perhitungan()
    {
        $user = $this->sessionService->current();
        try {
            $siswaList = $this->siswaService->getAllSiswa();
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $nilaiAlternatifList = $this->nilaiAlternatifService->getAllNilaiAlternatif();
            $normalizedW = $this->siswaTerbaikService->getNormalizedW();
            $sList = $this->siswaTerbaikService->getS();
            $vList = $this->siswaTerbaikService->getV();
            View::render('Siswa_Terbaik/perhitungan', [
                'menu' => 'Perhitungan Weighted Product',
                'siswaList' => $siswaList,
                'kriteriaList' => $kriteriaList,
                'nilaiAlternatifList' => $nilaiAlternatifList,
                'normalizedW' => $normalizedW,
                'sList' => $sList,
                'vList' => $vList,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('Siswa_Terbaik/perhitungan', [
                'menu' => 'Perhitungan Weighted Product',
                'siswaList' => $siswaList,
                'kriteriaList' => $kriteriaList,
                'nilaiAlternatifList' => $nilaiAlternatifList,
                'normalizedW' => $normalizedW,
                'sList' => $sList,
                'vList' => $vList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function peringkat()
    {
        $user = $this->sessionService->current();
        try {
            $peringkatSiswa = $this->siswaTerbaikService->getPeringkat();
            View::render('Siswa_Terbaik/peringkat', [
                'menu' => 'Perhitungan Weighted Product',
                'peringkatSiswa' => $peringkatSiswa,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('Siswa_Terbaik/peringkat', [
                'menu' => 'Perhitungan Weighted Product',
                'peringkatSiswa' => $peringkatSiswa,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }
}
