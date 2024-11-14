<?php

namespace app\Domain;

class Siswa
{
    private string $nis;
    private string $nama;
    private string $kelas;
    private string $jenisKelamin;
    private string $alamat;
    private string $tanggalLahir;

    public function __construct(string $nis, string $nama, string $kelas,
                                string $jenisKelamin, string $alamat, string $tanggalLahir)
    {
        $this->nis = $nis;
        $this->nama = $nama;
        $this->kelas = $kelas;
        $this->jenisKelamin = $jenisKelamin;
        $this->alamat = $alamat;
        $this->tanggalLahir = $tanggalLahir;
    }

    // Getter dan setter untuk properti
    public function getNis()
    {
        return $this->nis;
    }

    public function setNis($nis)
    {
        $this->nis = $nis;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    public function getKelas()
    {
        return $this->kelas;
    }

    public function setKelas($kelas)
    {
        $this->kelas = $kelas;
    }

    public function getJenisKelamin()
    {
        return $this->jenisKelamin;
    }

    public function setJenisKelamin($jenisKelamin)
    {
        $this->jenisKelamin = $jenisKelamin;
    }

    public function getAlamat()
    {
        return $this->alamat;
    }

    public function setAlamat($alamat)
    {
        $this->alamat = $alamat;
    }

    public function getTanggalLahir()
    {
        return $this->tanggalLahir;
    }

    public function setTanggalLahir($tanggalLahir)
    {
        $this->tanggalLahir = $tanggalLahir;
    }
}
?>
