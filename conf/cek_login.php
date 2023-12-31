<?php 

include 'koneksi.php';

if (isset($_POST['login'])){
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM  admin WHERE username='$user' AND password='$pass'");

    $data = mysqli_fetch_array($query);
    $username = $data['username'];
    $password = $data['password'];
    $level = $data ['level'];

    if($user==$username && $pass==$password){

        session_start();
        $_SESSION['nama'] = $username;
        $_SESSION['level'] = $level;

        if ($level === 'admin'){
            echo "<script> alert ('Anda berhasil login. Sebagai : $level'); </script> " ;
            echo "<meta http-equiv='refresh' content='0; url=../admin/home.php'>";
        }elseif($level === 'dokter'){
            echo "<script> alert ('Anda berhasil login. Sebagai : $level'); </script> " ;
            echo "<meta http-equiv='refresh' content='0; url=../dokter/home.php'>";
        }elseif($level === 'pasien') {
            echo "<script> alert ('Anda berhasil login. Sebagai : $level'); </script> " ;
            echo "<meta http-equiv='refresh' content='0; url=../pasien'>";
        }
    }else{
        echo "<script> alert ('Username dan Password Tidak Ditemukan'); </script> " ;
        echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
    }

    
}

?>
