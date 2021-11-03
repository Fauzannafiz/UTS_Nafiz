<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<?= $this->extend('App\Modules\Pengguna\Views\layoutAdmin') ?>
<?= $this->section('content') ?>

    <div class="container form-inline">
        <div class="d-flex justify-content-between"></div>
        <h1 class="text-center mt-2" style="margin-bottom: 2%; ">Detail Pengguna</h1>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="card mb-3" style="max-width: 1540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="<?= base_url('/img/' . $user->user_image); ?>" class="img-fluid rounded-start" alt="<?= $user->username; ?>">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <h4><?= $user->username; ?></h4>
                                    </li>
                                    <?php if($user->fullname) : ?>
                                        <li class="list-group-item">
                                            <h4><?= $user->fullname; ?></h4>
                                        </li>
                                    <?php endif; ?>
                                    <li class="list-group-item">
                                        <h4><?= $user->email; ?></h4>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge bg-<?=($user->name == 'admin') ? 'success' : 'warning' ?>"><?= $user->name;?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <small><a href="<?= base_url('/Pengguna')?>">&laquo; Kembali</a></small>
                                    </li>
                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection('content') ?>