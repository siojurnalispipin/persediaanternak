
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Pakan Masuk

    <a class="btn btn-primary btn-social pull-right" href="?module=form_pakan&form=add3" title="Tambah Data" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Tambah
    </a>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php  
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    } 
    // jika alert = 1
    // tampilkan pesan Sukses "Data masuk baru berhasil disimpan"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              <p style='color:black;'>Data Barang Masuk baru berhasil disimpan.</p>
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Sukses "Data masuk berhasil diubah"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              <p style='color:black;'>Data Barang Masuk berhasil diubah.</p>
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Sukses "Data masuk berhasil dihapus"
    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              <p style='color:black;'>Data Barang Masuk berhasil dihapus.</p>
            </div>";
    }
    // jika alert = 4
    // tampilkan pesan Sukses "Data masuk berhasil dihapus"
    elseif ($_GET['alert'] == 4) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4 style='color:red;'>  <i class='icon fa fa-close'></i> Gagal!</h4>
              <p style='color:black;'>Jumlah Pakan Masuk yang dimasukkan melebihi Stok.</p>
            </div>";
    }
    // jika alert = 5
    // tampilkan pesan Sukses "Data keluar berhasil dihapus"
    elseif ($_GET['alert'] == 5) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-close'></i> Gagal!</h4>
              <p style='color:black;'>Perubahan Data Pakan Masuk Gagal.</p>
            </div>";
            $msg = "Jumlah Perubahan melebihi Stok.";
            echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel obat -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Kode Transaksi</th>
                <th class="center">Deskripsi</th>
                <th class="center">Jumlah</th>
                <th class="center">Diketahui</th>
                <th class="center">Keterangan</th>
                <th class="center">Tanggal</th>                
                <th></th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel obat
            require_once "config/database.php";     


            $query = $mysqli->query("SELECT * FROM barang_masuk WHERE item_id<70000 ORDER BY transaction_id DESC");
            //$data = $query->fetch_assoc();
           
            // tampilkan data
            while ($data = $query->fetch_assoc()) { 
              // menampilkan isi tabel dari database ke tabel di aplikasi

              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='80' class='center'>$data[transaction_id]</td>
                      <td width='180' class='center'>$data[description]</td>                      
                      <td width='80' class='center'>$data[amount]</td>
                      <td width='180' class='center'>$data[tracked_by]</td>                      
                      <td width='80' class='center'>$data[misc]</td>
                      <td width='80' class='center'>$data[transaction_date]</td>
                      <td class='center' width='80'>
                        <div>
                        ";
                     
              if($_SESSION['acces']=="Admin"){
                 ?>

                          <a data-toggle="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="btn btn-primary btn-sm" href="?module=form_pakan&form=edit3&id=<?php echo $data['transaction_id'];?>">
                              <i style="color:#fff" class="glyphicon glyphicon-edit"></i>
                          </a>    
                          <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/pakan/proses.php?act=delete3&id=<?php echo $data['transaction_id'];?>&amount=<?php echo $data['amount'];?>&item_id=<?php echo $data['item_id'];?>" onclick="return confirm('Anda yakin ingin menghapus pakan <?php echo $data['transaction_id']; ?> ?');">
                              <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                          </a>
              <?php
              
              }
              echo "    </div>
                      </td>
                    </tr>";
              $no++;
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content