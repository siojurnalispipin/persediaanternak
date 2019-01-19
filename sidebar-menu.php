<!-- Aplikasi Persediaan Obat pada Apotek
*******************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 1 April 2017
* Website      : www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<?php 
// fungsi pengecekan level untuk menampilkan menu sesuai dengan hak akses

//============================================================================================================
// jika hak akses = Super Admin, tampilkan menu
if ($_SESSION['acces']=='Admin') { ?>
	<!-- sidebar menu start -->
    <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>

	<?php 
	// fungsi untuk pengecekan menu aktif
	// jika menu home dipilih, menu home aktif



	/*if ($_GET["module"]=="home") { ?>
		<li class="active">
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	// jika tidak, menu home tidak aktif
	else { ?>
		<li>
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}*/

	if ($_GET["module"]=="home2") { ?>
		<li class="active">
			<a href="?module=home2"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	// jika tidak, menu home tidak aktif
	else { ?>
		<li>
			<a href="?module=home2"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
  //top f menu pakan================================================================

  if ($_GET["module"]=="daftarpakan") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i>Pakan Kedaluarsa </a></li>
      		</ul>
    	</li>
    <?php
	}
	// jika menu Laporan obat Masuk dipilih, menu Laporan obat Masuk aktif
	elseif ($_GET["module"]=="pakanrusak") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li class="active"><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Pakan Kedaluarsa </a></li>
      		</ul>
    	</li>
    <?php
	}
// jika menu Laporan tidak dipilih, menu Laporan tidak aktif
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Pakan Kedaluarsa </a></li>
      		</ul>
    	</li>
    <?php
	}

	if ($_GET["module"]=="daftarhewan") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Ternak Sakit </a></li>
      		</ul>
    	</li>
    <?php
	}
	// jika menu Laporan obat Masuk dipilih, menu Laporan obat Masuk aktif
	elseif ($_GET["module"]=="hewansakit") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li class="active"><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Ternak Sakit </a></li>
      		</ul>
    	</li>
    <?php
	}
	// jika menu Laporan tidak dipilih, menu Laporan tidak aktif
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Ternak Sakit </a></li>
      		</ul>
    	</li>
    <?php
	}

  //bottom of menu pakan======================================


  // jika menu data obat masuk dipilih, menu data obat masuk aktif
  if ($_GET["module"]=="barangmasuk") { ?>
    <li class="active">
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }
  // jika tidak, menu data obat masuk tidak aktif
  else { ?>
    <li>
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }

	//Barang Keluar
	if ($_GET["module"]=="barangkeluar") { ?>
    <li class="active">
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }
  // jika tidak, menu data obat masuk tidak aktif
  else { ?>
    <li>
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }

	// jika menu user dipilih, menu user aktif
	if ($_GET["module"]=="user" || $_GET["module"]=="form_user") { ?>
		<li class="active">
			<a href="?module=user"><i class="fa fa-user"></i> Manajemen User</a>
	  	</li>
	<?php
	}
	// jika tidak, menu user tidak aktif
	else { ?>
		<li>
			<a href="?module=user"><i class="fa fa-user"></i> Manajemen User</a>
	  	</li>
	<?php
	}

	// jika menu ubah password dipilih, menu ubah password aktif
	if ($_GET["module"]=="password") { ?>
		<li class="active">
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	// jika tidak, menu ubah password tidak aktif
	else { ?>
		<li>
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	?>
	</ul>
	<!--sidebar menu end-->
<?php
}

//============================================================================================================
// jika hak akses = Manajer, tampilkan menu
elseif ($_SESSION['acces']=='Head Officer') { ?>
	<!-- sidebar menu start -->
    <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>

	<?php 
	// fungsi untuk pengecekan menu aktif
	// jika menu home dipilih, menu home aktif
	if ($_GET["module"]=="home") { ?>
		<li class="active">
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	// jika tidak, menu home tidak aktif
	else { ?>
		<li>
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
  //top f menu pakan================================================================

  if ($_GET["module"]=="daftarpakan") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i>Pakan Kedaluarsa </a></li>
      		</ul>
    	</li>
    <?php
	}
	// jika menu Laporan obat Masuk dipilih, menu Laporan obat Masuk aktif
	elseif ($_GET["module"]=="pakanrusak") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li class="active"><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Pakan Kedaluarsa </a></li>
      		</ul>
    	</li>
    <?php
	}
	// jika menu Laporan tidak dipilih, menu Laporan tidak aktif
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Pakan Kedaluarsa </a></li>
      		</ul>
    	</li>
    <?php
	}

  //bottom of menu pakan======================================


  // jika menu data obat masuk dipilih, menu data obat masuk aktif
  if ($_GET["module"]=="barangmasuk") { ?>
    <li class="active">
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }
  // jika tidak, menu data obat masuk tidak aktif
  else { ?>
    <li>
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }

	//Barang Keluar
	if ($_GET["module"]=="barangkeluar") { ?>
    <li class="active">
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }
  // jika tidak, menu data obat masuk tidak aktif
  else { ?>
    <li>
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }

	// jika menu ubah password dipilih, menu ubah password aktif
	if ($_GET["module"]=="password") { ?>
		<li class="active">
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	// jika tidak, menu ubah password tidak aktif
	else { ?>
		<li>
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	?>
	</ul>
	<!--sidebar menu end-->
<?php
}
//============================================================================================================

// jika hak akses = Gudang, tampilkan menu
if ($_SESSION['acces']=='Owner') { ?>
	<!-- sidebar menu start -->
    <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>

	<?php 
	// fungsi untuk pengecekan menu aktif
	// jika menu home dipilih, menu home aktif
  if ($_GET["module"]=="home") { ?>
    <li class="active">
      <a href="?module=home"><i class="fa fa-home"></i> home </a>
      </li>
  <?php
  }
  // jika tidak, menu home tidak aktif
  else { ?>
    <li>
      <a href="?module=home"><i class="fa fa-home"></i> home </a>
      </li>
  <?php
  }

  // jika menu data obat dipilih, menu data obat aktif
  if ($_GET["module"]=="obat" || $_GET["module"]=="form_obat") { ?>
    <li class="active">
      <a href="?module=obat"><i class="fa fa-folder"></i> Data Bibit & Ternak </a>
      </li>
  <?php
  }
  // jika tidak, menu data obat tidak aktif
  else { ?>
    <li>
      <a href="?module=obat"><i class="fa fa-folder"></i> Data Bibit & Ternak </a>
      </li>
  <?php
  }

  // jika menu data obat masuk dipilih, menu data obat masuk aktif
  if ($_GET["module"]=="obat_masuk" || $_GET["module"]=="form_obat_masuk") { ?>
    <li class="active">
      <a href="?module=obat_masuk"><i class="fa fa-clone"></i> Data Bibit & Ternak Masuk </a>
      </li>
  <?php
  }
  // jika tidak, menu data obat masuk tidak aktif
  else { ?>
    <li>
      <a href="?module=obat_masuk"><i class="fa fa-clone"></i> Data Bibit & Ternak Masuk </a>
      </li>
  <?php
  }

  // jika menu Laporan Stok obat dipilih, menu Laporan Stok obat aktif
  if ($_GET["module"]=="lap_stok") { ?>
    <li class="active treeview">
            <a href="javascript:void(0);">
              <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
          <ul class="treeview-menu">
            <li class="active"><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Bibit & Ternak </a></li>
            <li><a href="?module=lap_obat_masuk"><i class="fa fa-circle-o"></i> Bibit & Ternak Masuk </a></li>
          </ul>
      </li>
    <?php
  }
  // jika menu Laporan obat Masuk dipilih, menu Laporan obat Masuk aktif
  elseif ($_GET["module"]=="lap_obat_masuk") { ?>
    <li class="active treeview">
            <a href="javascript:void(0);">
              <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
          <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Bibit & Ternak </a></li>
            <li class="active"><a href="?module=lap_obat_masuk"><i class="fa fa-circle-o"></i> Bibit & Ternak Masuk </a></li>
          </ul>
      </li>
    <?php
  }
  // jika menu Laporan tidak dipilih, menu Laporan tidak aktif
  else { ?>
    <li class="treeview">
            <a href="javascript:void(0);">
              <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
          <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Bibit & Ternak </a></li>
            <li><a href="?module=lap_obat_masuk"><i class="fa fa-circle-o"></i> Bibit & Ternak Masuk </a></li>
          </ul>
      </li>
    <?php
  }

	// jika menu ubah password dipilih, menu ubah password aktif
	if ($_GET["module"]=="password") { ?>
		<li class="active">
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	// jika tidak, menu ubah password tidak aktif
	else { ?>
		<li>
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	?>
	</ul>
	<!--sidebar menu end-->
<?php
}
?>