<div class="wrapper">
    <aside id="sidebar" class="js-sidebar">
        <!-- Content For Sidebar -->
        <div class="h-100">
            <div class="sidebar-logo">
                <a href="/"><?= $model['title']; ?></a>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Navigasi Utama
                </li>
                <li class="sidebar-item">
                    <a href="/" class="sidebar-link">
                        <i class="fa-solid fa-house pe-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed" data-bs-target="#data" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-database pe-2"></i>
                        Data
                    </a>
                    <ul id="data" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/siswa" class="sidebar-link"><i class="fa-solid fa-database px-2"></i>Data Siswa</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/kriteria" class="sidebar-link"><i class="fa-solid fa-database px-2"></i>Data Kriteria</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/nilai-alternatif" class="sidebar-link"><i class="fa-solid fa-database px-2"></i>Data Nilai Alternatif</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed" data-bs-target="#siswa-terbaik" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-medal pe-2"></i>
                        Siswa Terbaik
                    </a>
                    <ul id="siswa-terbaik" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/siswa-terbaik/info" class="sidebar-link"><i class="fa fa-question px-2"></i>Info Weighted Product</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/siswa-terbaik/perhitungan" class="sidebar-link"><i class="fa-solid fa-calculator px-2"></i>Perhitungan</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/siswa-terbaik/peringkat" class="sidebar-link"><i class="fa-solid fa-ranking-star px-2"></i>Peringkat</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed" data-bs-target="#report" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                        Report
                    </a>
                    <ul id="report" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/report/report-siswa" class="sidebar-link"><i class="fa-solid fa-file-lines px-2"></i>Report Siswa</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/report/report-kriteria" class="sidebar-link"><i class="fa-solid fa-file-lines px-2"></i>Report Kriteria</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/report/report-nilai-alternatif" class="sidebar-link"><i class="fa-solid fa-file-lines px-2"></i>Report Nilai Alternatif</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/report/report-siswa-terbaik" class="sidebar-link"><i class="fa-solid fa-file-lines px-2"></i>Report Siswa Terbaik</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
    <div class="main">
        <nav class="navbar navbar-expand px-3 border-bottom">
            <button class="btn" id="sidebar-toggle" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                            <?= $model['user']['name'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="/users/profile" class="dropdown-item">Setting</a>
                            <a href="/users/logout" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>