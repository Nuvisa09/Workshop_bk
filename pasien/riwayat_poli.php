<?php
include_once("../conf/koneksi_dua.php");
session_start();

if(isset($_SESSION['signup'])){
    $_SESSION['signup'] = true;
}else{
    echo"<meta http-equiv='refresh' content='0; url=..'>";
    die();
}
$id_pasien = $_SESSION['id'];
$no_rm = $_SESSION['no_rm'];
$nama = $_SESSION['username'];
// $akses = $_SESSION['akses'];


// if($akses != 'pasien'){
//     echo"<meta http-equiv='refresh' content='0; url=..'>";
//     die();
// }

if(isset($_POST['submit'])){
    if($_POST['id_jadwal'] == "900"){
        echo "
            <script>
                alert (' Jadwal tidak boleh kosong!');            
            </script>
        ";
        echo "<meta http-equiv='refresh' content='0>";
    }
    if (daftarPoli($_POST)>0){
        echo "
            <script>
                alert (' berhasil mendaftar poli');            
            </script>
        ";
    }
}
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 >Daftar Poli</h3> -->
                <!-- <a href="?page=tambah_obat" class="btn btn-primary"> Add obat</a> -->
              </div>
              <!-- /.card-header -->
                         <!-- general form elements -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Poli</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $id_pasien?>" name="id_pasien">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="no_rm">Nomor Rekam Medis</label>
                                <input type="teks" class="form-control" id="exampleInputNamaObat" name="no_rm" placeholder="Nomor Rekam Medis" value="<?=$no_rm?>" required> 
                            </div>
                            <div class="mb-3">
                                <label for="inputpoli" class="form-label">Plih Poli</label>
                                <select id="inputpoli" class="form-control">
                                    <option>Open this Select menu</option>
                                    <?php
                                    $data = $koneksi->prepare("SELECT * FROM poli");
                                    $data->execute();
                                    if($data->rowCount()==0){
                                        echo "<option>Tidak ada Poli</option>";
                                    }else{
                                        while ($d = $data->fetch()){
                                    ?>
                                        <option value="<?=$d['id']?>"><?= $d['nama_poli']?></option>
                                    <?php
                                        }
                                    }
                                    ?>                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputJadwal" class="form-label">Pilih Jadwal</label>
                                <select id="inputJadwal"class="form-control" name="id_jadwal">
                                    <option value="900">Open this Select menu</option>
                                </select>
                                
                            </div>
                            <div class="mb-3">
                                <label for="keluhan" class="form label">Keluhan</label>
                                <textarea class="form-control" id="keluhan" rows="3" name="keluhan"></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
                        <a href="?page=home" class="btn btn-danger"><i class="fas fa-undo"></i> Cancel </a>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col">
                <div class="card-body">
                    <h5 class="card-header bg-primary">Riwayat Daftar Poli</h5>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>  
                    <th>Poli</th>
                    <th>Daftar</th>
                    <th>Hari</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Antrian</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $poli = $koneksi->prepare("SELECT  d.nama_poli as poli_nama,
                                                      c.nama as dokter_nama,
                                                      b.hari as jadwal_hari,
                                                      b.jam_mulai as jadwal_mulai,
                                                      b.jam_selesai as jadwal_selesai,
                                                      a.no_antrian as antrian,
                                                      a.id as poli_id
                                                      
                                                      FROM daftar poli as a
                                                      
                                                      INNER JOIN jadwal_periksa as b
                                                        ON a.id_jadwal = b.id
                                                      INNER JOIN dokter as c
                                                        ON b.id_dokter = c.id
                                                      INNER JOIN poli as d
                                                        ON c.id_poli = d.id
                                                      WHERE a.id_pasien =$id_pasien
                                                      ORDER BY a.id desc");
                    $poli->execute();
                    $no = 0;
                    if($poli->rowCount()==0){
                        echo "Tidak ada data";
                    }else{
                        while($p = $poli->fetch()){
                    ?>
                    <tr >
                        <th scope= "row">
                          <?php
                            ++$no;
                            if($no == 1 ){
                                echo "<span class='badge badge-info'>New</span>";
                            }else{
                                echo $no;
                            }
                        ?>
                        </th>
                        <td><? $p['poli_nama'] ?></td>
                        <td><? $p['dokter_nama']  ?></td>
                        <td><? $p['jadwal_hari']  ?></td>
                        <td><? $p['jadwal_mulai'] ?></td>
                        <td><? $p['jadwal_selesai']  ?></td>
                        <td><? $p['antrian']  ?></td>
                        <td>
                            <a href="detail_poli.php/<?=$p['poli_id']?>">
                                <button class="btn btn-success btn-sm">Detail</button>
                            </a>                        
                        </td>
                    </tr>
                    <?php 
                        }
                    }
                    ?>
                  
                  </tbody>
                </table>
              </div>
            <!-- /.card -->
              </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    document.getElementById('inputpoli').addEventListener('change',function (){
        var poliId = this.value; //Ambil nilai ID poli yang dipilih
        loadJadwal(poliId); // panggil fungsi untuk memuat jadwal dokter
    });

    function loadJadwal (poliId){
        //but objek XMLHttpRequest
        var xhr = new XMLHttpRequest();

        //konfigurasi permintaan Ajax
        xhr.open('GET','http://localhost/workshop_bk/pasien/get_jadwal.php?poli_id=' +poliId, true);

        //atur fungsi callback ketika permintaan selesai
        xhr.onload = function(){
            if (xhr.status ===200){
                //jika permintaan berhasil, perbarui opsi pada select pilih jadwal
                document.getElementById('inputJadwal').innerHTML = xhr.responseText;
            }
        };
        //kirim permintaan
        xhr.send();
    }

</script> 

