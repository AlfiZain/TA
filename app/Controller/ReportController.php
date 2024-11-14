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

class ReportController
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

    public function reportSiswa()
    {
        $user = $this->sessionService->current();
        try {
            $siswaList = $this->siswaService->getAllSiswa();
            View::render('Report/report_siswa', [
                'menu' => 'Laporan Data Siswa',
                'siswaList' => $siswaList,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('Report/report_siswa', [
                'menu' => 'Laporan Data Siswa',
                'siswaList' => $siswaList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function reportKriteria()
    {
        $user = $this->sessionService->current();
        try {
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            View::render('Report/report_kriteria', [
                'menu' => 'Laporan Data Kriteria',
                'kriteriaList' => $kriteriaList,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('Report/report_kriteria', [
                'menu' => 'Laporan Data Kriteria',
                'kriteriaList' => $kriteriaList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function reportNilaiAlternatif()
    {
        $user = $this->sessionService->current();
        try {
            $siswaList = $this->siswaService->getAllSiswa();
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $nilaiAlternatifList = $this->nilaiAlternatifService->getAllNilaiAlternatif();
            View::render('Report/report_nilai_alternatif', [
                'menu' => 'Laporan Data Kriteria',
                'siswaList' => $siswaList,
                'kriteriaList' => $kriteriaList,
                'nilaiAlternatifList' => $nilaiAlternatifList,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('Report/report_nilai_alternatif', [
                'menu' => 'Laporan Data Kriteria',
                'siswaList' => $siswaList,
                'kriteriaList' => $kriteriaList,
                'nilaiAlternatifList' => $nilaiAlternatifList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function reportSiswaTerbaik()
    {
        $user = $this->sessionService->current();
        try {
            $peringkatSiswa = $this->siswaTerbaikService->getPeringkat();
            View::render('Report/report_siswa_terbaik', [
                'menu' => 'Perhitungan Weighted Product',
                'peringkatSiswa' => $peringkatSiswa,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('Report/report_siswa_terbaik', [
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
