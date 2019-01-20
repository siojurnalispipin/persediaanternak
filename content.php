
<?php
/* panggil file database.php untuk koneksi ke database */
require_once "config/database.php";
/* panggil file fungsi tambahan */
require_once "config/fungsi_tanggal.php";
require_once "config/fungsi_rupiah.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan message = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
	// jika halaman konten yang dipilih home, panggil file view home
	if ($_GET['module'] == 'home') {
		include "modules/home/view.php";
	}
	elseif ($_GET['module'] == 'home2') {
		include "modules/home/chart.php";
	}

// Control modul pakan=================================================================(Start)
	
	elseif ($_GET['module'] == 'daftarpakan') {
		include "modules/pakan/view.php";
	}

	elseif ($_GET['module'] == 'pakanrusak') {
		include "modules/pakan/view2.php";
	}

	elseif ($_GET['module'] == 'pakanmasuk') {
		include "modules/pakan/view3.php";
	}
	elseif ($_GET['module'] == 'pakankeluar') {
		include "modules/pakan/view4.php";
	}
	elseif ($_GET['module'] == 'form_pakan') {
		include "modules/pakan/form.php";
	}

// Control modul pakan=================================================================(End)

// Control modul hewan=================================================================(Start)
	
	elseif ($_GET['module'] == 'daftarhewan') {
		include "modules/hewan/view.php";
	}
	
	elseif ($_GET['module'] == 'hewansakit') {
		include "modules/hewan/view2.php";
	}
	elseif ($_GET['module'] == 'hewanmasuk') {
		include "modules/hewan/view3.php";
	}
	elseif ($_GET['module'] == 'hewankeluar') {
		include "modules/hewan/view4.php";
	}
	elseif ($_GET['module'] == 'form_hewan') {
		include "modules/hewan/form.php";
	}

// Control modul hewan=================================================================(End)

// Control modul barangmasuk===========================================================(Start)

	elseif ($_GET['module'] == 'barangmasuk') {
		include "modules/barangmasuk/view.php";
	}

	elseif ($_GET['module'] == 'form_barangmasuk') {
		include "modules/barangmasuk/form.php";
	}
	
// Control modul barangmasuk===========================================================(End)

// Control modul barangkeluar==========================================================(Start)

	elseif ($_GET['module'] == 'barangkeluar') {
		include "modules/barangkeluar/view.php";
	}

	elseif ($_GET['module'] == 'form_barangkeluar') {
		include "modules/barangkeluar/form.php";
	}
	
// Control modul barangkeluar==========================================================(End)






	// jika halaman konten yang dipilih form obat, panggil file form obat
	elseif ($_GET['module'] == 'form_ternak_sakit') {
		include "modules/sakit/form.php";
	}
//laporan
	elseif ($_GET['module'] == 'laporanmasuk') {
		include "modules/laporanmasuk/view.php";
	}
	// 

	// ----------------------

	// jika halaman konten yang dipilih obat masuk, panggil file view obat masuk
	elseif ($_GET['module'] == 'obat_masuk') {
		include "modules/obat-masuk/view.php";
	}

	// jika halaman konten yang dipilih form obat masuk, panggil file form obat masuk
	elseif ($_GET['module'] == 'form_obat_masuk') {
		include "modules/obat-masuk/form.php";
	}


	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan stok, panggil file view laporan stok
	elseif ($_GET['module'] == 'lap_stok') {
		include "modules/lap-stok/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan obat masuk, panggil file view laporan obat masuk
	elseif ($_GET['module'] == 'lap_obat_masuk') {
		include "modules/lap-obat-masuk/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih user, panggil file view user
	elseif ($_GET['module'] == 'user') {
		include "modules/user/view.php";
	}

	// jika halaman konten yang dipilih form user, panggil file form user
	elseif ($_GET['module'] == 'form_user') {
		include "modules/user/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih profil, panggil file view profil
	elseif ($_GET['module'] == 'profil') {
		include "modules/profil/view.php";
	}

	// jika halaman konten yang dipilih form profil, panggil file form profil
	elseif ($_GET['module'] == 'form_profil') {
		include "modules/profil/form.php";
	}
	// -----------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih password, panggil file view password
	elseif ($_GET['module'] == 'password') {
		include "modules/password/view.php";
	}
}
?>