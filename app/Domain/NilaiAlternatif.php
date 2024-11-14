<?php
namespace app\Domain;

class NilaiAlternatif {
    private $nis;
    private $idKriteria;
    private $nilai;

    public function __construct($nis, $idKriteria, $nilai) {
        $this->nis = $nis;
        $this->idKriteria = $idKriteria;
        $this->nilai = $nilai;
    }

    public function getNis() {
        return $this->nis;
    }

    public function setNis($nis) {
        $this->nis = $nis;
    }

    public function getIdKriteria() {
        return $this->idKriteria;
    }

    public function setIdKriteria($idKriteria) {
        $this->idKriteria = $idKriteria;
    }

    public function getNilai() {
        return $this->nilai;
    }

    public function setNilai($nilai) {
        $this->nilai = $nilai;
    }
}