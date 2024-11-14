<?php

namespace app\Service;

use app\Config\Database;
use app\Domain\Siswa;
use app\Exception\ValidationException;
use app\Repository\SiswaRepository;

class SiswaService
{
    private SiswaRepository $siswaRepository;

    public function __construct(SiswaRepository $siswaRepository)
    {
        $this->siswaRepository = $siswaRepository;
    }

    public function addSiswa($nis, $nama, $kelas, $jenisKelamin, $alamat, $tanggalLahir): Siswa
    {
        // Validasi input
        if (empty($nis) || empty($nama) || empty($kelas) || empty($jenisKelamin) || empty($alamat) || empty($tanggalLahir)) {
            throw new ValidationException("NIS, Nama, Kelas, Jenis Kelamin, Alamat, dan Tanggal Lahir tidak bisa kosong");
        }

        try {
            Database::beginTransaction();
            // Cek apakah siswa dengan nis yang sama sudah ada
            $siswa = $this->siswaRepository->findByNisSiswa($nis);
            if ($siswa != null) {
                throw new ValidationException("Siswa dengan NIS tersebut sudah ada");
            }

            // Buat instance siswa baru
            $siswa = new Siswa($nis, $nama, $kelas, $jenisKelamin, $alamat, $tanggalLahir);

            // Simpan siswa ke dalam database
            $this->siswaRepository->save($siswa);

            Database::commitTransaction();
            return $siswa;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function updateSiswa($nis, $nama, $kelas, $jenisKelamin, $alamat, $tanggalLahir): Siswa
    {
        // Validasi input
        if (empty($nis) || empty($nama) || empty($kelas) || empty($jenisKelamin) || empty($alamat) || empty($tanggalLahir)) {
            throw new ValidationException("NIS, Nama, Kelas, Jenis Kelamin, Alamat, dan Tanggal Lahir tidak bisa kosong");
        }

        try {
            Database::beginTransaction();
            // Temukan siswa berdasarkan NIS
            $siswa = $this->siswaRepository->findByNisSiswa($nis);

            // Validasi siswa
            if (!$siswa) {
                throw new ValidationException("Siswa tidak terdaftar");
            }

            // Update siswa
            $siswa->setNis($nis);
            $siswa->setNama($nama);
            $siswa->setKelas($kelas);
            $siswa->setJenisKelamin($jenisKelamin);
            $siswa->setAlamat($alamat);
            $siswa->setTanggalLahir($tanggalLahir);

            // Simpan perubahan siswa ke dalam database
            $this->siswaRepository->update($siswa);

            Database::commitTransaction();
            return $siswa;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function deleteSiswa(string $nis): void
    {
        try {
            Database::beginTransaction();
            // Panggil method delete dari SiswaRepository
            $this->siswaRepository->delete($nis);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function getByNis($nis): ?Siswa
    {
        try {
            return $this->siswaRepository->findByNisSiswa($nis);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function getAllSiswa(): array
    {
        try {
            // Panggil method dari SiswaRepository untuk mengambil semua data siswa
            return $this->siswaRepository->findAllSiswa();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
?>
