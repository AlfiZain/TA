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
            <h3>Data Nilai Alternatif</h3>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <!-- Form tambah nilai alternatif start here -->
                <div class="box flex-fill row" id="formTambahNilaiAlternatif" style="display: block;">
                    <div class="box-header">
                        <h4>Tambah Data Nilai Alternatif</h4>
                    </div>
                    <div class="box-body">
                        <form action="/nilai-alternatif/tambah" method="post">
                            <div class="form-group row">
                                <label for="siswa" class="col-sm-2 col-form-label">Siswa</label>
                                <div class="col-sm-10">
                                    <select name="siswa" id="siswa" class="form-control">
                                        <?php
                                        if (!empty($model['siswaList'])) {
                                            echo "<option value='' selected disabled>Pilih Siswa</option>";
                                            foreach ($model['siswaList'] as $siswa) {
                                        ?>
                                                <option value="<?= $siswa->getNis() ?>"><?= $siswa->getNis() . " - " . $siswa->getNama() ?></option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option selected disabled>Tidak Ada Data Siswa</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Kriteria" class="col-sm-2 col-form-label">Kriteria</label>
                                <div class="col-sm-10">
                                    <select name="kriteria" id="kriteria" class="form-control">
                                        <?php
                                        if (!empty($model['kriteriaList'])) {
                                            echo "<option value='' selected disabled>Pilih Kriteria</option>";
                                            foreach ($model['kriteriaList'] as $kriteria) {
                                        ?>
                                                <option value="<?= $kriteria->getId() ?>"><?= $kriteria->getId() . " - " . $kriteria->getNama() ?></option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option selected disabled>Tidak Ada Data Kriteria</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nilai" class="col-sm-2 col-form-label">Nilai Alternatif</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nilai" id="nilai" placeholder="Bilangan Positif 1-5">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                                <i class="fa-regular fa-circle-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Form tambah nilai alternatif end here -->
                <!-- Form ubah nilai alternatif start here -->
                <div class="box flex-fill row" id="formUbahNilaiAlternatif" style="display: none;">
                    <div class="box-header">
                        <h4>Ubah Data Nilai Alternatif</h4>
                    </div>
                    <div class="box-body">
                        <form action="/nilai-alternatif/ubah" method="post">
                            <div class="form-group row">
                                <label for="siswa" class="col-sm-2 col-form-label">Siswa</label>
                                <div class="col-sm-10">
                                    <select name="siswa" id="siswa_ubah" class="form-control">
                                        <option value="" selected disabled></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kriteria" class="col-sm-2 col-form-label">Kriteria</label>
                                <div class="col-sm-10">
                                    <select name="kriteria" id="kriteria_ubah" class="form-control">
                                        <option value="" selected disabled></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nilai" class="col-sm-2 col-form-label">Nilai Alternatif</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nilai" id="nilai_ubah" placeholder="Bilangan Positif 1-5">
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
                <!-- Form ubah nilai alternatif end here -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Table Data Nilai Alternatif</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelDataNilaiAlternatif" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>NIS Siswa</th>
                                    <th>ID Kriteria</th>
                                    <th>Nilai</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($model['nilaiAlternatifList'])) {
                                    foreach ($model['nilaiAlternatifList'] as $nilaiAlternatif) {
                                        // Tampilkan data nilai alternatif dalam tabel
                                ?>
                                        <tr>
                                            <td><?= $nilaiAlternatif->getNis(); ?></td>
                                            <td><?= $nilaiAlternatif->getIdKriteria(); ?></td>
                                            <td><?= $nilaiAlternatif->getNilai(); ?></td>
                                            <td class="col-sm-2">
                                                <!-- Tombol ubah untuk menampilkan menu ubah dan mengambil data pada tabel -->
                                                <a class="ubahNilaiAlternatifButton w-100 btn btn-success" data-nis="<?= $nilaiAlternatif->getNis() ?>" data-id="<?= $nilaiAlternatif->getIdKriteria() ?>" data-nilai="<?= $nilaiAlternatif->getNilai() ?>">
                                                    Ubah
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                            </td>
                                            <td class="col-sm-2">
                                                <!-- Tombol untuk memunculkan modal konfirmasi -->
                                                <a href="#" class="w-100 btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi<?= $nilaiAlternatif->getNis() . '_' . $nilaiAlternatif->getIdKriteria(); ?>">
                                                    Hapus
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                                <!-- Modal Konfirmasi Penghapusan Data Nilai Alternatif-->
                                                <div class="modal fade" id="modalKonfirmasi<?= $nilaiAlternatif->getNis() . '_' . $nilaiAlternatif->getIdKriteria(); ?>" tabindex="-1" aria-labelledby="modalKonfirmasiLabel<?= $nilaiAlternatif->getNis() . '_' . $nilaiAlternatif->getIdKriteria(); ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalKonfirmasiLabel<?= $nilaiAlternatif->getNis() . '_' . $nilaiAlternatif->getIdKriteria(); ?>">Konfirmasi Penghapusan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data nilai alternatif <?= $nilaiAlternatif->getNis() . " - " . $nilaiAlternatif->getIdKriteria(); ?>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a href="/nilai-alternatif/hapus?nis=<?= $nilaiAlternatif->getNis() . "&id=" . $nilaiAlternatif->getIdKriteria(); ?>" class="btn btn-danger">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    // Tampilkan pesan jika $model['nilaiAlternatif'] kosong
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data nilai alternatif.</td>
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
    // Script untuk memunculkan dan menyembunyikan form ubah data nilai alternatif
    // Tangkap semua elemen dengan kelas "ubahNilaiAlternatifButton"
    var editNilaiAlternatifButtons = document.querySelectorAll('.ubahNilaiAlternatifButton');

    // Loop melalui setiap tombol ubah nilai alternatif
    editNilaiAlternatifButtons.forEach(function(button) {
        // Tambahkan event listener untuk setiap tombol ubah nilai alternatif
        button.addEventListener('click', function(event) {
            // Ambil data DOM dari atribut kustom menggunakan dataset
            var nis = this.dataset.nis;
            var id = this.dataset.id;
            var nilai = this.dataset.nilai;

            // Isi value input data dari variabel DOM
            document.getElementById('nilai_ubah').value = nilai;

            // Mendapatkan referensi ke elemen <select>
            var selectElementSiswa = document.getElementById('siswa_ubah');
            // Buat elemen <option> baru
            var optionElementSiswa = document.createElement('option');
            // Set nilai atribut "value" dan teks keterangan opsi
            optionElementSiswa.value = nis;
            optionElementSiswa.textContent = nis;
            // Tambahkan atribut selected untuk membuat opsi terpilih secara otomatis
            optionElementSiswa.selected = true;
            // Hapus semua opsi sebelumnya (jika ada)
            selectElementSiswa.innerHTML = '';
            // Tambahkan opsi baru ke dalam elemen <select>
            selectElementSiswa.appendChild(optionElementSiswa);

            // Mendapatkan referensi ke elemen <select>
            var selectElementKriteria = document.getElementById('kriteria_ubah');
            // Buat elemen <option> baru
            var optionElementKriteria = document.createElement('option');
            // Set nilai atribut "value" dan teks keterangan opsi
            optionElementKriteria.value = id;
            optionElementKriteria.textContent = id;
            // Tambahkan atribut selected untuk membuat opsi terpilih secara otomatis
            optionElementKriteria.selected = true;
            // Hapus semua opsi sebelumnya (jika ada)
            selectElementKriteria.innerHTML = '';
            // Tambahkan opsi baru ke dalam elemen <select>
            selectElementKriteria.appendChild(optionElementKriteria);


            // Sembunyikan form tambah nilai alternatif
            formTambahNilaiAlternatif.style.display = 'none';
            // Tampilkan form ubah nilai alternatif
            formUbahNilaiAlternatif.style.display = 'block';
        });
    });

    // Tangkap tombol "Kembali" di dalam form ubah nilai alternatif
    var backNilaiAlternatifButton = document.querySelector('#formUbahNilaiAlternatif button.backButton');

    backNilaiAlternatifButton.addEventListener('click', function(event) {
        // Tampilkan kembali form tambah nilai alternatif
        formTambahNilaiAlternatif.style.display = 'block';
        // Sembunyikan form ubah nilai alternatif
        formUbahNilaiAlternatif.style.display = 'none';
    });

    // Data Tables
    $(document).ready(function() {
        var table = $('#tabelDataNilaiAlternatif').DataTable({
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