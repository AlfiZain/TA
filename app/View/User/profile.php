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
            <h3>Profile</h3>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Ubah Data User</h4>
                    </div>
                    <div class="box-body">
                        <form method="post" action="/users/profile/ubah">
                            <div class="form-group row">
                                <label for="id" class="col-sm-2 col-form-label">Id</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="id" id="id" readonly value="<?= $model['user']['id'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $model['user']['name'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passwordLama" class="col-sm-2 col-form-label">Password Lama</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="passwordLama" id="passwordLama" placeholder="Password Lama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passwordBaru" class="col-sm-2 col-form-label">Password Baru</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="passwordBaru" id="passwordBaru" placeholder="Password Baru">
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit" >
                                Ubah
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>