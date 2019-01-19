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
// panggil file untuk koneksi ke database

//require_once "config/database.php";
$server   = "localhost";
$username = "root";
$password = "";
$database = "pakanternak";
if ($mysqli->connect_error) {
    die('Koneksi Database Gagal : '.$mysqli->connect_error);
}

// koneksi database
$mysqli = new mysqli($server, $username, $password, $database);

// ambil data hasil submit dari form

$username = $_POST['username'];
$password = $_POST['password'];

// ambil data dari tabel user untuk pengecekan berdasarkan inputan username dan passrword
	
$query = $mysqli->query("SELECT * FROM anggota WHERE username='$username' AND password='$password' AND status='active'");
$baris = $query->num_rows;

	// jika data ada, jalankan perintah untuk membuat session
	//if(true){
		
if ($baris >0) {
	$data  = $query->fetch_assoc();
		
	session_start();
	$_SESSION['user_id']   = $data['user_id'];
	$_SESSION['username']  = $data['username'];
	$_SESSION['password']  = $data['password'];
	$_SESSION['fullname'] = $data['fullname'];
	$_SESSION['acces'] = $data['acces'];
	$_SESSION['username']  = $username;
	$_SESSION['password']  = $password;
		
	// lalu alihkan ke halaman user
	header("Location: main.php?module=home2");
}

	// jika data tidak ada, alihkan ke halaman login dan tampilkan pesan = 1
else {
		header("Location: index.php?alert=1");
}

?>