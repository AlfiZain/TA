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
            <h3>Data Kriteria</h3>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <!-- Form tambah kriteria start here -->
                <div class="box flex-fill row" id="formTambahKriteria" style="display: block;">
                    <div class="box-header">
                        <h4>Tambah Data Kriteria</h4>
                    </div>
                    <div class="box-body">
                        <form action="/kriteria/tambah" method="post">
                            <div class="form-group row">
                                <label for="id" class="col-sm-2 col-form-label">ID</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="id" id="id" placeholder="ID Kriteria">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kriteria">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="bobot" id="bobot" placeholder="Bilangan Positif 1-5">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                                <i class="fa-regular fa-circle-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Form tambah kriteria end here -->
                <!-- Form ubah kriteria start here -->
                <div class="box flex-fill row" id="formUbahKriteria" style="display: none;">
                    <div class="box-header">
                        <h4>Ubah Data Kriteria</h4>
                    </div>
                    <div class="box-body">
                        <form action="/kriteria/ubah" method="post">
                            <div class="form-group row">
                                <label for="id" class="col-sm-2 col-form-label">ID</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="id" id="id_ubah" placeholder="ID Kriteria" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama_ubah" placeholder="Nama Kriteria">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="bobot" id="bobot_ubah" placeholder="Bilangan Positif 1-5">
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
                <!-- Form ubah kriteria end here -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Table Data Kriteria</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelDataKriteria" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Bobot</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($model['kriteriaList'])) {
                                    foreach ($model['kriteriaList'] as $kriteria) {
                                        // Tampilkan data kriteria dalam tabel
                                ?>
                                        <tr>
                                            <td><?= $kriteria->getId(); ?></td>
                                            <td><?= $kriteria->getNama(); ?></td>
                                            <td><?= $kriteria->getBobot(); ?></td>
                                            <td class="col-sm-2">
                                                <!-- Tombol ubah untuk menampilkan menu ubah dan mengambil data pada tabel -->
                                                <a class="ubahKriteriaButton w-100 btn btn-success" data-id="<?= $kriteria->getId() ?>" data-nama="<?= $kriteria->getNama() ?>" data-bobot="<?= $kriteria->getBobot() ?>">
                                                    Ubah
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                            </td>
                                            <td class="col-sm-2">
                                                <!-- Tombol untuk memunculkan modal konfirmasi -->
                                                <a href="#" class="w-100 btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi<?= $kriteria->getId(); ?>">
                                                    Hapus
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                                <!-- Modal Konfirmasi Penghapusan Data kriteria-->
                                                <div class="modal fade" id="modalKonfirmasi<?= $kriteria->getId(); ?>" tabindex="-1" aria-labelledby="modalKonfirmasiLabel<?= $kriteria->getId(); ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalKonfirmasiLabel<?= $kriteria->getId(); ?>">Konfirmasi Penghapusan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data kriteria <?= $kriteria->getNama(); ?>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a href="/kriteria/hapus?id=<?= $kriteria->getId(); ?>" class="btn btn-danger">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    // Tampilkan pesan jika $model['kriteriaList'] kosong
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data kriteria.</td>
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
    // Script untuk memunculkan dan menyembunyikan form ubah data kriteria
    // Tangkap semua elemen dengan kelas "ubahKriteriaButton"
    var editKriteriaButtons = document.querySelectorAll('.ubahKriteriaButton');

    // Loop melalui setiap tombol ubah kriteria
    editKriteriaButtons.forEach(function(button) {
        // Tambahkan event listener untuk setiap tombol ubah kriteria
        button.addEventListener('click', function(event) {
            // Ambil data DOM dari atribut kustom menggunakan dataset
            var id = this.dataset.id;
            var nama = this.dataset.nama;
            var bobot = this.dataset.bobot;

            // Isi value input data dari variabel DOM
            document.getElementById('id_ubah').value = id;
            document.getElementById('nama_ubah').value = nama;
            document.getElementById('bobot_ubah').value = bobot;

            // Sembunyikan form tambah kriteria
            formTambahKriteria.style.display = 'none';
            // Tampilkan form ubah kriteria
            formUbahKriteria.style.display = 'block';
        });
    });

    // Tangkap tombol "Kembali" di dalam form ubah kriteria
    var backKriteriaButton = document.querySelector('#formUbahKriteria button.backButton');

    backKriteriaButton.addEventListener('click', function(event) {
        // Tampilkan kembali form tambah kriteria
        formTambahKriteria.style.display = 'block';
        // Sembunyikan form ubah kriteria
        formUbahKriteria.style.display = 'none';
    });

    // Data Tables
    $(document).ready(function() {
        var table = $('#tabelDataKriteria').DataTable({
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