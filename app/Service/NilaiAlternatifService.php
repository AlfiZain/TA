<?php

namespace app\Service;

use app\Domain\NilaiAlternatif;
use app\Exception\ValidationException;
use app\Repository\NilaiAlternatifRepository;

class NilaiAlternatifService
{
    private NilaiAlternatifRepository $nilaiAlternatifRepository;
    private KriteriaService $kriteriaService;
    private SiswaService $siswaService;

    public function __construct(NilaiAlternatifRepository $nilaiAlternatifRepository, SiswaService $siswaService ,KriteriaService $kriteriaService)
    {
        $this->nilaiAlternatifRepository = $nilaiAlternatifRepository;
        $this->siswaService = $siswaService;
        $this->kriteriaService = $kriteriaService;
    }

    public function addNilaiAlternatif($nis, $idKriteria, $nilai): NilaiAlternatif
    {
        // Validasi input
        if (empty($nis) || empty($idKriteria) || empty($nilai)) {
            throw new ValidationException("NIS, ID Kriteria, and Nilai tidak bisa kosong");
        }

        if($nilai <1 || $nilai >5){
            throw new ValidationException("Nilai harus bilangan positif 1-5");
        }

        try {
            // Periksa apakah siswa dengan nis dan kriteria dengan ID yang diberikan ada
            $siswa = $this->siswaService->getByNis($nis);
            if (!$nis) {
                throw new ValidationException("Siswa dengan NIS tersebut tidak ditemukan");
            }
            $kriteria = $this->kriteriaService->getById($idKriteria);
            if (!$kriteria) {
                throw new ValidationException("Kriteria dengan ID tersebut tidak ditemukan");
            }

            // Periksa apakah nilai sudah ada
            $nilaiAlternatif = $this->nilaiAlternatifRepository->findByNisAndIdKriteria($nis, $idKriteria);

            if ($nilaiAlternatif) {
                throw new ValidationException("Nilai Alternatif sudah diisi, silahkan tekan tombol ubah jika ingin merubah");
            }

            // Buat instance NilaiAlternatif baru
            $nilaiAlternatif = new NilaiAlternatif($nis, $idKriteria, $nilai);

            // Simpan NilaiAlternatif ke dalam database
            return $this->nilaiAlternatifRepository->save($nilaiAlternatif);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function updateNilaiAlternatif($nis, $idKriteria, $nilai): NilaiAlternatif
    {
        // Validasi input
        if (empty($nis) || empty($idKriteria) || empty($nilai)) {
            throw new ValidationException("NIS, ID Kriteria, and Nilai tidak bisa kosong");
        }

        if($nilai <1 || $nilai >5){
            throw new ValidationException("Nilai harus bilangan positif 1-5");
        }

        try {
            // Temukan NilaiAlternatif berdasarkan NIS dan ID Kriteria
            $nilaiAlternatif = $this->nilaiAlternatifRepository->findByNisAndIdKriteria($nis, $idKriteria);

            // Validasi NilaiAlternatif
            if (!$nilaiAlternatif) {
                throw new ValidationException("Nilai Alternatif tidak ditemukan");
            }

            // Update NilaiAlternatif
            $nilaiAlternatif->setNilai($nilai);

            // Simpan perubahan NilaiAlternatif ke dalam database
            return $this->nilaiAlternatifRepository->update($nilaiAlternatif);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function deleteNilaiAlternatif(string $nis, string $idKriteria): void
    {
        try {
            // Panggil method delete dari NilaiAlternatifRepository
            $this->nilaiAlternatifRepository->delete($nis, $idKriteria);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function getByNisAndIdKriteria(string $nis, string $idKriteria): ?NilaiAlternatif
    {
        try {
            // Panggil method dari NilaiAlternatifRepository untuk mendapatkan NilaiAlternatif berdasarkan NIS dan ID Kriteria
            return $this->nilaiAlternatifRepository->findByNisAndIdKriteria($nis, $idKriteria);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function getAllNilaiAlternatif(): array
    {
        try {
            // Panggil method dari NilaiAlternatifRepository untuk mengambil semua data NilaiAlternatif
            return $this->nilaiAlternatifRepository->findAllNilaiAlternatif();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
