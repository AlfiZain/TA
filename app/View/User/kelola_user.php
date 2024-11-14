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
            <h3>Kelola User</h3>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <!-- Form tambah user start here -->
                <div class="box flex-fill row" id="formTambahUser" style="display: block;">
                    <div class="box-header">
                        <h4>Tambah Data User</h4>
                    </div>
                    <div class="box-body">
                        <form action="/users/kelola-user/tambah" method="post">
                            <div class="form-group row">
                                <label for="id" class="col-sm-2 col-form-label">ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="id" id="id" placeholder="ID User">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Nama Pengguna">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role" id="role" class="form-control">
                                        <option value='' selected disabled>Pilih Role</option>
                                        <option value='admin'>Admin</option>
                                        <option value='user'>User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                                <i class="fa-regular fa-circle-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Form tambah user end here -->
                <!-- Form ubah user start here -->
                <div class="box flex-fill row" id="formUbahUser" style="display: none;">
                    <div class="box-header">
                        <h4>Ubah Data User</h4>
                    </div>
                    <div class="box-body">
                        <form action="/users/kelola-user/ubah" method="post">
                            <div class="form-group row">
                                <label for="id" class="col-sm-2 col-form-label">ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="id" id="id_ubah" placeholder="ID User" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" id="username_ubah" placeholder="Nama Pengguna">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role" id="role_ubah" class="form-control">
                                        <option value='admin'>Admin</option>
                                        <option value='user'>User</option>
                                    </select>
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
                <!-- Form ubah user end here -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Table Data User</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="tabelDataUser" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                    <th>Reset Password</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($model['userList'])) {
                                    foreach ($model['userList'] as $user) {
                                        // Tampilkan data user dalam tabel
                                ?>
                                        <tr>
                                            <td><?= $user->getId(); ?></td>
                                            <td><?= $user->getUsername(); ?></td>
                                            <td><?= $user->getRole(); ?></td>
                                            <td class="col-sm-2">
                                                <!-- Tombol ubah untuk menampilkan menu ubah dan mengambil data pada tabel -->
                                                <a class="ubahUserButton w-100 btn btn-success" data-id="<?= $user->getId() ?>" data-username="<?= $user->getUsername() ?>" data-role="<?= $user->getRole() ?>">
                                                    Ubah
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                            </td>
                                            <td class="col-sm-2">
                                                <!-- Tombol untuk memunculkan modal konfirmasi Reset Password-->
                                                <a href="#" class="w-100 btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiReset<?= $user->getId(); ?>">
                                                    Reset
                                                    <i class="fa-solid fa-rotate-right"></i>
                                                </a>
                                                <!-- Modal Konfirmasi Reset Password-->
                                                <div class="modal fade" id="modalKonfirmasiReset<?= $user->getId(); ?>" tabindex="-1" aria-labelledby="modalKonfirmasiResetLabel<?= $user->getId(); ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalKonfirmasiResetLabel<?= $user->getId(); ?>">Konfirmasi Pengaturan Ulang Password</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin mengatur ulang password user <?= $user->getUsername(); ?> menjadi <?= $user->getId();?> ? 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a href="/users/kelola-user/reset?id=<?= $user->getId(); ?>" class="btn btn-danger">Reset</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-sm-2">
                                                <!-- Tombol untuk memunculkan modal konfirmasi Penghapusan Data User-->
                                                <a href="#" class="w-100 btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi<?= $user->getId(); ?>">
                                                    Hapus
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                                <!-- Modal Konfirmasi Penghapusan Data User-->
                                                <div class="modal fade" id="modalKonfirmasi<?= $user->getId(); ?>" tabindex="-1" aria-labelledby="modalKonfirmasiLabel<?= $user->getId(); ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalKonfirmasiLabel<?= $user->getId(); ?>">Konfirmasi Penghapusan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data user <?= $user->getUsername(); ?>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a href="/users/kelola-user/hapus?id=<?= $user->getId(); ?>" class="btn btn-danger">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    // Tampilkan pesan jika $model['userList'] kosong
                                    ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data user.</td>
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
    // Script untuk memunculkan dan menyembunyikan form ubah data user
    // Tangkap semua elemen dengan kelas "ubahUserButton"
    var editUserButtons = document.querySelectorAll('.ubahUserButton');

    // Loop melalui setiap tombol ubah user
    editUserButtons.forEach(function(button) {
        // Tambahkan event listener untuk setiap tombol ubah user
        button.addEventListener('click', function(event) {
            // Ambil data DOM dari atribut kustom menggunakan dataset
            var id = this.dataset.id;
            var username = this.dataset.username;
            var role = this.dataset.role;

            // Isi value input data dari variabel DOM
            document.getElementById('id_ubah').value = id;
            document.getElementById('username_ubah').value = username;

            // Mendapatkan referensi ke elemen <select>
            var selectElementRole = document.getElementById('role_ubah');
            // Iterasi melalui semua opsi dalam elemen <select>
            for (var i = 0; i < selectElementRole.options.length; i++) {
                var option = selectElementRole.options[i];
                // Jika nilai opsi sesuai dengan dataset.role, set opsi sebagai selected
                if (option.value === role) {
                    option.selected = true;
                    break; // Keluar dari loop setelah menemukan kecocokan
                } else {
                    option.selected = false;
                }
            }

            // Sembunyikan form tambah user
            formTambahUser.style.display = 'none';
            // Tampilkan form ubah user
            formUbahUser.style.display = 'block';
        });
    });

    // Tangkap tombol "Kembali" di dalam form ubah user
    var backUserButton = document.querySelector('#formUbahUser button.backButton');

    backUserButton.addEventListener('click', function(event) {
        // Tampilkan kembali form tambah user
        formTambahUser.style.display = 'block';
        // Sembunyikan form ubah user
        formUbahUser.style.display = 'none';
    });

    // Data Tables
    $(document).ready(function() {
        var table = $('#tabelDataUser').DataTable({
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