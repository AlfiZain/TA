<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <a href="" class="btn btn-primary" onclick="printContent('laporanDataSiswa');">Cetak Laporan</a>
                    </div>
                    <div class="box-body table-responsive" id="laporanDataSiswa">
                        <!-- Kop Surat -->
                        <div class="kop-surat row">
                            <div class="logo col-2">
                                <img src="../assets/images/jaya-raya.png" alt="Jaya Raya" class="img-fluid">
                            </div>
                            <div class="kop col-10">
                                <h4 class="fw-bold">PEMERINTAH PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA <br>
                                    DINAS PENDIDIKAN <br>
                                    SEKOLAH MENENGAH KEJURUAN NEGERI 55</h4>
                                <p>Jalan Pademangan Timur VII RT/RW 15/001 Pademangan Jakarta Utara <br>
                                    Telp. 021-6412787, Faximile: 021-6412787 | Website: www.smkn55jkt.sch.id, Email: smk.negeri.55jkt@gmail.com <br>
                                    <span class="h6">JAKARTA</span>
                                </p>
                            </div>
                            <hr>
                        </div>
                        <!-- Judul Laporan -->
                        <h4 class="mt-3 text-center">Laporan Data Siswa</h4>
                        <table class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Lahir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($model['siswaList'])) {
                                    foreach ($model['siswaList'] as $siswa) {
                                        // Tampilkan data siswa dalam tabel
                                ?>
                                        <tr>
                                            <td><?= $siswa->getNis(); ?></td>
                                            <td><?= $siswa->getNama(); ?></td>
                                            <td><?= $siswa->getKelas(); ?></td>
                                            <td><?= $siswa->getJenisKelamin(); ?></td>
                                            <td><?= $siswa->getAlamat(); ?></td>
                                            <td><?= $siswa->getTanggalLahir(); ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    // Tampilkan pesan jika $model['siswaList'] kosong
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data siswa.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Tanda Tangan -->
                        <div class="tanda-tangan">
                            <p><span id="tanggal"></span><br>
                                Kepala SMK Negeri 55 Jakarta <br><br><br>
                                A. Djamilah, M.Si <br>
                                NIP 196808291993012002</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>