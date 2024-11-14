<main class="content px-3 py-2">
    <div class="container-fluid">
        <?php if (isset($model['error'])) { ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    <?= $model['error'] ?>
                </div>
            </div>
        <?php } ?>
        <div class="mb-3">
            <h3>Peringkat Siswa Terbaik</h3>
            <h6>
                <?php
                if (!empty($model['peringkatSiswa'])) {
                    $peringkatSiswa = $model['peringkatSiswa'];
                    $namaPertama = $peringkatSiswa[0]['nama'];
                    echo "Berdasarkan Perhitungan Weighted Product Dengan Kriteria Yang Telah Diisi Sebelumnya Maka Siswa Terbaik Adalah "
                          . $namaPertama;
                } else {
                    echo "Tidak ada data peringkat siswa terbaik";
                }
                ?>
            </h6>
        </div>
        <div class="row">
            <!-- Tabel Peringkat Start Here -->
            <div class="col-12 d-flex mb-3">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Tabel Peringkat Siswa Terbaik</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelVektorV" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>Urutan</th>
                                    <th>Nama</th>
                                    <th>Vektor V</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($model['peringkatSiswa'])) {
                                    // Tampilkan tabel yang sudah diurutkan
                                    foreach ($model['peringkatSiswa'] as $peringkatSiswa) {
                                ?>
                                        <tr>
                                            <td class="col-sm-1"><?= $i; ?></td>
                                            <td><?= $peringkatSiswa['nama']; ?></td>
                                            <td><?= $peringkatSiswa['v']; ?></td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                } else {
                                    // Tampilkan tabel jika $model['siswaList'] kosong
                                    if (empty($model['peringkatSiswa'])) {
                                    ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak Ada Data Peringkat Siswa Terbaik</td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tabel Peringkat End Here -->
        </div>
    </div>
</main>