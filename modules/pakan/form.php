

 <?php  
if (empty($_GET['alert'])) {
      echo "";
    } 
    // jika alert = 1
    // tampilkan pesan Gagal
    elseif ($_GET['alert'] == 0) {
      $msg = "Query Gagal!.";
      echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    elseif ($_GET['alert'] == 1) {
      $msg = "Pakan dan jenis yang sama telah terdaftar.";
      echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    elseif ($_GET['alert'] == 2) {
      $msg = "Jumlah Pakan Kedaluarsa diinput melebihi stok tersedia.";
      echo "<script type='text/javascript'>alert('$msg');</script>";
    }

// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Tambah Pakan
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=daftarpakan"> Pakan </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/pakan/proses.php?act=insert" method="POST">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              require_once "config/database.php";
              $user_id = $_SESSION['user_id'];
              // "SELECT transaction_id from barang_masuk order by transaction_id desc limit 1"
              //$query = $mysqli->query("SELECT * from pakan");
              $query = $mysqli->query("SELECT item_id from pakan order by item_id DESC limit 1");
              $data = $query->fetch_assoc();
              $lastid = $data['item_id'];
              $num = (int)$lastid;
             
              $count = $query->num_rows;

              if ($count > 0) {
                  // mengambil data kode_obat
                  //$data = $query->fetch_assoc();
                  $kode_pakan = $num+1;
              } else {
                  $kode_pakan = 40101;
              }

              // buat kode_obat
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Pakan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="item_id" value="<?php echo $kode_pakan; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Pakan</label>
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
                  <select class="chosen-select" name="type" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value="Pakan Kasar">Pakan Kasar</option>
                    <option value="Pakan Penguat">Pakan Penguat</option>
                    <option value="Pakan Tambahan">Pakan Tambahan</option>
                    <option value="Pakan Fermentasi">Pakan Fermentasi</option>
                    <option value="Vitamin">Vitamin</option>
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

elseif ($_GET['form']=='add2') { ?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Tambah Pakan Kedaluarsa
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=pakanrusak"> Pakan Kedaluarsa </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/pakan/proses.php?act=insertex" method="POST">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              require_once "config/database.php";
              $user_id = $_SESSION['user_id'];
              // "SELECT transaction_id from barang_masuk order by transaction_id desc limit 1"
              //$query = $mysqli->query("SELECT * from pakan");
              $query = $mysqli->query("SELECT expired_id from kedaluarsa order by expired_id DESC limit 1");
              $query2 = $mysqli->query("SELECT * from pakan");
              $data = $query->fetch_assoc();
              $lastid = $data['expired_id'];
              $lastid = substr($lastid,1,5);
              //E10001
              $num = (int)$lastid;
             
              $count = $query->num_rows;

              if ($count > 0) {
                  // mengambil data kode_obat
                  //$data = $query->fetch_assoc();
                  $num = $num +1;
                  $kode_pakan = "E$num";
              } else {
                  $kode_pakan = "E10001";
              }

              // buat kode_obat
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Kedaluarsa</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="expired_id" value="<?php echo $kode_pakan; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Barang</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="item_name" data-placeholder="-- Pilih --" autocomplete="off" required>
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

            </div>

              

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=pakanrusak" class="btn btn-default btn-reset">Batal</a>
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
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form']=='edit') { 
  if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel obat
      require_once "config/database.php";
      $user_id = $_SESSION['user_id'];
      $query = $mysqli->query("SELECT * from pakan WHERE item_id='$_GET[id]'");
      $data  = $query->fetch_assoc();
    }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Pakan
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=daftarpakan"> Pakan </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/pakan/proses.php?act=update" method="POST">
            <div class="box-body">
              
              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Pakan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="item_id" value="<?php echo $data['item_id']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Pakan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="item_name" autocomplete="off" value="<?php echo $data['item_name']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="amount" autocomplete="off" value="<?php echo $data['amount']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="type" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value="Pakan Kasar">Pakan Kasar</option>
                    <option value="Pakan Penguat">Pakan Penguat</option>
                    <option value="Pakan Tambahan">Pakan Tambahan</option>
                    <option value="Pakan Fermentasi">Pakan Fermentasi</option>
                    <option value="Vitamin">Vitamin</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Harga</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="price" name="price" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $data['price']; ?>" required>
                  </div>
                </div>
              </div>
 
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
                  <img style="border:1px solid #eaeaea;border-radius:5px;" src="images/item/<?php echo $data['item_image']; ?>" width="128">
                <?php
                }
                ?>         
                </div>
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
?>