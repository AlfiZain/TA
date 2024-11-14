<?php 
namespace app\Service;

use app\Config\Database;
use app\Repository\SiswaRepository;
use app\Repository\KriteriaRepository;
use app\Repository\NilaiAlternatifRepository;

class SiswaTerbaikService{
    private \PDO $connection;
    private KriteriaRepository $kriteriaRepository;
    private SiswaRepository $siswaRepository;
    private NilaiAlternatifRepository $nilaiAlternatifRepository;
    private $siswaList;
    private $kriteriaList;
    private $nilaiAlternatifList;

    public function __construct() {
        // Buat koneksi database
        $this->connection = Database::getConnection();

        // Inisialisasi repository
        $this->kriteriaRepository = new KriteriaRepository($this->connection);
        $this->siswaRepository = new SiswaRepository($this->connection);
        $this->nilaiAlternatifRepository = new NilaiAlternatifRepository($this->connection);

        // Ambil data dari database
        $this->siswaList = $this->siswaRepository->findAllSiswa();
        $this->kriteriaList = $this->kriteriaRepository->findAllKriteria();
        $this->nilaiAlternatifList = $this->nilaiAlternatifRepository->findAllNilaiAlternatif();
    }

    public function getSumW() {
        $totalBobot = 0;
        // Mencari total bobot (sum Wj)
        foreach($this->kriteriaList as $kriteria){
            $totalBobot += $kriteria->getBobot();
        }
        return $totalBobot;
    }

    public function getNormalizedW(): array
    {
        $normalizedW = [];
        foreach($this->kriteriaList as $kriteria){
            $normalizedW[] = $kriteria->getBobot() / $this->getSumW();
        }
        return $normalizedW;
    }

    public function getS(): array
    {
        // Mengurutkan nilai alternatif berdasarkan id kriteria terkecil
        usort($this->nilaiAlternatifList, function($a, $b) {
            return $a->getIdKriteria() - $b->getIdKriteria();
        });

        $normalizedW = $this->getNormalizedW();
        $sList = [];

        // Menghitung nilai V untuk setiap siswa
        foreach($this->siswaList as $siswa){    
            $weightedProduct = 1;
            $currentIndex = 0;

            foreach($this->nilaiAlternatifList as $nilaiAlternatif){
                if($nilaiAlternatif->getNis() == $siswa->getNis()){
                    $nilaiAlternatif->getNilai();
                    $normalizedW[$currentIndex];
                    $weightedProduct *= pow($nilaiAlternatif->getNilai(), $normalizedW[$currentIndex]);
                    $currentIndex++;
                }
            }
            $sList[$siswa->getNis()] = $weightedProduct;
        }
        return $sList;
    }

    public function getSumS(){
        $totalS = 0;
        $sList = $this->getS();
        // Mencari total bobot (sum Wj)
        foreach($sList as $s){
            $totalS += $s;
        }
        $totalS;
        return $totalS;
    }

    public function getV(){
        $totalS = $this->getSumS();
        $sList = $this->getS();
        $vList = [];
        foreach($sList as $nis => $s){
            $vList[$nis] = $s / $totalS;
        }
        return $vList;
    }

    public function getPeringkat(): array
    {
        $vList = $this->getV();
        // Gabungkan siswa dengan nilai v ke dalam satu array
        $siswaVList = [];
        foreach ($this->siswaList as $siswa) {
            $nis = $siswa->getNis();
            $siswaVList[] = [
                'nama' => $siswa->getNama(),
                'v' => isset($vList[$nis]) ? $vList[$nis] : 0,
                'nis' => $nis
            ];
        }
        // Urutkan array berdasarkan nilai v secara menurun
        usort($siswaVList, function ($a, $b) {
            return $b['v'] <=> $a['v'];
        });
        return $siswaVList;
    }
}
?>