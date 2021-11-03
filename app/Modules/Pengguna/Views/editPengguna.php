<?php
    use App\Modules\Pengguna\Models\ModelGroups;
?>

<?= $this->extend('App\Modules\Pengguna\Views\layoutTambah') ?>
<?= $this->section('content') ?>

<div class="container">
  <div class="d-flex justify-content-between"></div>
  <form method="POST" action="<?= base_url('Pengguna/edit') . '/' . $groups['user_id'] ?>" enctype="multipart/form-data">
    <h1 class="text-center mt-2" style="margin-bottom: 2%; ">Edit Role</h1>
    <div class="card mb-4">
      <div class="card-body">
        
        <div class="input-group mb-3">
          <label class="input-group-text" for="SaranaSelect">Role</label>
          <select name="role" id="role" class="form-control" required>
            <option selected disabled value="">Pilih...</option>
            <?php
              $groups = new ModelGroups();
              $getGroups = $groups->get_groups();

              foreach($getSarana as $row) {
            ?>
                <option value="<?php echo $row['group_id'] ?>"><?php echo $row['group_id'] ?></option>
              <?php } ?>
          </select>
        </div>

      </div>
    </div>
    <button type="submit" class="btn btn-warning">Edit</button>
  </form>
  <div class="">
    <a href="<?= base_url('Pengguna/') ?>">
      <i class="far fa-window-close fa-2x" title="Batal" style ="position:absolute;top:91px;left:1577px; color:#ff5148"></i>
    </a>
  </div>
</div>

<?= $this->endSection('content') ?>