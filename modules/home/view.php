<?php require_once "auto/penjualan.php" ?>

<section class="content-header">
    <h1>
        <i class="fa fa-home icon-title"></i> Beranda
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=home"><i class="fa fa-home"></i> Beranda</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!--start=======================================================================================================-->

    <!--end=========================================================================================================-->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <a href="?module=daftarhewan" class="small-box-footer" title="Lihat Detail" data-toggle="tooltip">
            <div class="col-lg-3 col-xs-6" style="width:50%">
                <!-- small box -->

                <div style="background-color:#69BE69;color:#fff;height:110px" class="small-box">
                    <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($mysqli, "SELECT SUM(amount) as jumlah FROM hewan")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <div class="inner">
                        <h2 style="text-align:center">
                            <?php echo $data['jumlah']; ?>
                            <p>Jumlah Hewan</p>
                            </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text-o"></i>
                    </div>


                </div>
        </a>
    </div><!-- ./col -->
    <!--=============================================================================================================-->


    <!--=============================================================================================================-->

    <a href="?module=daftarhewan" class="small-box-footer" data-toggle="tooltip" style="hover-color:#00094E">
        <div class="col-lg-3 col-xs-6" style="width:50%">
            <!-- small box -->
            <div style="background-color:#CE794E;color:#fff;height:110px" class="small-box">
                <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($mysqli, "SELECT SUM(amount) as jumlah FROM pakan")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                <div class="inner">
                    <h2 style="text-align:center">
                        <?php echo $data['jumlah']; ?>
                        <p>Jumlah Pakan</p>
                        </h3>
                </div>
                <div class="icon">
                    <i class="fa fa-file-text-o"></i>
                </div>

            </div>
        </div><!-- ./col -->
    </a>
    </div><!-- /.row -->

    <!--=============================================================================================================-->
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
    <!--/.row-->


    <!--=============================================================================================================-->
    <div class="row">


        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#dd4b39;color:#fff" class="small-box">
                <div class="inner">
                    <?php   
            // fungsi query untuk menampilkan data dari tabel obat masuk
            $query = mysqli_query($mysqli, "SELECT COUNT(transaction_id) as jumlah FROM barang_masuk")
                                            or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <h3>
                        <?php echo $data['jumlah']; ?>
                    </h3>
                    <p>Laporan Barang Masuk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
                <a href="?module=laporanmasuk" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i
                        class="fa fa-print"></i></a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#dd4b39;color:#fff" class="small-box">
                <div class="inner">
                    <?php   
            // fungsi query untuk menampilkan data dari tabel obat masuk
            $query = mysqli_query($mysqli, "SELECT COUNT(transaction_id) as jumlah FROM barang_keluar")
                                            or die('Ada kesalahan pada query tampil Data barang Keluar: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <h3>
                        <?php echo $data['jumlah']; ?>
                    </h3>
                    <p>Laporan Barang Keluar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-out"></i>
                </div>
                <a href="?module=laporanmasuk" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i
                        class="fa fa-print"></i></a>
            </div>
        </div><!-- ./col -->

        


    </div><!-- /.row -->

    <!--=============================================================================================================-->
    <div class="row">
        <div class="col-lg-12 col-xs-12" style="width:50%">
            <div id="chart-container">
                <div style="padding:5px" class="small-box">

                    <canvas id="graphPenjualan"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xs-12" style="width:50%">
            <div id="chart-container">
                <div style="padding:5px" class="small-box">
                    <canvas id="graphKerugian"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->


</section><!-- /.content -->