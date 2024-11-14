<?php

namespace app\Controller;

use app\App\View;
use app\Config\Database;
use app\Exception\ValidationException;
use app\Repository\KriteriaRepository;
use app\Repository\SessionRepository;
use app\Repository\UserRepository;
use app\Service\KriteriaService;
use app\Service\SessionService;

class KriteriaController
{
    private SessionService $sessionService;

    private KriteriaService $kriteriaService;

    public function __construct()
    {
        $connection = Database::getConnection();

        $userRepository = new UserRepository($connection);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $kriteriaRepository = new KriteriaRepository($connection);
        $this->kriteriaService = new KriteriaService($kriteriaRepository);
    }

    public function dataKriteria()
    {
        $user = $this->sessionService->current();
        try {
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            View::render('Kriteria/data_kriteria', [
                'menu' => 'Data Kriteria',
                'kriteriaList' => $kriteriaList,
                'user' => [
                    'name' => $user->getUsername()
                ]
            ]);
        } catch (ValidationException $exception) {
            View::render('Kriteria/data_kriteria', [
                'menu' => 'Data Siswa',
                'kriteriaList' => $kriteriaList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function tambahDataKriteria()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $bobot = $_POST['bobot'];

        $user = $this->sessionService->current();
        try {
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $this->kriteriaService->addKriteria($id, $nama, $bobot);
            View::redirect('/kriteria');
        } catch (ValidationException $exception) {
            View::render('Kriteria/data_kriteria', [
                'menu' => 'Data Kriteria',
                'kriteriaList' => $kriteriaList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function ubahDataKriteria()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $bobot = $_POST['bobot'];

        $user = $this->sessionService->current();
        try {
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $this->kriteriaService->updateKriteria($id, $nama, $bobot);
            View::redirect('/kriteria');
        } catch (ValidationException $exception) {
            View::render('Kriteria/data_kriteria', [
                'menu' => 'Data Kriteria',
                'kriteriaList' => $kriteriaList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function hapusDataKriteria()
    {
        $id = $_GET['id'];
        $user = $this->sessionService->current();   
        try{
            $kriteriaList = $this->kriteriaService->getAllKriteria();
            $this->kriteriaService->deleteKriteria($id);
            View::redirect('/kriteria');
        }catch(ValidationException $exception){
            View::render('Kriteria/data_kriteria', [
                'menu' => 'Data Kriteria',
                'kriteriaList' => $kriteriaList,
                'user' => [
                    'name' => $user->getUsername()
                ],
                'error' => $exception->getMessage()
            ]);
        }
    }
}
