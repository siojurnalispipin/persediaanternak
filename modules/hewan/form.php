<?php  

if (empty($_GET['alert'])) {
  echo "";
} 
    // jika alert = 1
    // tampilkan pesan Gagal Tambah Hewan Baru
elseif ($_GET['alert'] == 1) {
  echo "<script type='text/javascript'>alert('Gagal !\nHewan dan jenis yang sama telah terdaftar.');</script>";
}
    // jika alert = 2
    // tampilkan pesan Gagal Tambah Hewan Sakit
elseif ($_GET['alert'] == 2) {
  echo "<script type='text/javascript'>alert('Gagal !\nJumlah Hewan sakit yang diinput melebihi stok tersedia.');</script>";
}


// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Daftar Hewan
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=daftarhewan"> Daftar Hewan </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/hewan/proses.php?act=insert" method="POST">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              require_once "config/database.php";
              $user_id = $_SESSION['user_id'];
              // "SELECT transaction_id from barang_masuk order by transaction_id desc limit 1"
              //$query = $mysqli->query("SELECT * from pakan");
              $query = $mysqli->query("SELECT item_id from hewan order by item_id DESC limit 1");
              $data = $query->fetch_assoc();
              $lastid = $data['item_id'];
              $num = (int)$lastid;
             
              $count = $query->num_rows;

              if ($count > 0) {
                  // mengambil data kode_obat
                  //$data = $query->fetch_assoc();
                  $kode_hewan = $num+1;
              } else {
                  $kode_hewan = 70101;
              }

              // buat kode_obat
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Hewan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="item_id" value="<?php echo $kode_hewan; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Hewan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="item_name" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="amount" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="type" value="Pedaging" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value="Pedaging">Pedaging</option>
                    <option value="Bibit">Bibit</option>
                  </select>
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-2 control-label">Harga</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="price" name="price" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                  </div>
                </div>
              </div>
 
              <div class="form-group">
                <label class="col-sm-2 control-label">Gambar</label>
                <div class="col-sm-5">
                  <input type="file" name="item_image">
                  <br/>                
                </div>
              </div>
            </div>

              

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=daftarhewan" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
//utk hean sakit
elseif ($_GET['form']=='add2') { ?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Hewan Sakit
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=hewansakit"> Hewansakit </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/hewan/proses.php?act=insert2" method="POST">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              require_once "config/database.php";
              $user_id = $_SESSION['user_id'];
              // "SELECT transaction_id from barang_masuk order by transaction_id desc limit 1"
              //$query = $mysqli->query("SELECT * from pakan");
              $query = $mysqli->query("SELECT * from sakit order by sick_id DESC limit 1");
              $query2 = $mysqli->query("SELECT * from hewan");
              $data = $query->fetch_assoc();
              $sickid = $data['sick_id'];
              $num = (int)substr($sickid,1,5);
             
              $count = $query->num_rows;

              if ($count > 0) {
                  // mengambil data kode_obat
                  //$data = $query->fetch_assoc();
                  $kode = $num+1;
              } else {
                  $kode = 10101;
              }
              $kode_sakit = "S$kode";

              // buat kode_obat
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Sakit</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="sick_id" value="<?php echo $kode_sakit; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Hewan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="item_name"  data-placeholder="-- Pilih --" autocomplete="off" required>
                    <?php     
                    while($datapakan = $query2->fetch_assoc()){
                      $item = $datapakan['item_name'];
                      echo "<option value='$item'>$item</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="amount" autocomplete="off" required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=pakan" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}

//Form Tambah Hewan masuk
elseif ($_GET['form']=='add3') { 
  require_once "config/database.php";
              $user_id = $_SESSION['user_id'];
              $query = $mysqli->query("SELECT transaction_id from barang_masuk order by transaction_id desc limit 1");
              $query2 = $mysqli->query("SELECT * from hewan");
              $data = $query->fetch_assoc();
              $lastid = $data['transaction_id'];
              $lastid = substr($lastid,1,5);
              $count = $query->num_rows;

              if ($count > 0) {
                  $num = $lastid+1;
              } else {
                  $num = 10101;
              }
              $kode = "M$num";?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i>Tambah Ternak Masuk
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=hewanmasuk"> Ternak Masuk </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/hewan/proses.php?act=insert3" method="POST">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="transaction_id" value="<?php echo $kode; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Hewan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="item_id" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <?php     
                    while($datapakan = $query2->fetch_assoc()){
                      $item_name = $datapakan['item_name'];
                      $item_id = $datapakan['item_id'];
                      echo "<option value='$item_id'>$item_name</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="amount" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Diketahui</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control"  name="tracked_by" value="<?php echo $_SESSION['acces']; ?>" readonly required >
                  </div>
                </div>
              </div>
 
              <div class="form-group">
                <label class="col-sm-2 control-label">Penyedia</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control" id="misc" name="misc" autocomplete="off" >
                  </div>
                </div>
              </div>           

            </div>

              

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=hewanmasuk" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
          <!-- Form end -->
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}

//Form Tambah Hewan Keluar
elseif ($_GET['form']=='add4') { 
  require_once "config/database.php";
              $user_id = $_SESSION['user_id'];
              $query = $mysqli->query("SELECT transaction_id from barang_keluar order by transaction_id desc limit 1");
              $query2 = $mysqli->query("SELECT * from hewan");
              $data = $query->fetch_assoc();
              $lastid = $data['transaction_id'];
              $lastid = substr($lastid,1,5);
              $count = $query->num_rows;

              if ($count > 0) {
                  $num = $lastid+1;
              } else {
                  $num = 10101;
              }
              $kode = "K$num";?> 
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i>Tambah Ternak Keluar
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=hewankeluar"> Ternak Keluar </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/hewan/proses.php?act=insert4" method="POST">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="transaction_id" value="<?php echo $kode; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Hewan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="item_id" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <?php     
                    while($datapakan = $query2->fetch_assoc()){
                      $item_name = $datapakan['item_name'];
                      $item_id = $datapakan['item_id'];
                      echo "<option value='$item_id'>$item_name</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="amount" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Diketahui</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control"  name="tracked_by" value="<?php echo $_SESSION['acces']; ?>" readonly required >
                  </div>
                </div>
              </div>
 
              <div class="form-group">
                <label class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control" id="misc" name="misc" autocomplete="off" >
                  </div>
                </div>
              </div>           

            </div>

              

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=hewankeluar" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
          <!-- Form end -->
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
elseif ($_GET['form']=='edit') { 
  if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel obat
      require_once "config/database.php";
      $user_id = $_SESSION['user_id'];
      $item_id= $_GET['id'];
      $query = $mysqli->query("SELECT * from hewan WHERE item_id='$item_id'");
      $data  = $query->fetch_assoc();
      $item_name = $data['item_name'];
      $amount = $data['amount'];
      $type = $data['type'];
      $price = $data['price'];
      $item_image = $data['item_image'];

    }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Daftar Hewan
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=daftarhewan"> Daftar Hewan </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/hewan/proses.php?act=update" method="POST">
            <div class="box-body">
              
              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Hewan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="item_id" value="<?php echo $item_id; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Hewan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="item_name" value="<?php echo $item_name; ?>" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="amount"  value="<?php echo $amount; ?>" autocomplete="off" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="type" value="<?php echo $type; ?>" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value="Pedaging">Pedaging</option>
                    <option value="Bibit">Bibit</option>
                  </select>
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-2 control-label">Harga</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                  </div>
                </div>
              </div>
 
 <!--Div tersembunyi sebagai backup gambar-->
              <div class="form-group" style="display:none">
                <div class="col-sm-5">                   
                    <input class="form-control" id="gambar" name="gambar" autocomplete="off" value="<?php echo $data['item_image']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Gambar</label>
                <div class="col-sm-5">
                  <input type="file" name="item_image" default="<?php echo $data['item_image']; ?>" value="<?php echo $data['item_image']; ?>">
                  <br/>       
                  <?php  
                if ($data['item_image']=="") { ?>
                  <img style="border:1px solid #eaeaea;border-radius:5px;" src="../../images/user/user-default.png" width="128">
                <?php
                }
                else { ?>
                  <img style="border:1px solid #eaeaea;border-radius:5px;" src="images/hewan/<?php echo $data['item_image']; ?>" width="128">
                <?php
                }
                ?>         
                </div>
              </div>
              
            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=pakan" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}

// Edit Pakan Masuk
elseif ($_GET['form']=='edit3') { 
  if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel obat
      require_once "config/database.php";
      $transaction_id = $_GET['id'];
      $query        = $mysqli->query("SELECT * from barang_masuk WHERE transaction_id='$transaction_id'");
      $data         = $query->fetch_assoc();
      $item_id      = $data['item_id'];
      $description  = $data['description'];
      $amount       = $data['amount'];
      $tracked_by   = $data['tracked_by'];
      $misc         = $data['misc'];
      require_once "config/database.php";
      $user_id = $_SESSION['user_id'];              
      $query2 = $mysqli->query("SELECT * from hewan");
    }
?>
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Ternak Masuk
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=hewanmasuk"> Ternak Masuk </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/hewan/proses.php?act=update3" method="POST">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="transaction_id" value="<?php echo $transaction_id; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Hewan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="description" value="<?php echo $description; ?>" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <?php          
                    while($datahewan = $query2->fetch_assoc()){
                      $item = $datahewan['item_name'];
                      if($item != $description){
                        echo "<option value='$item'>$item</option>";}
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="amount" value="<?php echo $amount ; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Diketahui</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control" id="tracked_by" name="tracked_by" value="<?php echo $tracked_by; ?>" autocomplete="off" value="<?php echo $data['tracked_by']; ?>" readonly required>
                  </div>
                </div>
              </div>
 
              <div class="form-group">
                <label class="col-sm-2 control-label">Penyedia</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control" id="misc" name="misc" value="<?php echo $misc; ?>" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $data['misc']; ?>" >
                  </div>
                </div>
              </div>           

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=hewanmasuk" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
          <!--Form End-->
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}

// Edit Pakan Keluar
elseif ($_GET['form']=='edit4') { 
  if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel obat
      require_once "config/database.php";
      $transaction_id = $_GET['id'];
      $query        = $mysqli->query("SELECT * from barang_keluar WHERE transaction_id='$transaction_id'");
      $data         = $query->fetch_assoc();
      $item_id      = $data['item_id'];
      $description  = $data['description'];
      $amount       = $data['amount'];
      $tracked_by   = $data['tracked_by'];
      $misc         = $data['misc'];
    }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Ternak Keluar
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=hewankeluar"> Hewan Keluar </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/hewan/proses.php?act=update4" method="POST">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              require_once "config/database.php";
              $user_id = $_SESSION['user_id'];              
              $query2 = $mysqli->query("SELECT * from hewan");
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="transaction_id" value="<?php echo $transaction_id; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Hewan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="description" value="<?php echo $description; ?>" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <?php          
                    while($datahewan = $query2->fetch_assoc()){
                      $item = $datahewan['item_name'];
                      if($item != $description){
                        echo "<option value='$item'>$item</option>";}
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="amount" value="<?php echo $amount ; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Diketahui</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control" id="tracked_by" name="tracked_by" value="<?php echo $tracked_by; ?>" autocomplete="off" value="<?php echo $data['tracked_by']; ?>" readonly required>
                  </div>
                </div>
              </div>
 
              <div class="form-group">
                <label class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control" id="misc" name="misc" value="<?php echo $misc; ?>" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $data['misc']; ?>" readonly >
                  </div>
                </div>
              </div>           

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=hewankeluar" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
          <!--Form End-->
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>