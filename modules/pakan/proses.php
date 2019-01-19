<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $item_id    = trim($_POST['item_id']);
            $item_name  = trim($_POST['item_name']);
            $amount     = trim($_POST['amount']);
            $type       = trim($_POST['type']);
            $price      = trim($_POST['price']);
            $item_image = trim($_POST['item_image']);

            $created_user = $_SESSION['user_id'];
            $query = mysqli_query($mysqli, "SELECT * FROM pakan WHERE item_name ='$item_name' AND type='$type'")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
            if($query->num_rows > 0){
                echo "<script type='text/javascript'>alert('Nama dan jenis pakan yang sama sudah terdaftar !');</script>";
                header("location: ../../main.php?module=form_pakan&alert=1");
            }
            else{
                // perintah query untuk menyimpan data ke tabel obat
                $query = mysqli_query($mysqli, "INSERT INTO pakan(item_id,item_name,amount,type,price,item_image) 
                                                VALUES('$item_id','$item_name','$amount','$type','$price','$item_image')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=daftarpakan&alert=1");
                }   
            }
        }   
    }
     
    elseif ($_GET['act']=='insertex') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $expired_id    = trim($_POST['expired_id']);
            $item_name  = trim($_POST['item_name']);
            $amount     = trim($_POST['amount']);
            $created_user = $_SESSION['user_id'];

            $query = $mysqli->query("SELECT * from pakan where item_name='$item_name'");
            $data = $query->fetch_assoc();
            if((int)$data['amount'] >= $amount){
                //buat kode transaksi keluar
              $query = $mysqli->query("SELECT transaction_id from barang_keluar order by transaction_id desc limit 1");
              $data = $query->fetch_assoc();
              $lastid = $data['transaction_id'];
              $lastid = (int)substr($lastid,1,5);
              $count = $query->num_rows;
              if ($count > 0) {
                  $num = $lastid+1;
              } else {
                  $num = 10101;
              }
              $transaction_id = "K$num";
                
                // perintah query untuk menyimpan data ke tabel obat
                
                $query = mysqli_query($mysqli, "INSERT INTO kedaluarsa(expired_id,item_name,amount) 
                                                VALUES('$expired_id','$item_name','$amount')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
                $amount2 = (int)$data['amount'] - $amount; 
                $item_id = $data['item_id'];
                $type = $data['type'];
                $price = $data['price'];
                $item_image = $data['item_image'];
                $tracked_by = $_SESSION['acces'];
                $query = mysqli_query($mysqli, "INSERT INTO barang_keluar(transaction_id,item_id,description,amount,tracked_by,misc)
                                                VALUES('$transaction_id','$item_id','$item_name','$amount','$tracked_by','Kedaluarsa')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
               $query = mysqli_query($mysqli, "UPDATE pakan SET  item_id       = '$item_id',
                                                                    item_name      = '$item_name',
                                                                    amount      = '$amount2',
                                                                    type          = '$type',
                                                                    price = '$price',
                                                                    item_image = '$item_image'
                                                              WHERE item_name      = '$item_name'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=pakanrusak&alert=1");
                }   
            }
            else{
                header("location: ../../main.php?module=form_pakan&form=add2&alert=2");                
            }
        }   
    }
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['item_id'])) {
                // ambil data hasil submit dari form
                $item_id    = trim($_POST['item_id']);
                $item_name  = trim($_POST['item_name']);
                $amount     = trim($_POST['amount']);
                $type       = trim($_POST['type']);
                $price      = trim($_POST['price']);
                //ambil gambar backup
                $uji = $_POST['item_image'];
                if($uji=="" || $uji == null ){
                    $item_image = trim($_POST['gambar']);
                }
                else{
                    $item_image = trim($_POST['item_image']);
                }

                $query = mysqli_query($mysqli, "SELECT * FROM pakan WHERE item_name ='$item_name' AND type='$type'")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
                if($query->num_rows > 0){
                    header("location: ../../main.php?module=daftarpakan&alert=5");
                }
                else{
                    $updated_user = $_SESSION['user_id'];

                    // perintah query untuk mengubah data pada tabel obat
                    $query = mysqli_query($mysqli, "UPDATE pakan SET  item_id       = '$item_id',
                                                                        item_name      = '$item_name',
                                                                        amount      = '$amount',
                                                                        type          = '$type',
                                                                        price = '$price',
                                                                        item_image = '$item_image'
                                                                WHERE item_id      = '$item_id'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                    // cek query
                    if ($query) {
                        // jika berhasil tampilkan pesan berhasil update data
                        header("location: ../../main.php?module=daftarpakan&alert=2");
                    }         
                }
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $item_id = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel obat
            $query = mysqli_query($mysqli, "DELETE FROM pakan WHERE item_id='$item_id'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=daftarpakan&alert=3");
            }
        }
    }     

    elseif ($_GET['act']=='deleteex') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel obat
            $query = mysqli_query($mysqli, "DELETE FROM kedaluarsa WHERE expired_id='$id'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=pakanrusak&alert=3");
            }
        }
    }       
}       
?>