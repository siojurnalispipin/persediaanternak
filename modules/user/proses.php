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
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert dan update
else {
	// insert data
	if ($_GET['act']=='insert') {
		if (isset($_POST['simpan'])) {
			// ambil data hasil submit dari form
			$username  = mysqli_real_escape_string($mysqli, trim($_POST['username']));
			$password  = md5(mysqli_real_escape_string($mysqli, trim($_POST['password'])));
			$fullname = mysqli_real_escape_string($mysqli, trim($_POST['fullname']));
			$acces = mysqli_real_escape_string($mysqli, trim($_POST['acces']));

			// perintah query untuk menyimpan data ke tabel users
            $query = mysqli_query($mysqli, "INSERT INTO anggota(username,password,fullname,acces)
                                            VALUES('$username','$password','$fullname','$acces')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=user&alert=1");
            }
		}	
	}
	
	// update data
	elseif ($_GET['act']=='update') {
		if (isset($_POST['simpan'])) {
			if (isset($_POST['user_id'])) {
				// ambil data hasil submit dari form
				$user_id            = trim($_POST['user_id']));
				$username           = trim($_POST['username']));
				$password           = trim($_POST['password'])));
				$fullname           = trim($_POST['fullname']));
				$email              = trim($_POST['email']));
				$phone              = trim($_POST['phone']));
				$acces              = trim($_POST['acces']));
				
				$nama_file          = $_FILES['photo']['name'];
				$ukuran_file        = $_FILES['photo']['size'];
				$tipe_file          = $_FILES['photo']['type'];
				$tmp_file           = $_FILES['photo']['tmp_name'];
				
				// tentuka extension yang diperbolehkan
				$allowed_extensions = array('jpg','jpeg','png');
				
				// Set path folder tempat menyimpan gambarnya
				$path_file          = "../../images/user/".$nama_file;
				
				// check extension
				$file               = explode(".", $nama_file);
				$extension          = array_pop($file);

				// jika password tidak diubah dan foto tidak diubah
				if (empty($_POST['password']) && empty($_FILES['foto']['name'])) {
					// perintah query untuk mengubah data pada tabel users
                    $query = mysqli_query($mysqli, "UPDATE anggota SET username 	= '$username',
                    													fullname 	= '$fullname',
                    													email       = '$email',
                    													phone       = '$phone',
                    													acces       = '$acces'
                                                                  WHERE user_id 	= '$user_id'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                    // cek query
                    if ($query) {
                        // jika berhasil tampilkan pesan berhasil update data
                        header("location: ../../main.php?module=user&alert=2");
                    }
				}
				// jika password diubah dan foto tidak diubah
				elseif (!empty($_POST['password']) && empty($_FILES['foto']['name'])) {
					// perintah query untuk mengubah data pada tabel users
                    $query = mysqli_query($mysqli, "UPDATE anggota SET username 	= '$username',
                    													fullname 	= '$fullname',
                    													password 	= '$password',
                    													email       = '$email',
                    													phone       = '$phone',
                    													acces       = '$acces'
                                                                  WHERE user_id 	= '$user_id'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                    // cek query
                    if ($query) {
                        // jika berhasil tampilkan pesan berhasil update data
                        header("location: ../../main.php?module=user&alert=2");
                    }
				}
				// jika password tidak diubah dan foto diubah
				elseif (empty($_POST['password']) && !empty($_FILES['foto']['name'])) {
					// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
					if (in_array($extension, $allowed_extensions)) {
	                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
	                    if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
	                        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
	                        // Proses upload
	                        if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                        		// Jika gambar berhasil diupload, Lakukan : 
                        		// perintah query untuk mengubah data pada tabel users
			                    $query = mysqli_query($mysqli, "UPDATE anggota SET username 	= '$username',
			                    													fullname 	= '$fullname',
			                    													email       = '$email',
			                    													phone       = '$phone',
			                    													foto 		= '$nama_file',
			                    													acces       = '$acces'
			                                                                  WHERE user_id 	= '$user_id'")
			                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

			                    // cek query
			                    if ($query) {
			                        // jika berhasil tampilkan pesan berhasil update data
			                        header("location: ../../main.php?module=user&alert=2");
			                    }
                        	} else {
	                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
	                            header("location: ../../main.php?module=user&alert=5");
	                        }
	                    } else {
	                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
	                        header("location: ../../main.php?module=user&alert=6");
	                    }
	                } else {
	                    // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
	                    header("location: ../../main.php?module=user&alert=7");
	                } 
				}
				// jika password diubah dan foto diubah
				else {
					// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
					if (in_array($extension, $allowed_extensions)) {
	                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
	                    if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
	                        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
	                        // Proses upload
	                        if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                        		// Jika gambar berhasil diupload, Lakukan : 
                        		// perintah query untuk mengubah data pada tabel users
			                    $query = mysqli_query($mysqli, "UPDATE anggota SET username 	= '$username',
			                    													fullname 	= '$fullname',
			                    													password    = '$password',
			                    													email       = '$email',
			                    													phone     = '$phone',
			                    													foto 		= '$nama_file',
			                    													acces   = '$acces'
			                                                                  WHERE user_id 	= '$user_id'")
			                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

			                    // cek query
			                    if ($query) {
			                        // jika berhasil tampilkan pesan berhasil update data
			                        header("location: ../../main.php?module=user&alert=2");
			                    }
                        	} else {
	                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
	                            header("location: ../../main.php?module=user&alert=5");
	                        }
	                    } else {
	                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
	                        header("location: ../../main.php?module=user&alert=6");
	                    }
	                } else {
	                    // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
	                    header("location: ../../main.php?module=user&alert=7");
	                } 
				}
			}
		}
	}

	// update status menjadi aktif
	elseif ($_GET['act']=='on') {
		if (isset($_GET['id'])) {
			// ambil data hasil submit dari form
			$user_id = $_GET['id'];
			$status  = "aktif";

			// perintah query untuk mengubah data pada tabel users
            $query = mysqli_query($mysqli, "UPDATE anggota SET status  = '$status'
                                                          WHERE user_id = '$user_id'")
                                            or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil update data
                header("location: ../../main.php?module=user&alert=3");
            }
		}
	}

	// update status menjadi blokir
	elseif ($_GET['act']=='off') {
		if (isset($_GET['id'])) {
			// ambil data hasil submit dari form
			$user_id = $_GET['id'];
			$status  = "blokir";

			// perintah query untuk mengubah data pada tabel users
            $query = mysqli_query($mysqli, "UPDATE anggota SET status  = '$status'
                                                          WHERE user_id = '$user_id'")
                                            or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil update data
                header("location: ../../main.php?module=user&alert=4");
            }
		}
	}		
}		
?>