<?php 
  use App\Modules\Pengguna\Models\ModelGroups;
?>

<?= $this->extend('App\Modules\Pengguna\Views\layoutAdmin') ?>
<?= $this->section('content') ?>


    <div class="container form-inline">
        <div class="d-flex justify-content-between"></div>
        <h1 class="text-center mt-2" style="margin-bottom: 2%; ">List Pengguna</h1>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($users as $user) : ?>
                            <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $user->username; ?></td>
                            <td><?= $user->email; ?></td>
                            <td><?= $user->name; ?></td>
                            <td>
                                <a href="<?= base_url('/Pengguna/detail/' . $user->userid); ?>" class="btn btn-success">Detail</a>
                                <a href="<?= base_url('/Pengguna/delete/'. $user->userid); ?>">
                                    <i class="fas fa-trash fa-2x" title="Hapus" style="color:#ff5148"></i>
                                </a>
                                <a href="<?= base_url('/Pengguna/ubah/'. $user->userid); ?>">
                                    <i class="fas fa-edit fa-2x" title="Edit" style="color:#ff5148"></i>
                                </a>
                            </td>
                            
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection('content') ?>