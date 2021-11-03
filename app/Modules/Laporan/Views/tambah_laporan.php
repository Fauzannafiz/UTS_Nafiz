<?php 
  use App\Modules\Laporan\Models\ModelLaporan;
?>

<?= $this->extend('App\Modules\Laporan\Views\layoutTambah') ?>
<?= $this->section('content') ?>

<div class="container form-inline">
  <div class="d-flex justify-content-between"></div>
  <form method="POST" action="<?= base_url('Laporan/create') ?>" enctype="multipart/form-data">
    <h1 class="text-center mt-2" style="margin-bottom: 2%; ">Tambah Laporan</h1>
    <div class="card mb-4">
    <div class="card-body">
        
        <div class="input-group mb-3">
          <label class="input-group-text" for="SaranaSelect">Sarana</label>
          <select name="id_sarana" id="id_sarana" class="form-control <?= ($validation->hasError('id_sarana')) ? 'is-invalid' : ''; ?>">
            <option selected disabled value="">Pilih...</option>
            <?php
              $laporan = new ModelLaporan();
              $getSarana = $laporan->get_sarana();

              foreach($getSarana as $row) {
            ?>
                <option value="<?php echo $row['id_sarana'] ?>"><?php echo $row['nama_sarana'] ?></option>
              <?php } ?>
          </select>
          <div class="invalid-feedback">
            <?= $validation->getError('id_sarana'); ?>
          </div>
        </div>

        <div class="input-group mb-3">
          <label class="input-group-text" for="CSSelect">Nama CS</label>
          <select name="id_cs" id="id_cs" class="form-control <?= ($validation->hasError('id_cs')) ? 'is-invalid' : ''; ?>">
            <option selected disabled value="">Pilih...</option>
            <?php
              $laporan = new ModelLaporan();
              $getCS = $laporan->get_cs();

              foreach($getCS as $row) {
            ?>
                <option value="<?php echo $row['id_cs'] ?>"><?php echo $row['nama_cs'] ?></option>
              <?php } ?>
          </select>
          <div class="invalid-feedback">
          <?= $validation->getError('id_cs'); ?>
          </div>
        </div>

        <div class="form-group mb-3">
          <input type="text" name="nama" id="nama" value="<?= old('nama') ?>" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama Pelapor" >
          <div class="invalid-feedback">
          <?= $validation->getError('nama'); ?>
          </div>
        </div>

        <div class="form-group mb-3">
          <input type="date" name="tanggal" id="tanggal" value="<?= old('tanggal') ?>" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" >
          <div class="invalid-feedback">
          <?= $validation->getError('tanggal'); ?>
          </div>
        </div>

        <div class="form-group mb-3">
          <input type="text" name="detail" id="detail" value="<?= old('detail') ?>" class="form-control <?= ($validation->hasError('detail')) ? 'is-invalid' : ''; ?>" placeholder="Detail" >
          <div class="invalid-feedback">
          <?= $validation->getError('detail'); ?>
          </div>
        </div>

        <div class="form-group mb-3">
          <input type="text" name="hp_email" id="hp_email" value="<?= old('hp_email') ?>" class="form-control <?= ($validation->hasError('hp_email')) ? 'is-invalid' : ''; ?>" placeholder="No HP/Email" >
          <div class="invalid-feedback">
          <?= $validation->getError('hp_email'); ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="formFile" class="form-label">Upload Screenshot</label>
          <input class="form-control  <?= ($validation->hasError('screenshot')) ? 'is-invalid' : ''; ?>" value="<?= old('screenshot') ?>" type="file" id="screenshot" name="screenshot">
          <div class="invalid-feedback">
            <?= $validation->getError('screenshot'); ?>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <label class="input-group-text" for="Status Select">Status Laporan</label>
          <select name="id_status" id="id_status" class="form-control <?= ($validation->hasError('id_status')) ? 'is-invalid' : ''; ?>" >
            <option selected disabled value="">Pilih...</option>
            <?php
              $laporan = new ModelLaporan();
              $getStatus = $laporan->get_status();

              foreach($getStatus as $row) {
            ?>
                <option value="<?php echo $row['id_status'] ?>"><?php echo $row['status_laporan'] ?></option>
              <?php } ?>
          </select>
          <div class="invalid-feedback">
            <?= $validation->getError('id_status'); ?>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
    
  </form>

  <div class="">
    <a href="<?= base_url('Laporan/') ?>">
      <i class="far fa-window-close fa-2x" style ="position:absolute;top:91px;left:1577px; color:#ff5148"></i>
    </a>
  </div>
  
</div>

<?= $this->endSection('content') ?>