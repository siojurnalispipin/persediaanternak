<?php 
//============================================================================================================
// jika hak akses = Super Admin, tampilkan menu
if ($_SESSION['acces']=='Admin') { ?>
	<!-- sidebar menu start -->
    <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>
	<?php 
  // Jika Home dipilih
	if ($_GET["module"]=="home") { ?>
		<li class="active">
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	// Jika Home Tidak dipilih
	else { ?>
		<li>
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	//===== Menu Pakan
  // Jika Daftar Pakan dipilih
  if ($_GET["module"]=="daftarpakan") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Pakan Kadaluarsa dipilih
	elseif ($_GET["module"]=="pakanrusak") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li class="active"><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Pakan Kedaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Pakan Masuk dipilih
	elseif ($_GET["module"]=="pakanmasuk") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li class="active"><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Pakan Keluar dipilih
	elseif ($_GET["module"]=="pakankeluar") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li  class="active"><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Menu Hewan tidak dipilih
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	//===== Menu Hewan
	// Jika Daftar Hewan dipilih
	if ($_GET["module"]=="daftarhewan") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Hewan Keluar dipilih
	elseif ($_GET["module"]=="hewansakit") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li class="active"><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Hewan Masuk dipilih
	elseif ($_GET["module"]=="hewanmasuk") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li class="active"><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Hewan Keluar dipilih
	elseif ($_GET["module"]=="hewankeluar") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li class="active"><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Menu Hewan tidak dipilih
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Menu Barang Masuk dipilih
  if ($_GET["module"]=="barangmasuk") { ?>
    <li class="active">
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }
  // Jika Menu Barang Masuk tidak dipilih
  else { ?>
    <li>
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }
	// Jika Menu Barang Keluar dipilih
	if ($_GET["module"]=="barangkeluar") { ?>
    <li class="active">
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }
  // Jika Menu Barang Keluar tidak dipilih
  else { ?>
    <li>
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }
	// Jika menu User dipilih
	if ($_GET["module"]=="user" || $_GET["module"]=="form_user") { ?>
		<li class="active">
			<a href="?module=user"><i class="fa fa-user"></i> Manajemen User</a>
	  	</li>
	<?php
	}
  // Jika menu User tidak dipilih
	else { ?>
		<li>
			<a href="?module=user"><i class="fa fa-user"></i> Manajemen User</a>
	  	</li>
	<?php
	}
	// Jika Menu Ubah Password dipilih
	if ($_GET["module"]=="password") { ?>
		<li class="active">
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	// Jika Menu Ubah Password tidak dipilih
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
// jika hak akses = Head Officer, tampilkan menu
elseif ($_SESSION['acces']=='Head Officer') { ?>
    <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>
	<?php 
  // Jika Home dipilih
	if ($_GET["module"]=="home") { ?>
		<li class="active">
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	// Jika Home Tidak dipilih
	else { ?>
		<li>
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	//===== Menu Pakan
  // Jika Daftar Pakan dipilih
  if ($_GET["module"]=="daftarpakan") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Pakan Kadaluarsa dipilih
	elseif ($_GET["module"]=="pakanrusak") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li class="active"><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Pakan Kedaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Pakan Masuk dipilih
	elseif ($_GET["module"]=="pakanmasuk") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li class="active"><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Pakan Keluar dipilih
	elseif ($_GET["module"]=="pakankeluar") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li  class="active"><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Menu Hewan tidak dipilih
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	//===== Menu Hewan
	// Jika Daftar Hewan dipilih
	if ($_GET["module"]=="daftarhewan") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Hewan Keluar dipilih
	elseif ($_GET["module"]=="hewansakit") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li class="active"><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Hewan Masuk dipilih
	elseif ($_GET["module"]=="hewanmasuk") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li class="active"><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Hewan Keluar dipilih
	elseif ($_GET["module"]=="hewankeluar") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li class="active"><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Menu Hewan tidak dipilih
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Menu Barang Masuk dipilih
  if ($_GET["module"]=="barangmasuk") { ?>
    <li class="active">
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }
  // Jika Menu Barang Masuk tidak dipilih
  else { ?>
    <li>
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }
	// Jika Menu Barang Keluar dipilih
	if ($_GET["module"]=="barangkeluar") { ?>
    <li class="active">
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }
  // Jika Menu Barang Keluar tidak dipilih
  else { ?>
    <li>
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }
	// Jika Menu Ubah Password dipilih
	if ($_GET["module"]=="password") { ?>
		<li class="active">
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	// Jika Menu Ubah Password tidak dipilih
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
// jika hak akses = Owner, tampilkan menu
elseif ($_SESSION['acces']=='Owner') { ?>
	<!-- sidebar menu start -->
    <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>
	<?php 
  // Jika Home dipilih
	if ($_GET["module"]=="home") { ?>
		<li class="active">
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	// Jika Home Tidak dipilih
	else { ?>
		<li>
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	//===== Menu Pakan
  // Jika Daftar Pakan dipilih
  if ($_GET["module"]=="daftarpakan") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Pakan Kadaluarsa dipilih
	elseif ($_GET["module"]=="pakanrusak") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li class="active"><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Pakan Kedaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Pakan Masuk dipilih
	elseif ($_GET["module"]=="pakanmasuk") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li class="active"><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Pakan Keluar dipilih
	elseif ($_GET["module"]=="pakankeluar") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li  class="active"><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Menu Hewan tidak dipilih
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Pakan</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarpakan"><i class="fa fa-circle-o"></i> Daftar Pakan </a></li>
        		<li><a href="?module=pakanrusak"><i class="fa fa-circle-o"></i> Kadaluarsa </a></li>
						<li><a href="?module=pakanmasuk"><i class="fa fa-circle-o"></i> Pakan Masuk </a></li>
						<li><a href="?module=pakankeluar"><i class="fa fa-circle-o"></i> Pakan Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	//===== Menu Hewan
	// Jika Daftar Hewan dipilih
	if ($_GET["module"]=="daftarhewan") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Hewan Keluar dipilih
	elseif ($_GET["module"]=="hewansakit") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li class="active"><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Hewan Masuk dipilih
	elseif ($_GET["module"]=="hewanmasuk") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li class="active"><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Hewan Keluar dipilih
	elseif ($_GET["module"]=="hewankeluar") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li class="active"><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
	// Jika Menu Hewan tidak dipilih
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Ternak</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=daftarhewan"><i class="fa fa-circle-o"></i> Daftar Ternak </a></li>
        		<li><a href="?module=hewansakit"><i class="fa fa-circle-o"></i> Karantina </a></li>
						<li><a href="?module=hewanmasuk"><i class="fa fa-circle-o"></i> Ternak Masuk </a></li>
						<li><a href="?module=hewankeluar"><i class="fa fa-circle-o"></i> Ternak Keluar </a></li>
      		</ul>
    	</li>
    <?php
	}
  // Jika Menu Barang Masuk dipilih
  if ($_GET["module"]=="barangmasuk") { ?>
    <li class="active">
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }
  // Jika Menu Barang Masuk tidak dipilih
  else { ?>
    <li>
      <a href="?module=barangmasuk"><i class="fa fa-clone"></i> Barang Masuk </a>
      </li>
  <?php
  }
	// Jika Menu Barang Keluar dipilih
	if ($_GET["module"]=="barangkeluar") { ?>
    <li class="active">
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }
  // Jika Menu Barang Keluar tidak dipilih
  else { ?>
    <li>
      <a href="?module=barangkeluar"><i class="fa fa-clone"></i> Barang Keluar </a>
      </li>
  <?php
  }
	// Jika Menu Ubah Password dipilih
	if ($_GET["module"]=="password") { ?>
		<li class="active">
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	// Jika Menu Ubah Password tidak dipilih
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