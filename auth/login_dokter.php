<?php

include_once("../conf/koneksi_dua.php");


// Cek apakah pengguna sudah login, jika iya, redirect
if (isset($_SESSION['login'])){
    echo "<meta http-equiv='refresh' content='0; url=..'>";
    die();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rumah Sakit | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Dokter</b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama" value="Alpin" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="alamat" value="semarang" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php if (isset ($_SESSION['error'])):?>
            <p><?php echo $_SESSION['error']; unset($_SESSION['error']);?></p>
        <?php endif ?>
        <div class="row">
          <!-- <div class="col-8">
            <div class="mb-0">
                <a href="register.php" class="text-center">Register a new account</a>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-4">
            <button name="submit" type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    $username = stripslashes($_POST['nama']);
    $password = $_POST['alamat'];
    if($username == 'admin'){
        if ($password == 'admin'){
            $_SESSION['login'] = true;
            $_SESSION['id'] = null;
            $_SESSION['username'] = 'admin';
            $_SESSION['akses'] = 'admin';
            echo "<meta http-equiv='refresh' content='0; url=../admin/home.php'>";
            die();
        }
    } else{
        $cek_username = $pdo->prepare("SELECT * FROM dokter WHERE nama = '$username';");
        try{
            $cek_username->execute();
            if ($cek_username->rowCount()==1){
                $baris = $cek_username->fetchAll(PDO::FETCH_ASSOC);
                if($password ==$baris[0]['alamat']){
                    $_SESSION['login']=true;
                    $_SESSION['id'] = $baris[0]['id'];
                    $_SESSION['username'] = $baris[0]['nama'];
                    $_SESSION['no_rm'] = $baris[0]['no_rm'];
                    $_SESSION['akses']= 'pasien';
                    echo "<meta http-equiv='refresh' content='0; url=../dokter/home.php'>";
                    die();
                }
            }
        } catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
            echo "<meta http-equiv='refresh' content='0; >";
            die();
        }
    }
    $_SESSION['error'] = 'Username dan Password Tidak Cocok';
    echo "<meta http-equiv='refresh' content='0; ";
    die();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

?> 