<?php 
namespace app\Domain;

class Kriteria{
    private string $id;
    private string $nama;
    private int $bobot;

    public function __construct(string $id, string $nama, int $bobot)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->bobot = $bobot;
    }

    // Getter dan setter untuk properti
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    public function getBobot()
    {
        return $this->bobot;
    }

    public function setBobot($bobot)
    {
        $this->bobot = $bobot;
    }
}
?>