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
use app\Service\SessionService;
use app\Service\SiswaService;

class NilaiAlternatifController
{
    private SessionService $sessionService;
    private SiswaService $siswaService;
    private KriteriaService $kriteriaService;
    private NilaiAlternatifService $nilaiAlternatifService;

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
    }

    public function dataNilaiAlternatif()
    {
        $user = $this->sessionService->current();
        try {
            $siswaList = $this->siswaService->getAllSiswa();
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $nilaiAlternatifList = $this->nilaiAlternatifService->getAllNilaiAlternatif();
            View::render('Nilai_Alternatif/data_nilai_alternatif', [
                'menu' => 'Data Nilai Alternatif',
                'siswaList' => $siswaList,
                'kriteriaList' => $kriteriaList,
                'nilaiAlternatifList' => $nilaiAlternatifList,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('Nilai_Alternatif/data_nilai_alternatif', [
                'menu' => 'Data Nilai Alternatif',
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

    public function tambahDataNilaiAlternatif()
    {
        // Validasi pengecekan apakah variabel sudah terisi
        if(empty($_POST['siswa']) || empty($_POST['kriteria']) || empty($_POST['nilai'])){
            // Membuat default menjadi string kosong agar tidak muncul warning pada tampilan website
            $nis = '';
            $idKriteria = '';
            $nilai = '';
        }else{
            $nis = $_POST['siswa'];
            $idKriteria = $_POST['kriteria'];
            $nilai = $_POST['nilai'];
        }

        $user = $this->sessionService->current();
        try {
            $siswaList = $this->siswaService->getAllSiswa();
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $nilaiAlternatifList = $this->nilaiAlternatifService->getAllNilaiAlternatif();
            $this->nilaiAlternatifService->addNilaiAlternatif($nis, $idKriteria, $nilai);
            View::redirect('/nilai-alternatif');
        } catch (ValidationException $exception) {
            View::render('Nilai_Alternatif/data_nilai_alternatif', [
                'menu' => 'Data Nilai Alternatif',
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

    public function ubahDataNilaiAlternatif()
    {
        // Validasi pengecekan apakah variabel sudah terisi
        if(empty($_POST['siswa']) || empty($_POST['kriteria']) || empty($_POST['nilai'])){
            // Membuat default menjadi string kosong agar tidak muncul warning pada tampilan website
            $nis = '';
            $idKriteria = '';
            $nilai = '';
        }else{
            $nis = $_POST['siswa'];
            $idKriteria = $_POST['kriteria'];
            $nilai = $_POST['nilai'];
        }

        $user = $this->sessionService->current();
        try {
            $siswaList = $this->siswaService->getAllSiswa();
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $nilaiAlternatifList = $this->nilaiAlternatifService->getAllNilaiAlternatif();
            $this->nilaiAlternatifService->updateNilaiAlternatif($nis, $idKriteria, $nilai);
            View::redirect('/nilai-alternatif');
        } catch (ValidationException $exception) {
            View::render('Nilai_Alternatif/data_nilai_alternatif', [
                'menu' => 'Data Nilai Alternatif',
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

    public function hapusDataNilaiAlternatif()
    {
        $nis = $_GET['nis'];
        $idKriteria = $_GET['id'];
        $user = $this->sessionService->current();
        try {
            $siswaList = $this->siswaService->getAllSiswa();
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $nilaiAlternatifList = $this->nilaiAlternatifService->getAllNilaiAlternatif();
            $this->nilaiAlternatifService->deleteNilaiAlternatif($nis, $idKriteria);
            View::redirect('/nilai-alternatif');
        } catch (ValidationException $exception) {
            View::render('Nilai_Alternatif/data_nilai_alternatif', [
                'menu' => 'Data Nilai Alternatif',
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
}
