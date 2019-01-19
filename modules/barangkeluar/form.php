

 <?php  
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i>Tambah Barang Keluar
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=barangkeluar"> Barang Keluar </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/barangkeluar/proses.php?act=insert" method="POST">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              require_once "config/database.php";
              $user_id = $_SESSION['user_id'];
              $query = $mysqli->query("SELECT transaction_id from barang_keluar order by transaction_id desc limit 1");
              $query2 = $mysqli->query("SELECT * from pakan");
              $query3 = $mysqli->query("SELECT * from hewan");
              $data = $query->fetch_assoc();
              $lastid = $data['transaction_id'];
              $lastid = (int)substr($lastid,1,5);
              $count = $query->num_rows;

              if ($count > 0) {
                  $num = $lastid+1;
              } else {
                  $num = 10101;
              }

              
              $kode = "K$num";
             
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="transaction_id" value="<?php echo $kode; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Barang</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="item_id" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <?php     
                    while($datapakan = $query2->fetch_assoc()){
                      $item_name = $datapakan['item_name'];
                      $item_id = $datapakan['item_id'];
                      echo "<option value='$item_id'>$item_name</option>";
                    }
                    while($datapakan = $query3->fetch_assoc()){
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
                  <a href="?module=barangkeluar" class="btn btn-default btn-reset">Batal</a>
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
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form']=='edit') { 
  if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel obat
      require_once "config/database.php";
      $query = $mysqli->query("SELECT * from barang_keluar WHERE transaction_id='$_GET[id]'");
      $data  = $query->fetch_assoc();
    }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Barang Keluar
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=barangkeluar"> Barang Keluar </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/barangkeluar/proses.php?act=update" method="POST">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              require_once "config/database.php";
              $user_id = $_SESSION['user_id'];
              $query2 = $mysqli->query("SELECT * from pakan");
              $query3 = $mysqli->query("SELECT * from hewan");
              
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="transaction_id" value="<?php echo $data['transaction_id']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Barang</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="description" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <?php     
                    while($datapakan = $query2->fetch_assoc()){
                      $item = $datapakan['item_name'];
                      echo "<option value='$item'>$item</option>";
                    }
                    while($datapakan = $query3->fetch_assoc()){
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
                  <input type="text" class="form-control" name="amount" value="<?php echo $data['amount']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Satuan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="unit" autocomplete="on" value="<?php echo $data['unit']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Diketahui</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control" id="tracked_by" name="tracked_by" autocomplete="off" value="<?php echo $data['tracked_by']; ?>" readonly required>
                  </div>
                </div>
              </div>
 
              <div class="form-group">
                <label class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control" id="misc" name="misc" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $data['misc']; ?>" >
                  </div>
                </div>
              </div>           

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=barangkeluar" class="btn btn-default btn-reset">Batal</a>
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