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
            <h3>Data Siswa</h3>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <!-- Form tambah siswa start here -->
                <div class="box flex-fill row" id="formTambahSiswa" style="display: block;">
                    <div class="box-header">
                        <h4>Tambah Data Siswa</h4>
                    </div>
                    <div class="box-body">
                        <form action="/siswa/tambah" method="post">
                            <div class="form-group row">
                                <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nis" id="nis" placeholder="NIS Siswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Siswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kelas" id="kelas">
                                        <option value="">Pilih Kelas</option>
                                        <?php
                                        $kelasOptions = [
                                            'X' => ['TITL' => 3, 'TKRO' => 2, 'TSM' => 1, 'DKV' => 2],
                                            'XI' => ['TITL' => 3, 'TKRO' => 2, 'TSM' => 1, 'DKV' => 2],
                                            'XII' => ['TITL' => 3, 'TKRO' => 2, 'TSM' => 1, 'DKV' => 2]
                                        ];
                                        foreach ($kelasOptions as $tingkat => $jurusanList) {
                                            foreach ($jurusanList as $jurusan => $jumlahKelas) {
                                                for ($i = 1; $i <= $jumlahKelas; $i++) {
                                                    $kelas = "$tingkat-$jurusan-$i";
                                                    echo "<option value=\"$kelas\">$kelas</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Siswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                                <i class="fa-regular fa-circle-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Form tambah siswa end here -->
                <!-- Form ubah siswa start here -->
                <div class="box flex-fill row" id="formUbahSiswa" style="display: none;">
                    <div class="box-header">
                        <h4>Ubah Data Siswa</h4>
                    </div>
                    <div class="box-body">
                        <form action="/siswa/ubah" method="post">
                            <div class="form-group row">
                                <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nis" id="nis_ubah" placeholder="NIS Siswa" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama_ubah" placeholder="Nama Siswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kelas" id="kelas_ubah">
                                        <option value="">Pilih Kelas</option>
                                        <?php
                                        foreach ($kelasOptions as $tingkat => $jurusanList) {
                                            foreach ($jurusanList as $jurusan => $jumlahKelas) {
                                                for ($i = 1; $i <= $jumlahKelas; $i++) {
                                                    $kelas = "$tingkat-$jurusan-$i";
                                                    echo "<option value=\"$kelas\">$kelas</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin_ubah">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" id="alamat_ubah" placeholder="Alamat Siswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir_ubah">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                Ubah
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button type="button" class="backButton btn btn-secondary">
                                Kembali
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Form ubah siswa end here -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Table Data Siswa</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelDataSiswa" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
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
                                            <td class="col-sm-2">
                                                <!-- Tombol ubah untuk menampilkan menu ubah dan mengambil data pada tabel -->
                                                <a class="ubahSiswaButton w-100 btn btn-success" data-nis="<?= $siswa->getNis() ?>" data-nama="<?= $siswa->getNama() ?>" data-kelas="<?= $siswa->getKelas() ?>" data-jenis_kelamin="<?= $siswa->getJenisKelamin() ?>" data-alamat="<?= $siswa->getAlamat() ?>" data-tanggal_lahir="<?= $siswa->getTanggalLahir() ?>">
                                                    Ubah
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                            </td>
                                            <td class="col-sm-2">
                                                <!-- Tombol untuk memunculkan modal konfirmasi -->
                                                <a href="#" class="w-100 btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi<?= $siswa->getNis(); ?>">
                                                    Hapus
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                                <!-- Modal Konfirmasi Penghapusan Data Siswa-->
                                                <div class="modal fade" id="modalKonfirmasi<?= $siswa->getNis(); ?>" tabindex="-1" aria-labelledby="modalKonfirmasiLabel<?= $siswa->getNis(); ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalKonfirmasiLabel<?= $siswa->getNis(); ?>">Konfirmasi Penghapusan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data siswa <?= $siswa->getNama(); ?>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a href="/siswa/hapus?nis=<?= $siswa->getNis(); ?>" class="btn btn-danger">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    // Tampilkan pesan jika $model['siswaList'] kosong
                                    ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data siswa.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    // Script untuk memunculkan dan menyembunyikan form ubah data siswa
    // Tangkap semua elemen dengan kelas "ubahSiswaButton"
    var editSiswaButtons = document.querySelectorAll('.ubahSiswaButton');

    // Loop melalui setiap tombol ubah
    editSiswaButtons.forEach(function(button) {
        // Tambahkan event listener untuk setiap tombol ubah
        button.addEventListener('click', function(event) {
            // Ambil data DOM dari atribut kustom menggunakan dataset
            var nis = this.dataset.nis;
            var nama = this.dataset.nama;
            var kelas = this.dataset.kelas;
            var jenis_kelamin = this.dataset.jenis_kelamin;
            var alamat = this.dataset.alamat;
            var tanggal_lahir = this.dataset.tanggal_lahir;

            // Isi value input data dari variabel DOM
            document.getElementById('nis_ubah').value = nis;
            document.getElementById('nama_ubah').value = nama;
            document.getElementById('kelas_ubah').value = kelas;
            document.getElementById('jenis_kelamin_ubah').value = jenis_kelamin;
            document.getElementById('alamat_ubah').value = alamat;
            document.getElementById('tanggal_lahir_ubah').value = tanggal_lahir;

            // Sembunyikan form tambah siswa
            formTambahSiswa.style.display = 'none';
            // Tampilkan form ubah siswa
            formUbahSiswa.style.display = 'block';
        });
    });

    // Tangkap tombol "Kembali" di dalam form ubah siswa
    var backSiswaButton = document.querySelector('#formUbahSiswa button.backButton');

    backSiswaButton.addEventListener('click', function(event) {
        // Tampilkan kembali form tambah siswa
        formTambahSiswa.style.display = 'block';
        // Sembunyikan form ubah siswa
        formUbahSiswa.style.display = 'none';
    });

    // Data Tables
    $(document).ready(function() {
        var table = $('#tabelDataSiswa').DataTable({
            buttons: [{
                extend: 'colvis',
                text: 'Pengaturan Kolom'
            }],
            dom: "<'row mb-3'<'col-md-4'l><'col-md-4'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ]
        });
    });
</script>
