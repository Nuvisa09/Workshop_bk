<?php
$kode = $_GET['id'];
$sql = $koneksi->query("SELECT * FROM daftar_poli WHERE id='$kode'");
$data = $sql->fetch_assoc();
?> 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"> 
            <h1>Daftar Poli</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Poli</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-5">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Daftar Poli</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="daftar_poli_act.php?id=<?=$data['id'];?>" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Rekam Medis</label>
                    <input type="teks" class="form-control" id="exampleInputNoRekam medis" name="no.rm" placeholder="Nomor Rekam Medis" value="<?php echo $data['no_rm'];?>" required> 
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Pilih Poli</label>
                    <input type="teks" class="form-control" id="exampleInputPoli" name="" placeholder="Pilih Poli" value="<?php echo $data['kemasan'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Pilih Jadwal</label>
                    <input type="teks" class="form-control" id="exampleInputJadwal" name="id_jadwal" placeholder="Pilih Jadwal" value="<?php echo $data['harga'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="keluhan" class="form label">Keluhan</label>
                    <textarea class="form-control" id="keluhan" rows="3" name="keluhan"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="edit" class="btn btn-primary float-right"><i class="fas fa-save"> </i> Save</button>
                  <a href="?page=daftar_poli" class="btn btn-danger"><i class="fas fa-undo"></i> Cancel </a>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (left) -->
          <div class="col-7">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Riwayat Daftar Poli</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Poli</th>
                    <th>Dokter</th>
                    <th>Hari</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Antrian</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "../conf/koneksi_dua.php";
                    $no = 1;
                    $sql = $koneksi->query ("SELECT *FROM daftar_poli");
                    while ($data = $sql->fetch_assoc()){

                    ?>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['kemasan']; ?></td>
                        <td><?php echo $data['harga']; ?></td>
                        <td><?php echo $data['kemasan']; ?></td>
                        <td><?php echo $data['harga']; ?></td>
                        <td><?php echo $data['harga']; ?></td>

                        <td>
                            <a href="?page=detail_poli" class="btn btn-success"><i class="fas fa-edit"></i> Detail</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
          
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>