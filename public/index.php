<?php
// Autoloading function
spl_autoload_register(function ($class) {
    // Ubah namespace menjadi path file
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    // Cari file kelas berdasarkan namespace
    $file = __DIR__ . '/../' . $class . '.php';
    require $file;
});

use app\App\Router;
use app\Config\Database;
use app\Controller\HomeController;
use app\Controller\KriteriaController;
use app\Controller\NilaiAlternatifController;
use app\Controller\SiswaTerbaikController;
use app\Controller\SiswaController;
use app\Controller\UserController;
use app\Controller\ReportController;
use app\Middleware\MustLoginMiddleware;
use app\Middleware\MustNotLoginMiddleware;

Database::getConnection();

//Homecontroller
Router::add('GET', '/', HomeController::class, 'index', []);

Router::add('POST', '/users/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);

Router::add('GET', '/users/kelola-user', UserController::class, 'kelolaUser', [MustLoginMiddleware::class]);
Router::add('POST', '/users/kelola-user/tambah', UserController::class, 'tambahUser', [MustLoginMiddleware::class]);
Router::add('POST', '/users/kelola-user/ubah', UserController::class, 'ubahUser', [MustLoginMiddleware::class]);
Router::add('GET', '/users/kelola-user/reset', UserController::class, 'resetPassword', [MustLoginMiddleware::class]);
Router::add('GET', '/users/kelola-user/hapus', UserController::class, 'hapusUser', [MustLoginMiddleware::class]);

Router::add('GET', '/users/profile', UserController::class, 'profile', [MustLoginMiddleware::class]);
Router::add('POST', '/users/profile/ubah', UserController::class, 'postUpdateProfile', [MustLoginMiddleware::class]);

Router::add('GET', '/siswa', SiswaController::class, 'dataSiswa', [MustLoginMiddleware::class]);
Router::add('POST', '/siswa/tambah', SiswaController::class, 'tambahDataSiswa', [MustLoginMiddleware::class]);
Router::add('POST', '/siswa/ubah', SiswaController::class, 'ubahDataSiswa', [MustLoginMiddleware::class]);
Router::add('GET', '/siswa/hapus', SiswaController::class, 'hapusDataSiswa', [MustLoginMiddleware::class]);

Router::add('GET', '/kriteria', KriteriaController::class, 'dataKriteria', [MustLoginMiddleware::class]);
Router::add('POST', '/kriteria/tambah', KriteriaController::class, 'tambahDataKriteria', [MustLoginMiddleware::class]);
Router::add('POST', '/kriteria/ubah', KriteriaController::class, 'ubahDataKriteria', [MustLoginMiddleware::class]);
Router::add('GET', '/kriteria/hapus', KriteriaController::class, 'hapusDataKriteria', [MustLoginMiddleware::class]);

Router::add('GET', '/nilai-alternatif', NilaiAlternatifController::class, 'dataNilaiAlternatif', [MustLoginMiddleware::class]);
Router::add('POST', '/nilai-alternatif/tambah', NilaiAlternatifController::class, 'tambahDataNilaiAlternatif', [MustLoginMiddleware::class]);
Router::add('POST', '/nilai-alternatif/ubah', NilaiAlternatifController::class, 'ubahDataNilaiAlternatif', [MustLoginMiddleware::class]);
Router::add('GET', '/nilai-alternatif/hapus', NilaiAlternatifController::class, 'hapusDataNilaiAlternatif', [MustLoginMiddleware::class]);

Router::add('GET', '/siswa-terbaik/info', SiswaTerbaikController::class, 'info', [MustLoginMiddleware::class]);
Router::add('GET', '/siswa-terbaik/perhitungan', SiswaTerbaikController::class, 'perhitungan', [MustLoginMiddleware::class]);
Router::add('GET', '/siswa-terbaik/peringkat', SiswaTerbaikController::class, 'peringkat', [MustLoginMiddleware::class]);

Router::add('GET', '/report/report-siswa', ReportController::class, 'reportSiswa', [MustLoginMiddleware::class]);
Router::add('GET', '/report/report-kriteria', ReportController::class, 'reportKriteria', [MustLoginMiddleware::class]);
Router::add('GET', '/report/report-nilai-alternatif', ReportController::class, 'reportNilaiAlternatif', [MustLoginMiddleware::class]);
Router::add('GET', '/report/report-siswa-terbaik', ReportController::class, 'reportSiswaTerbaik', [MustLoginMiddleware::class]);

Router::add('GET', '/users/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
Router::run();
