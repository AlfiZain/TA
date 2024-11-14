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
            <h3>Perhitungan Weighted Product</h3>
        </div>
        <div class="row">
            <!-- Tabel Alternatif Start Here -->
            <div class="col-12 d-flex mb-3">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Tabel Alternatif</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelAlternatif" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <?php if (!empty($model['kriteriaList'])) : ?>
                                        <?php foreach ($model['kriteriaList'] as $kriteria) : ?>
                                            <!-- Tampilkan data kriteria dalam tabel -->
                                            <th><?= $kriteria->getNama(); ?></th>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <!-- Menutup tr jika $model['kriteriaList'] kosong -->
                                </tr>
                            <?php endif; ?>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($model['siswaList'])) {
                                    // Mengurutkan nilai alternatif berdasarkan id kriteria terkecil
                                    usort($model['nilaiAlternatifList'], function ($a, $b) {
                                        return $a->getIdKriteria() - $b->getIdKriteria();
                                    });

                                    foreach ($model['siswaList'] as $siswa) {
                                        // Tampilkan nis dan nama siswa
                                ?>
                                        <tr>
                                            <td><?= $siswa->getNis(); ?></td>
                                            <td><?= $siswa->getNama(); ?></td>
                                            <?php
                                            if (!empty($model['nilaiAlternatifList'])) {
                                                foreach ($model['kriteriaList'] as $kriteria) {
                                                    // Tampilkan nilai alternatif
                                                    $nilaiFound = false;
                                                    foreach ($model['nilaiAlternatifList'] as $nilaiAlternatif) {
                                                        if ($nilaiAlternatif->getNis() == $siswa->getNis() && $nilaiAlternatif->getIdKriteria() == $kriteria->getId()) {
                                                            $nilaiFound = true;
                                            ?>
                                                            <td><?= $nilaiAlternatif->getNilai(); ?></td>
                                                        <?php
                                                        }
                                                    }
                                                    if (!$nilaiFound) {
                                                        // Jika nilai alternatif tidak ditemukan, tampilkan nilai 0
                                                        ?>
                                                        <td>0</td>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    // Tampilkan pesan jika $model['siswaList'] kosong
                                    ?>
                                    <tr>
                                        <td colspan="<?= count($model['kriteriaList']) + 2 ?>" class="text-center">Tidak ada data siswa.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- Tabel Alternatif End Here -->
            <!-- Tabel Bobot Kriteria Start Here -->
            <div class="col-12 d-flex mb-3">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Tabel Bobot Kriteria (Wj)</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelBobotKriteria" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Bobot</th>
                                    <th>Bobot Kriteria (Wj)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (!empty($model['kriteriaList'])) {
                                    foreach ($model['kriteriaList'] as $kriteria) {
                                        // Tampilkan data kriteria dan normalisasi W
                                ?>
                                        <tr>
                                            <td><?= $kriteria->getId(); ?></td>
                                            <td><?= $kriteria->getNama(); ?></td>
                                            <td><?= $kriteria->getBobot(); ?></td>
                                            <?php
                                            if (!empty($model['normalizedW'])) {
                                            ?>
                                                <td><?= $model['normalizedW'][$i]; ?></td>
                                            <?php
                                            } else {
                                                // Tampilkan pesan jika $model['normalizedW'] kosong
                                            ?>
                                                <td>0</td>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    // Tampilkan pesan jika $model['kriteriaList'] kosong
                                        ?>
                                        <td colspan="3" class="text-center">Tidak ada data kriteria.</td>
                                    <?php
                                }
                                    ?>
                                        </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tabel Bobot Kriteria End Here -->
            <!-- Tabel Vektor S Start Here -->
            <div class="col-md-6 d-flex mb-3">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Tabel Vektor S (Si)</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelVektorS" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Vektor S</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (!empty($model['siswaList'])) {
                                    foreach ($model['siswaList'] as $siswa) {
                                        // Tampilkan nama dan vektor S
                                ?>
                                        <tr>
                                            <td><?= $siswa->getNama(); ?></td>
                                            <?php
                                            if (!empty($model['sList'])) {
                                            ?>
                                                <td><?= $model['sList'][$siswa->getNis()]; ?></td>
                                            <?php
                                            } else {
                                                // Tampilkan pesan jika $model['sList'] kosong
                                            ?>
                                                <td>0</td>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    // Tampilkan pesan jika $model['siswaList'] kosong
                                        ?>
                                        <td colspan="1" class="text-center">Tidak ada data siswa.</td>
                                    <?php
                                }
                                    ?>
                                        </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tabel Vektor S End Here -->
            <!-- Tabel Vektor V Start Here -->
            <div class="col-md-6 d-flex mb-3">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Tabel Vektor V (Vi)</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelVektorV" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Vektor V</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (!empty($model['siswaList'])) {
                                    foreach ($model['siswaList'] as $siswa) {
                                        // Tampilkan nama dan vektor S
                                ?>
                                        <tr>
                                            <td><?= $siswa->getNama(); ?></td>
                                            <?php
                                            if (!empty($model['vList'])) {
                                            ?>
                                                <td><?= $model['vList'][$siswa->getNis()]; ?></td>
                                            <?php
                                            } else {
                                                // Tampilkan pesan jika $model['vList'] kosong
                                            ?>
                                                <td>0</td>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    // Tampilkan pesan jika $model['siswaList'] kosong
                                        ?>
                                        <td colspan="1" class="text-center">Tidak ada data siswa.</td>
                                    <?php
                                }
                                    ?>
                                        </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tabel Vektor V End Here -->
        </div>
    </div>
</main>
<script>
    // Data Tables
    $(document).ready(function() {
        var tableConfig = {
            dom: "<'row mb-3'<'col-md-12'l>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ]
        };

        $('#tabelDataSiswa').DataTable(tableConfig);
        $('#tabelAlternatif').DataTable(tableConfig);
        $('#tabelBobotKriteria').DataTable(tableConfig);
        $('#tabelVektorS').DataTable(tableConfig);
        $('#tabelVektorV').DataTable(tableConfig);
    });
</script>
</script>