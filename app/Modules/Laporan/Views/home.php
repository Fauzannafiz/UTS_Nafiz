<?= $this->extend('App\Modules\Laporan\Views\layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <div class="d-flex justify-content-between">
    <h2>Database Laporan Internet</h2>
    
    <a href="<?= base_url('/LaporanFpdf') ?>">
      <i class="fas fa-file-pdf" aria-current="page"> FPDF</i>
    </a>
    <a href="<?= base_url('/LaporanSpreadsheet') ?>">
      <i class="fas fa-file-excel" aria-current="page"> Spreadsheet</i>
    </a>
    <a href="<?= base_url('/LaporanWord') ?>">
      <i class="fas fa-file-word" aria-current="page"> Word</i>
    </a>
    <a href="<?= base_url('Laporan/tambah') ?>">
      <button class="btn btn-primary">Tambah</button>
    </a>
  </div>

  <table class="table" id="table">
    <thead>
      
      <tr>
        <th scope="col">ID Laporan</th>
        <th scope="col">Sarana</th>
        <th scope="col">Nama CS</th>
        <th scope="col">Nama Pelapor</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Aduan</th>
        <th scope="col">No HP/Email</th>
        <th scope="col">Screenshot</th>
        <th scope="col">Nama File</th>
        <th scope="col">Status Laporan</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      

      <?php foreach ($laporan as $row) : ?>
        <tr>
          <th scope="row"><?= $row['id_laporan'] ?></th>
          <td><?= $row['nama_sarana'] ?></td>
          <td><?= $row['nama_cs'] ?></td>
          <!-- <td> $row['id_sarana'] ?></td>
          <td> $row['id_cs'] ?></td> -->
          <td><?= $row['nama'] ?></td>
          <td><?= $row['tanggal'] ?></td>
          <td><?= $row['detail'] ?></td>
          <td><?= $row['hp_email'] ?></td>
          <td><img src="<?= base_url('uploads/' . $row['screenshot'])?>" height="100px" width="120px"></td>
          <td><a href="<?= base_url('uploads/' . $row['screenshot'])?>"><?= $row['screenshot']?></a></td>
          <td><?= $row['status_laporan'] ?></td>
          <td>
            <a href="<?= base_url('/Laporan/delete') . '/' . $row['id_laporan'] ?>">
              <i class="fas fa-trash fa-2x" title="Hapus" style="color:#ff5148"></i>
            </a>
            <a href="<?= base_url('Laporan/ubah') . '/' . $row['id_laporan'] ?>">
              <i class="fas fa-edit fa-2x" title="Edit" style="color:#ff5148"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
   <?= $pager->links('default', 'bootstrap_pagination') ?>
</div>

<?= $this->endSection('content') ?>