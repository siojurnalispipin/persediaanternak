

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
    <div class="small-box-footer">
            <div class="col-lg-3 col-xs-6" sytle="width:50%">
                <div id="divjum" style="background-image:url('assets/img/sapi_dark.jpg');background-size: cover; background-repeat: no-repeat; background-position: center; color:#fff;height:180px;"
                    class="small-box">
                    <?php  
            $query = mysqli_query($mysqli, "SELECT amount as jumlah FROM hewan WHERE item_name LIKE 'Sapi'")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>

                    <div class="inner">
                        <h1 style="text-align:center;">
                            Bibit Sapi
                            <h3 style='text-align:center'><?php echo $data['jumlah']; ?></h3>
                            </h3>
                    </div>
                    <div class="icon">
                    </div>
                </div>
            </div>
        </div>

        <div class="small-box-footer">
            <div class="col-lg-3 col-xs-6" sytle="width:50%">
                <div id="divjum" style="background-image:url('assets/img/ayam_small.jpg');background-size: cover; background-repeat: no-repeat; background-position: center; color:#fff;height:180px;"
                    class="small-box">

                    <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($mysqli, "SELECT amount as jumlah FROM hewan WHERE item_name LIKE 'Ayam Anakan'")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>

                    <div class="inner">
                        <h1 style="text-align:center">
                            Bibit Ayam
                            <h3 style='text-align:center'><?php echo $data['jumlah'] ?></h3>
                            </h3>
                    </div>
                    <div class="icon">
                    </div>
                </div>
            </div>
        </div>
        <div class="small-box-footer">
            <div class="col-lg-3 col-xs-6" sytle="width:50%">
                <div id="divjum" style="background-image:url('assets/img/pelet2.jpg');background-size: cover; background-repeat: no-repeat; background-position: center; color:#fff;height:180px;"
                    class="small-box">
                    <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($mysqli, "SELECT amount as jumlah FROM pakan WHERE item_name LIKE 'Pelet Ikan 1kg'")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($mysqli));
            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <div class="inner">
                        <h1 style="text-align:center">
                            Pelet
                            <h3 style='text-align:center'><?php echo $data['jumlah'] ?></h3>
                            </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="small-box-footer">
            <div class="col-lg-3 col-xs-6" sytle="width:50%">
                <div id="divjum" style="background-image:url('assets/img/bebek_small.jpg');background-size: cover; background-repeat: no-repeat; background-position: center; color:#fff;height:180px;"
                    class="small-box">
                    <?php  
            $query = mysqli_query($mysqli, "SELECT amount as jumlah FROM hewan WHERE item_name LIKE 'Bebek Anakan'")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($mysqli));
            $data = mysqli_fetch_assoc($query);
            ?>
                    <div class="inner">
                        <h1 style="text-align:center">
                            Bibit Bebek
                            <h3 style='text-align:center'><?php echo $data['jumlah'] ?></h3>
                            </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <a href="?module=daftarhewan" class="small-box-footer" data-toggle="tooltip">
            <div class="col-lg-3 col-xs-6" style="width:50%">
                <!-- small box -->

                <div id="divjum" style="background-color:#69BE69;color:#fff;height:110px;" onmouseover="this.style.background='gray';"
                    onmouseout="this.style.background='#69BE69';" class="small-box">
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
            <div id="jumpakan" style="background-color:#CE794E;color:#fff;height:110px;" onmouseover="this.style.background='gray';"
                onmouseout="this.style.background='#CE794E';" class="small-box">
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



    <!-- Tambah Info Hewan sakit dan kadaluarsa -->
    <div class="row">
        <a href="?module=hewansakit" class="small-box-footer" title="Lihat Detail" data-toggle="tooltip">
            <div class="col-lg-3 col-xs-6" style="width:50%">
                <!-- small box -->

                <div style="background-color:#69BE69;color:#fff;height:110px" onmouseover="this.style.background='gray';"
                    onmouseout="this.style.background='#69BE69';" class="small-box">
                    <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($mysqli, "SELECT SUM(amount) as jumlah FROM sakit")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <div class="inner">
                        <h2 style="text-align:center">
                            <?php echo $data['jumlah']; ?>
                            <p>Jumlah Hewan Sakit</p>
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


    <a href="?module=pakanrusak" class="small-box-footer" data-toggle="tooltip" style="hover-color:#00094E">
        <div class="col-lg-3 col-xs-6" style="width:50%">
            <!-- small box -->
            <div style="background-color:#CE794E;color:#fff;height:110px" onmouseover="this.style.background='gray';"
                onmouseout="this.style.background='#CE794E';" class="small-box">
                <?php  
            // fungsi query untuk menampilkan data dari tabel obat
            $query = mysqli_query($mysqli, "SELECT SUM(amount) as jumlah FROM kedaluarsa")
                                            or die('Ada kesalahan pada query tampil Data Obat: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                <div class="inner">
                    <h2 style="text-align:center">
                        <?php echo $data['jumlah']; ?>
                        <p>Jumlah Kadaluarsa</p>
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


        <div class="col-lg-3 col-xs-6" style="width:50%">
            <!-- small box -->
            <div style="background-color:#dd4b39;color:#fff" class="small-box">
                <div class="inner">
                    <?php   
            // fungsi query untuk menampilkan data dari tabel obat masuk
            $query = mysqli_query($mysqli, "SELECT COUNT(transaction_id) as jumlah FROM barang_masuk WHERE item_id < 70000")
                                            or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <h3>
                        <?php echo $data['jumlah']; ?>
                    </h3>
                    <p>Laporan Pakan Masuk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
                <a href="?module=laporanmasuk" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i
                        class="fa fa-print"></i></a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6" style="width:50%">
            <!-- small box -->
            <div style="background-color:#dd4b39;color:#fff" class="small-box">
                <div class="inner">
                    <?php   
            // fungsi query untuk menampilkan data dari tabel obat masuk
            $query = mysqli_query($mysqli, "SELECT COUNT(transaction_id) as jumlah FROM barang_keluar where item_id > 70000 and misc = 'Terjual'")
                                            or die('Ada kesalahan pada query tampil Data barang Keluar: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <h3>
                        <?php echo $data['jumlah']; ?>
                    </h3>
                    <p>Laporan Hewan Keluar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-out"></i>
                </div>
                <a href="?module=laporanhewankeluar" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i
                        class="fa fa-print"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6" style="width:50%">
            <!-- small box -->
            <div style="background-color:#dd4b39;color:#fff" class="small-box">
                <div class="inner">
                    <?php   
            // fungsi query untuk menampilkan data dari tabel obat masuk
            $query = mysqli_query($mysqli, "SELECT COUNT(transaction_id) as jumlah FROM barang_keluar where item_id < 70000")
                                            or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <h3>
                        <?php echo $data['jumlah']; ?>
                    </h3>
                    <p>Laporan Pakan Keluar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-usd"></i>
                </div>
                <a href="?module=laporanpakankeluar" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i
                        class="fa fa-print"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6" style="width:50%">
            <!-- small box -->
            <div style="background-color:#dd4b39;color:#fff" class="small-box">
                <div class="inner">
                    <?php   
            // fungsi query untuk menampilkan data dari tabel obat masuk
            $query = mysqli_query($mysqli, "SELECT COUNT(transaction_id) as jumlah FROM barang_keluar where item_id > 70000 and misc = 'Sakit'")
                                            or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <h3>
                        <?php echo $data['jumlah']; ?>
                    </h3>
                    <p>Laporan Hewan Sakit</p>
                </div>
                <div class="icon">
                    <i class="fa fa-medkit"></i>
                </div>
                <a href="?module=laporanhewansakit" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i
                        class="fa fa-print"></i></a>
            </div>
        </div><!-- ./col -->




    </div><!-- /.row -->
    <div class="row">
    <div class="col-lg-3 col-xs-6" style="width:100%">
            <!-- small box -->
            <div style="background-color:#dd4b39;color:#fff" class="small-box">
                <div class="inner">
                    <?php   
            // fungsi query untuk menampilkan data dari tabel obat masuk
            $query = mysqli_query($mysqli, "SELECT COUNT(expired_id) as jumlah FROM kedaluarsa")
                                            or die('Ada kesalahan pada query tampil Data barang Masuk: '.mysqli_error($mysqli));

            // tampilkan data
            $data = mysqli_fetch_assoc($query);
            ?>
                    <h3 style="text-align: center">
                        <?php echo $data['jumlah']; ?>
                    </h3>
                    <p style="text-align: center">Laporan Pakan Kadaluarsa</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar-times-o"></i>
                </div>
                <a href="?module=laporankadaluarsa" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i
                        class="fa fa-print"></i></a>
            </div>
        </div><!-- ./col -->
    </div>

    <!--=============================================================================================================-->
    <div class="row">
        <div class="col-lg-12 col-xs-12" style="width:10%"></div>
        <div class="col-lg-12 col-xs-12" style="width:80%">
            <div id="chart-container">
                <div style="padding:5px" class="small-box">
                    <canvas id="graphPenjualan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12" style="width:10%"></div>
    </div>
    <!--/.row-->


</section><!-- /.content -->