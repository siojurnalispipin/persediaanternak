<!-- Aplikasi Persediaan Obat pada Apotek
*******************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 1 April 2017
* Website      : www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<?php  
/* panggil file database.php untuk koneksi ke database */
require_once "config/database.php";

// fungsi query untuk menampilkan data dari tabel user
$user_id = $_SESSION['user_id'];
$query = $mysqli->query("SELECT * FROM anggota WHERE user_id = '$user_id'");

// tampilkan data
$data = $query->fetch_assoc();
?>


<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle fa fa-angle-down" data-toggle="dropdown">
    Persediaan
  </a>
  <ul class="dropdown-menu">
 
    <li >
    <a href="?module=daftarpakan">Pakan
  </a>
    </li>
    
    <li>
    <a href="?module=daftarhewan">Ternak
  </a>
    </li>
  </ul>
</li>


<li class="dropdown user user-menu">
  <a href="?module=barangmasuk">Data Pakan & Ternak Masuk
  </a>
</li>

<li class="dropdown user user-menu">
  <a href="?module=barangkeluar">Data Pakan & Ternak Keluar
  </a>
</li>

<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle fa fa-angle-down" data-toggle="dropdown">
    Laporan
  </a>
  <ul class="dropdown-menu">
 
    <li >
    <a href="?module=pakanrusak">Laporan Pakan Kedaluarsa
  </a>
    </li>
    

    <li>
    <a href="?module=hewansakit">Laporan Ternak Sakit
  </a>
    </li>
  </ul>
</li>



<li class="dropdown user user-menu">
  <a href="?module=user">Pengguna
  </a>
</li>


<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <!-- User image -->

  <?php  
  if ($data['photo']=="") { ?>
    <img src="images/user/user.png" class="user-image" alt="User Image"/>
  <?php
  }
  else { ?>
    <img src="images/user/<?php echo $data['photo']; ?>" class="user-image" alt="User Image"/>
  <?php
  }
  ?>

    <span class="hidden-xs"><?php echo $data['fullname']; ?> <i style="margin-left:5px" class="fa fa-angle-down"></i></span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">

      <?php  
      if ($data['photo']=="") { ?>
        <img src="images/user/user-default.png" class="img-circle" alt="User Image"/>
      <?php
      }
      else { ?>
        <img src="images/user/<?php echo $data['photo']; ?>" class="img-circle" alt="User Image"/>
      <?php
      }
      ?>

      <p>
        <?php echo $data['fullname']; ?>
        <small><?php echo $data['acces']; ?></small>
      </p>
    </li>
    
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a style="width:80px" href="?module=profil" class="btn btn-default btn-flat">Profil</a>
      </div>

      <div class="pull-right">
        <a style="width:80px" data-toggle="modal" href="#logout" class="btn btn-default btn-flat">Logout</a>
      </div>
    </li>
  </ul>
</li>