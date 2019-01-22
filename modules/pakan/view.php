
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Daftar Pakan

    <a class="btn btn-primary btn-social pull-right" href="?module=form_pakan&form=add" title="Tambah Data" data-toggle="tooltip">
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
              <h4  style='color:black;'>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              <p style='color:black;'>Pakan baru berhasil disimpan.</p>
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Sukses "berhasil diubah"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4  style='color:black;'>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              <p style='color:black;'>Data Pakan berhasil diubah.</p>
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Sukses "berhasil dihapus"
    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4  style='color:black;'>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              <p style='color:black;'>Data Pakan berhasil dihapus.</p>
            </div>";
    }
    elseif ($_GET['alert'] == 4) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4 style='color:red;'>  <i class='icon fa fa-close'></i> Gagal!</h4>
              <p style='color:black;'>Data Pakan Gagal dimasukkan.</p>
            </div>";
      $msg = "Pakan dan jenis yang sama telah terdaftar.";
      echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    elseif ($_GET['alert'] == 5) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4 style='color:red;'>  <i class='icon fa fa-close'></i> Gagal!</h4>
              <p style='color:black;'>Data Pakan Gagal diubah.</p>
            </div>";
      $msg = "Pakan dan jenis yang sama telah terdaftar.";
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
                <th class="center">Kode Pakan</th>
                <th class="center">Nama Pakan</th>
                <th class="center">Stok</th>
                <th class="center">Kategori</th>
                <th class="center">Ditujukan</th>
                <th class="center">Gambar</th>
                <th></th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel obat
            require_once "config/database.php";
      


            $query = $mysqli->query("SELECT * FROM pakan ORDER BY item_id ASC");
            //$data = $query->fetch_assoc();
           
            // tampilkan data
            while ($data = $query->fetch_assoc()) { 
              // menampilkan isi tabel dari database ke tabel di aplikasi
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='80' class='center'>$data[item_id]</td>
                      <td width='180' class='center'>$data[item_name]</td>                      
                      <td width='80' class='center'>$data[amount]</td>
                      <td width='80' class='center'>$data[type]</td>
                      <td width='80' class='center'>$data[use_for]</td>
                      <td width='50' class='center'><img src='images/item/$data[item_image]' width='50' height='50'></td>
                      <td class='center' width='80'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_pakan&form=edit&id=$data[item_id]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>";
            ?>
                          <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/pakan/proses.php?act=delete&id=<?php echo $data['item_id'];?>" onclick="return confirm('Anda yakin ingin menghapus pakan <?php echo $data['item_name']; ?> ?');">
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