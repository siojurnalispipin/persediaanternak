
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Hewan Sakit

    <a class="btn btn-primary btn-social pull-right" href="?module=form_hewan&form=add2" title="Tambah Data" data-toggle="tooltip">
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
    // tampilkan pesan Sukses "berhasil disimpan"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4 style='color:black;'>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              <p style='color:black;'>Ternak sakit berhasil ditambahkan.</p>
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Sukses "berhasil diubah"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4 style='color:black;'>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              <p style='color:black;'>Data ternak sakit berhasil diubah.</p>
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Sukses "berhasil dihapus"
    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4 style='color:black;'>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              <p style='color:black;'>Data ternak sakit berhasil dihapus.</p>
            </div>";
    }
    // jika alert = 4
    // tampilkan pesan Sukses "Gagal"
    elseif ($_GET['alert'] == 4) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4 style='color:red;'>  <i class='icon fa fa-close'></i> Gagal!</h4>
              <p style='color:black;'>Penambahan Ternak Sakit gagal.</p>
            </div>";
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
                <th class="center">Kode Sakit</th>
                <th class="center">Nama Hewan</th>
                <th class="center">Jumlah</th>
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
      


            $query = $mysqli->query("SELECT * FROM sakit ORDER BY sick_id DESC");
            //$data = $query->fetch_assoc();
           
            // tampilkan data
            while ($data = $query->fetch_assoc()) { 
              // menampilkan isi tabel dari database ke tabel di aplikasi
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='80' class='center'>$data[sick_id]</td>
                      <td width='180' class='center'>$data[item_name]</td>                      
                      <td width='80' class='center'>$data[amount]</td>
                      <td width='80' class='center'>$data[sick_date]</td>
                      <td class='center' width='80'>
                        <div>
                          ";
            ?>
                          <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/hewan/proses.php?act=deletesc&id=<?php echo $data['sick_id'];?>" onclick="return confirm('Anda yakin ingin menghapus Laporan <?php echo $data['sick_id']; ?> ?');">
                              <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                          </a>
            <?php
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