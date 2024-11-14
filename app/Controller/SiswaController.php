<?php

namespace app\Controller;

use app\App\View;
use app\Config\Database;
use app\Exception\ValidationException;
use app\Repository\SessionRepository;
use app\Repository\SiswaRepository;
use app\Repository\UserRepository;
use app\Service\SessionService;
use app\Service\SiswaService;

class SiswaController
{
    private SessionService $sessionService;
    private SiswaService $siswaService;

    public function __construct()
    {
        $connection = Database::getConnection();

        $userRepository = new UserRepository($connection);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $siswaRepository = new SiswaRepository($connection);
        $this->siswaService = new SiswaService($siswaRepository);
    }

    public function dataSiswa()
    {
        $user = $this->sessionService->current();
        try {
            $siswaList = $this->siswaService->getAllSiswa();
            View::render('Siswa/data_siswa', [
                'menu' => 'Data Siswa',
                'siswaList' => $siswaList,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('Siswa/data_siswa', [
                'menu' => 'Data Siswa',
                'siswaList' => [],
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function tambahDataSiswa()
    {
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $jenisKelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $tanggalLahir = $_POST['tanggal_lahir'];

        $user = $this->sessionService->current();
        try {
            $this->siswaService->addSiswa($nis, $nama, $kelas, $jenisKelamin, $alamat, $tanggalLahir);
            View::redirect('/siswa');
        } catch (ValidationException $exception) {
            $siswaList = $this->siswaService->getAllSiswa();
            View::render('Siswa/data_siswa', [
                'menu' => 'Data Siswa',
                'siswaList' => $siswaList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function ubahDataSiswa()
    {
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $jenisKelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $tanggalLahir = $_POST['tanggal_lahir'];

        $user = $this->sessionService->current();
        try {
            $this->siswaService->updateSiswa($nis, $nama, $kelas, $jenisKelamin, $alamat, $tanggalLahir);
            View::redirect('/siswa');
        } catch (ValidationException $exception) {
            $siswaList = $this->siswaService->getAllSiswa();
            View::render('Siswa/data_siswa', [
                'menu' => 'Data Siswa',
                'siswaList' => $siswaList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function hapusDataSiswa()
    {
        $nis = $_GET['nis'];
        $user = $this->sessionService->current();
        try {
            $this->siswaService->deleteSiswa($nis);
            View::redirect('/siswa');
        } catch (ValidationException $exception) {
            $siswaList = $this->siswaService->getAllSiswa();
            View::render('Siswa/data_siswa', [
                'menu' => 'Data Siswa',
                'siswaList' => $siswaList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }
}

?>
