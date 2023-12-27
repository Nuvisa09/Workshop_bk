<?php

session_start();
if(!isset($_SESSION['nama']))
{
  header('location:../index.php');
}
if(isset($_GET['keluar'])){
  session_destroy();
  header('location:../index.php');
}
?>

<?php 

include '../template/topmenu.php';
include '../template/sidemenu.php';
include '../conf/koneksi_dua.php';

?>

<?php

error_reporting(0);
switch($_GET['page']){
  default:
      include 'dashboard.php';
      break;

  case 'list_obat';
      include 'list_obat.php';
      break;

  case 'tambah_obat';
      include 'tambah_obat.php';
      break;

  case 'edit_obat';
      include 'edit_obat.php';
      break;

  case 'hapus_obat';
      include 'hapus_obat.php';
      break;
}

?>

<?php
include '../template/footer.php';
?>
  