<?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($mysqli, "SELECT SUM(amount) as jumlah, COUNT(amount) as jenis FROM pakan")
                                            or die('Ada kesalahan pada query tampil Data Pakan: '.mysqli_error($mysqli));
            $query2 = mysqli_query($mysqli, "SELECT SUM(amount) as jumlah, COUNT(amount) as jenis FROM hewan")
                                            or die('Ada kesalahan pada query tampil Data Hewan: '.mysqli_error($mysqli));

            // tampilkan data
            $pakan = mysqli_fetch_assoc($query);
            $hewan = mysqli_fetch_assoc($query2);
            

            
?>


<section class="content">
    
    <div class="row">
      <div class="col-lg-12 col-xs-12" style="width:50%">
      <h2 style="text-align: center" >Jumlah Ternak : <?php echo $hewan['jumlah'];?></h2>
      </div>
      <div class="col-lg-12 col-xs-12" style="width:50%">
      <h2 style="text-align: center">Jumlah Pakan : <?php echo $pakan['jumlah'];?></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-xs-12" style="width:50%">
        <div id="chart-container">
          <div style="padding:5px" class="small-box">
            
            <canvas id="graphHewan"></canvas>
          </div>
        </div>
      </div>

      <div class="col-lg-12 col-xs-12" style="width:50%">
        <div id="chart-container">
          <div style="padding:5px" class="small-box">
            <canvas id="graphPakan"></canvas>
          </div>
        </div>
      </div>
    </div>


</section>