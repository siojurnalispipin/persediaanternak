
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
                <th class="center">No.</th>
                <th class="center">Id Buku</th>
                <th class="center">Judul</th>
                <th class="center">Klasifikasi</th>
                <th class="center">Jumlah</th>              
                <th></th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            // fungsi query untuk mengambil data rating
            require_once "config/database2.php";     
            $query = $mysqli->query("SELECT * FROM tbl_pengguna ORDER BY p_id ASC");
            $query2 = $mysqli->query("SELECT * FROM tbl_rating ORDER BY r_iduser ASC");
            $_R=0;
            $temp=-1;
            $ListMember = array();
            $ListTotalR = array();
            $ListBuku = array();
            $ListRating = array();
            $NilaiRatingBuku = array();
            $jumlahRating = array();
            $ListBukuRating = array();
            $Centroid = array();
            $MatriksRating;
            $c = 0;
            while ($data = $query2->fetch_assoc()) {
              $idMember = $data['r_iduser'];
              if($idMember != $temp){
                array_push($ListMember,$idMember);
                if(sizeof($ListMember)>1)
                  array_push($ListTotalR,$_R);
                $temp = $idMember;
                $_R=$data['r_rating'];
                $ListBukuRating[$c] = array('buku' => array(), 'rating' => array() );
                $c++;
              }
              else {
                $_R = $_R+$data['r_rating'];
              }
              $b = array_search($data['r_idbuku'],$ListBuku);
              if($b===false){
                  array_push($ListBuku, $data['r_idbuku']);
                  array_push($NilaiRatingBuku, 0);
                  array_push($jumlahRating,0);
              }

              array_push($ListBukuRating[array_search($data['r_iduser'],$ListMember)]['buku'], $data['r_idbuku']);
              array_push($ListBukuRating[array_search($data['r_iduser'],$ListMember)]['rating'], $data['r_rating']);              
              
              $tmpRating = array("user" => $data['r_iduser'], "buku"=> $data['r_idbuku'], "rating"=> $data['r_rating']);
              array_push($ListRating, $tmpRating);
            }
            //end of init ListMember, ListBuku, ListRating
            array_push($ListTotalR,$_R);
            //Inisialisasi Matriks
            for($i = 0;$i < sizeof($ListMember);$i++){
              for($j=0;$j < sizeof($ListBuku);$j++){
                $temu = array_search($ListBuku[$j], $ListBukuRating[$i]['buku']);
                if(!($temu===false)){
                  $MatriksRating[$i][$j] =  $ListBukuRating[$i]['rating'][$temu];
                }
                else $MatriksRating[$i][$j] =  0;
                $NilaiRatingBuku[$j] = $NilaiRatingBuku[$j]+$MatriksRating[$i][$j];
                $jumlahRating[$j] = $jumlahRating[$j]+1;
              }
            }
            //end of matriks fill
            $Cluster = array();
            $clusterLength = (int)sqrt(sizeof($ListMember));
            $clusterMaxItem = (int) (sizeof($ListMember)/$clusterLength);
            $indeksPakai = array();
            if(sizeof($ListMember)%$clusterMaxItem>0 ){
              $clusterLength++;            
            }
            //Clustering
            for($c=0,$i=0;$c < sizeof($MatriksRating) && $i<$clusterLength ;$c++){
              if($c == $clusterMaxItem *($i+1)){
                $i++;}
              if($c %  $clusterMaxItem ==0){
                $Cluster[$i]= array();
              }
                $Cluster[$i][$c%$clusterMaxItem] = $MatriksRating[$c];
            }
            $ListD = array();
            $msg="";
            for($c=0;$c < sizeof($Cluster) ; $c++){
              $ClusterTmp = $Cluster[$c];
              $ListD[$c] = array();
              $msg=$msg."Cluster-".($c+1)."| ";
              for($i=0;$i< sizeof($ClusterTmp); $i++){
                $d=0;
                $userI = $ClusterTmp[$i];
                for($j=0;$j< sizeof($ClusterTmp); $j++){
                  $userJ = $ClusterTmp[$j];
                  if($i!=$j){
                    for($k=0;$k<sizeof($ListBuku);$k++){
                      if(abs($userI[$k] - $userJ[$k])<=5 && $userI[$k]>0)
                        $d++;
                    }
                  }
                
                }
                $ListD[$c][$i] = $d;
                $msg = $msg.$d." | ";
              }
            }
            //echo "<script type='text/javascript'> alert('".$msg."')</script>";
            for($c=0;$c < sizeof($Cluster) ; $c++){
              $maks=0;
              $maksI=0;
              $Dtmp=$ListD[$c];
              for($i=0;$i < sizeof($Dtmp) ; $i++){
                if($Dtmp[$i] > $maks){
                  $maks = $Dtmp[$i];
                  $maksI= $i;
                }            
              }
              array_push($Centroid, $Cluster[$c][$maksI]);
            }
            $SkorBuku = array();
            $aduh =0;
            for($i=0;$i<sizeof($ListBuku);$i++){
              $SkorBuku[$i] = 0;
            }
            for($i=0;$i<sizeof($Centroid);$i++){
              for($j=0;$j<sizeof($ListBuku);$j++){
                if($Centroid[$i][$j]>0){
                  $SkorBuku[$j] +=1;
                }

              }
            }
            $ListBuku2 = array();

            $msg2="";
            for($i=0;$i<sizeof($ListBuku);$i++){
              $ListBuku2[$i]['id'] = $ListBuku[$i];
              $ListBuku2[$i]['score'] = $NilaiRatingBuku[$i];
              $ListBuku2[$i]['mean'] = ($NilaiRatingBuku[$i]/$jumlahRating[$i])/2;
              $ListBuku2[$i]['count'] = $SkorBuku[$i];
              //$msg2 = $msg2."R-".($i+1).":".$NilaiRatingBuku[$i]." | ";            
              $msg2 = $msg2."R-".($i+1).":".$ListBuku2[$i]['id']."|".$ListBuku2[$i]['score']."|".$ListBuku2[$i]['count']."| ";
            }
            $msg3="id : ";
            $msg4="score : ";
            $msg5="count : ";
            
            for($i=0;$i<sizeof($ListBuku2)-1;$i++){
              for($j=$i+1;$j<sizeof($ListBuku2);$j++){
                $skorI = (int)$ListBuku2[$i]['score'];
                $skorJ = (int)$ListBuku2[$j]['score'];
                $countI = (int)$ListBuku2[$i]['count'];
                $countJ = (int)$ListBuku2[$j]['count'];
                if( $countJ >= $countI && $skorJ > $skorI ){
                  $temp = $ListBuku2[$i]; 
                  $ListBuku2[$i] = $ListBuku2[$j];
                  $ListBuku2[$j] = $temp;
                }              
              }
            }
            $MFCM = array();
            
            for($i=0;$i<sizeof($ListBuku);$i++){
              $id = $ListBuku2[$i]['id'];
              $mean = $ListBuku2[$i]['mean'];
              $quer3 = $mysqli->query("UPDATE tbl_buku SET b_rating = ".$mean." where b_idbuku = ".$id);
              $quer3 = $mysqli->query("SELECT * FROM `tbl_buku` WHERE b_idbuku = ".$id);
              $msg3 = $msg3.$ListBuku2[$i]['id']." | ";
              $msg4 = $msg4.$ListBuku2[$i]['score']." | ";
              $msg5 = $msg5.$ListBuku2[$i]['count']." | ";
              $buku = $quer3->fetch_assoc();
              array_push($MFCM, $buku);
            }

          $c=1;
        for($i=0;$i<sizeof($MFCM)-1;$i++,$c++){
          echo "<tr><td class='center'>".($c);
          echo "</td>";
          echo "<td width='30' class='center'>".$MFCM[$i]['b_idbuku']."</td>";
          echo "<td width='30' class='center'>".$MFCM[$i]['b_judul']."</td>";
          echo "<td width='30' class='center'>".$MFCM[$i]['b_klasifikasi']."</td>";
          echo "<td width='30' class='center'>".$MFCM[$i]['b_jumlah']."</td>";
          echo "<td width='30' class='center'>".substr($MFCM[$i]['b_rating'],0,3)."</td>";
          echo "<td class='center'>
                  <div></div>
                </td>
              </tr>";  
          echo "<tr><td class='center'>
            <div></div>
        </td></tr>";
        }
        echo "<script type='text/javascript'> alert('".$msg3.$msg4.$msg5."')</script>";

            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content