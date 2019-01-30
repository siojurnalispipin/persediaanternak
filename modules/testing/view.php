
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Testing

    <a class="btn btn-primary btn-social pull-right" href="?module=form_barangmasuk&form=add" title="Tambah Data" data-toggle="tooltip">
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
              Data Testing baru berhasil disimpan.
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Sukses "Data masuk berhasil diubah"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Barang Masuk berhasil diubah.
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Sukses "Data masuk berhasil dihapus"
    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Testing berhasil dihapus.
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
                <th class="center">i(0)</th>
                <th class="center">i(1)</th>
                <th class="center">i(2)</th>
                <th class="center">i(3)</th>
                <th class="center">i(4)</th>
                <th class="center">i(5)</th>                
                <th></th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            require_once "config/database2.php";     


            $query = $mysqli->query("SELECT * FROM tbl_pengguna ORDER BY p_id ASC");
            $query2 = $mysqli->query("SELECT * FROM tbl_rating ORDER BY r_idmember ASC");
            //$data = $query->fetch_assoc();
            $_R=0;
            $temp=-1;
            $ListMember = array();
            $ListTotalR = array();
            $ListBuku = array();
            $ListRating = array();
            $ListBukuRating = array();
            $MatriksRating;
            $c = 0;
            while ($data = $query2->fetch_assoc()) {
              $idMember = $data['r_idmember'];
              if($idMember != $temp){
                array_push($ListMember,$idMember);
                if(sizeof($ListMember)>1)
                  array_push($ListTotalR,$_R);
                $temp = $idMember;
                $_R=$data['r_rating'];
//==============
                $ListBukuRating[$c] = array('buku' => array(), 'rating' => array() );
                $c++;
              }
              else {
                $_R = $_R+$data['r_rating'];
              }
              $b = array_search($data['r_idbuku'],$ListBuku);
              if($b===false){
                  array_push($ListBuku, $data['r_idbuku']);
              }

              array_push($ListBukuRating[array_search($data['r_idmember'],$ListMember)]['buku'], $data['r_idbuku']);
              array_push($ListBukuRating[array_search($data['r_idmember'],$ListMember)]['rating'], $data['r_rating']);              
              
              $tmpRating = array("user" => $data['r_idmember'], "buku"=> $data['r_idbuku'], "rating"=> $data['r_rating']);
              array_push($ListRating, $tmpRating);
            }
            //last push R
            array_push($ListTotalR,$_R);
            for($i = 0;$i <sizeof($ListMember);$i++){
              for($j=0;$j< sizeof($ListBuku);$j++){
                $temu = array_search($ListBuku[$j], $ListBukuRating[$i]['buku']);
                if($temu){
                  $MatriksRating[$i][$j] =  $ListBukuRating[$i]['rating'][$temu];
                }
                else $MatriksRating[$i][$j] =  0;
              }

            }


//$temp = $MatriksRating[$i];
            for($i=0;$i<sizeof($ListMember);$i++){
              
              echo "<tr>";
              for($j=0;$j<6;$j++){
                echo "<td width='30' class='center'>";
                echo $MatriksRating[$i][$j];
                echo "</td>";
              }
              echo" <td class='center' width='80'>
                        <div>
                        ";
              echo "    </div>
                      </td>
                    </tr>";     
            }

            // while ($data = $query->fetch_assoc()) { 
            //   // menampilkan isi tabel dari database ke tabel di aplikasi

            //   echo "<tr>
            //           <td width='30' class='center'>$no</td>
            //           <td width='80' class='center'>$data[p_id]</td>
            //           <td width='180' class='center'></td>                      
            //           <td width='80' class='center'></td>
            //           <td width='180' class='center'></td>                      
            //           <td width='80' class='center'></td>
            //           <td width='80' class='center'></td>
            //           <td class='center' width='80'>
            //             <div>
            //             ";
            //   echo "    </div>
            //           </td>
            //         </tr>";
            //   $no++;
            // }

            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content