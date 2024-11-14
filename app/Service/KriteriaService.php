<?php

namespace app\Service;

use app\Domain\Kriteria;
use app\Exception\ValidationException;
use app\Repository\KriteriaRepository;

class KriteriaService
{
    private KriteriaRepository $kriteriaRepository;

    public function __construct(KriteriaRepository $kriteriaRepository)
    {
        $this->kriteriaRepository = $kriteriaRepository;
    }

    public function addKriteria($id, $nama, $bobot): Kriteria
    {
        // Validasi input
        if (empty($id) || empty($nama) || empty($bobot)) {
            throw new ValidationException("ID, Nama, and Bobot tidak bisa kosong");
        }

        if($bobot <1 || $bobot >5){
            throw new ValidationException("Bobot harus bilangan positif 1-5");
        }

        try {
            // Cek apakah kriteria dengan id yang sama sudah ada
            $existingKriteria = $this->kriteriaRepository->findByIdKriteria($id);
            if ($existingKriteria !== null) {
                throw new ValidationException("Kriteria dengan ID tersebut sudah ada");
            }

            // Buat instance kriteria baru
            $kriteria = new Kriteria($id, $nama, $bobot);

            // Simpan kriteria ke dalam database
            return $this->kriteriaRepository->save($kriteria);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function updateKriteria($id, $nama, $bobot): Kriteria
    {
        // Validasi input
        if (empty($id) || empty($nama) || empty($bobot)) {
            throw new ValidationException("ID, Nama, and Bobot tidak bisa kosong");
        }

        if($bobot <1 || $bobot >5){
            throw new ValidationException("Bobot harus bilangan positif 1-5");
        }

        try {
            // Temukan kriteria berdasarkan ID
            $kriteria = $this->kriteriaRepository->findByIdKriteria($id);

            // Validasi kriteria
            if (!$kriteria) {
                throw new ValidationException("Kriteria tidak terdaftar");
            }

            // Update kriteria
            $kriteria->setNama($nama);
            $kriteria->setBobot($bobot);

            // Simpan perubahan kriteria ke dalam database
            return $this->kriteriaRepository->update($kriteria);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function deleteKriteria(string $id): void
    {
        try {
            // Panggil method delete dari KriteriaRepository
            $this->kriteriaRepository->delete($id);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function getById($id): ?Kriteria
    {
        try {
            return $this->kriteriaRepository->findByIdKriteria($id);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function getAllKriteria(): array
    {
        try {
            // Panggil method dari KriteriaRepository untuk mengambil semua data kriteria
            return $this->kriteriaRepository->findAllKriteria();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
