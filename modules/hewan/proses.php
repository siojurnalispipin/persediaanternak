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
            $query = mysqli_query($mysqli, "SELECT * FROM hewan WHERE item_name ='$item_name' AND type='$type'")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
            if($query->num_rows > 0){
                echo "<script type='text/javascript'>alert('Nama dan jenis hewan yang sama sudah terdaftar !');</script>";
                header("location: ../../main.php?module=form_hewan&alert=1");
            }
            else{
                // perintah query untuk menyimpan data ke tabel obat
                $query = mysqli_query($mysqli, "INSERT INTO hewan(item_id,item_name,amount,type,price,item_image) 
                                                VALUES('$item_id','$item_name','$amount','$type','$price','$item_image')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=daftarhewan&alert=1");
                }   
            }
        }   
    }

    elseif ($_GET['act']=='insertsc') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $sick_id    = trim($_POST['sick_id']);
            $item_name  = trim($_POST['item_name']);
            $amount     = trim($_POST['amount']);
            $created_user = $_SESSION['user_id'];

            $query = $mysqli->query("SELECT * from hewan where item_name='$item_name'");
            $data = $query->fetch_assoc();

            //Cek apakah jumlah hewan sakit lebih kecil dari stok
            if((int)$data['amount'] >= $amount){
                //buat kde transaksi
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
                
                $query = mysqli_query($mysqli, "INSERT INTO sakit(sick_id,item_name,amount) 
                                                VALUES('$sick_id','$item_name','$amount')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
                $amount2 = (int)$data['amount'] - $amount; 
                $item_id = $data['item_id'];
                $type = $data['type'];
                $price = $data['price'];
                $item_image = $data['item_image'];
                $tracked_by = $_SESSION['acces'];
                $query = mysqli_query($mysqli, "INSERT INTO barang_keluar(transaction_id,item_id,description,amount,tracked_by,misc)
                                                VALUES('$transaction_id','$item_id','$item_name','$amount','$tracked_by','Sakit')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

                $query = mysqli_query($mysqli, "UPDATE hewan SET  item_id       = '$item_id',
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
                    header("location: ../../main.php?module=hewansakit&alert=1");
                }   
            }
            else{
                header("location: ../../main.php?module=form_hewan&form=add2&alert=2");                
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
                $query = mysqli_query($mysqli, "SELECT * FROM hewan WHERE item_name ='$item_name' AND type='$type'")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
                if($query->num_rows > 0){
                    header("location: ../../main.php?module=daftarhewan&alert=5");
                }
                else{
                    $updated_user = $_SESSION['user_id'];

                    // perintah query untuk mengubah data pada tabel obat
                    $query = mysqli_query($mysqli, "UPDATE hewan SET  item_id       = '$item_id',
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
                        header("location: ../../main.php?module=daftarhewan&alert=2");
                    }    
                }     
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $item_id = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel obat
            $query = mysqli_query($mysqli, "DELETE FROM hewan WHERE item_id='$item_id'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=daftarhewan&alert=3");
            }
        }
    }     

    elseif ($_GET['act']=='deletesc') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel obat
            $query = mysqli_query($mysqli, "DELETE FROM sakit WHERE sick_id='$id'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=hewansakit&alert=3");
            }
        }
    }       

    //=============

     // Insert hewan Masuk
    elseif ($_GET['act']=='insert3') {
        if (isset($_POST['simpan'])) {
            $transaction_id = trim($_POST['transaction_id']);
            $item_id        = trim($_POST['item_id']);
            $amount         = trim($_POST['amount']);
            $tracked_by     = trim($_POST['tracked_by']);
            $misc           = trim($_POST['misc']);
            // Query Ambil Nama
            $query      = mysqli_query($mysqli, "SELECT * FROM hewan WHERE item_id = $item_id");
            $data       = $query->fetch_assoc();
            $item_name  = $data['item_name']; 
            // Query Update Jumlah Hewan ++
            $query = mysqli_query($mysqli, "UPDATE hewan SET amount = amount + $amount WHERE item_id = $item_id")
                         or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
            // Query Tambah Hewan Masuk
            $query = mysqli_query($mysqli, "INSERT INTO barang_masuk(transaction_id,item_id,description,amount,tracked_by,misc)
                                            VALUES('$transaction_id',$item_id,'$item_name',$amount,'$tracked_by','$misc')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
            if ($query) {
                header("location: ../../main.php?module=hewanmasuk&alert=1");
            }    
        }
    }
    // Insert Hewan Keluar
    elseif ($_GET['act']=='insert4') {
        if (isset($_POST['simpan'])) {
            $transaction_id   = trim($_POST['transaction_id']);
            $item_id          = trim($_POST['item_id']);
            $amount           = trim($_POST['amount']);
            $tracked_by       = trim($_POST['tracked_by']);
            $misc             = trim($_POST['misc']);
            $enough = false;
            // Query Cek Jumlah Hewan 
            $query = $mysqli->query("SELECT * FROM hewan where item_id = $item_id");
            $data = $query->fetch_assoc();
            $item_name  = $data['item_name']; 
            // Cek Jumlah Stok Sebelum Keluarkan Barang
            if((int)$data['amount'] >= $amount){
                $enough=true;
                $amount2 = (int)$data['amount'] - $amount; 
                $query = mysqli_query($mysqli, "UPDATE hewan SET amount = $amount2 WHERE item_id = $item_id")
                            or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                            $created_user = $_SESSION['user_id'];
                // perintah query untuk menyimpan data ke tabel obat
                $query = mysqli_query($mysqli, "INSERT INTO barang_keluar(transaction_id,item_id,description,amount,tracked_by,misc)
                        VALUES('$transaction_id',$item_id,'$item_name',$amount,'$tracked_by','$misc')")
                        or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
                // cek query
                if ($query) {
                    header("location: ../../main.php?module=hewankeluar&alert=1");
                }   
            }
        }
    }
    // Update Hewan
    elseif ($_GET['act']=='update3') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['transaction_id'])) {
                $transaction_id = $_POST['transaction_id'];
                $item_name      = $_POST['description'];
                $amount         = $_POST['amount'];
                // ambil data hasil submit dari form
                $query          = mysqli_query($mysqli, "SELECT * FROM barang_masuk WHERE transaction_id ='$transaction_id'");
                $data           = $query->fetch_assoc();
                $amountAwal = $data['amount'];
                // ambil item_id dari query
                $query          = mysqli_query($mysqli, "SELECT * FROM hewan WHERE item_name ='$item_name'");
                $data           = $query->fetch_assoc();
                $item_id        = $data['item_id'];
                // Hitung Kembalian Jumlah yang diubah
                
                if($amountAwal < $amount){
                    $tambah = $amount-$amountAwal;
                    $query = mysqli_query($mysqli, "UPDATE hewan set amount = amount + $tambah WHERE item_id = $item_id ");
                }
                elseif($amountAwal > $amount){
                    $kurangi = $amountAwal-$amount;
                    $query = mysqli_query($mysqli, "SELECT * FROM hewan WHERE item_id =$item_id");
                    $data = $query->fetch_assoc();
                    if($data['amount'] >= $kurangi){
                        $query = mysqli_query($mysqli, "UPDATE hewan set amount = amount - $kurangi WHERE item_id = $item_id ");

                    }
                    else{
                        header("location: ../../main.php?module=hewanmasuk&alert=5");
                    }
                }
                $query = mysqli_query($mysqli, "UPDATE barang_masuk set item_id = $item_id, description='$item_name', amount=$amount where transaction_id='$transaction_id'")
                                            or die('Ada kesalahan pada query Update hewan masuk : '.mysqli_error($mysqli));    
                if($query){
                    header("location: ../../main.php?module=hewanmasuk&alert=2");
                }
            }
        }
    }
    // Update Hewan
    elseif ($_GET['act']=='update4') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['transaction_id'])) {
                // ambil data hasil submit dari form
                $query          = mysqli_query($mysqli, "SELECT * FROM barang_keluar WHERE transaction_id ='$transaction_id'");
                $data           = $query->fetch_assoc();
                $transaction_id = $_POST['transaction_id'];
                $description    = $_POST['description'];
                $amount         = $_POST['amount'];
                $amountAwal = $data['amount'];
                // ambil item_id dari query
                $query          = mysqli_query($mysqli, "SELECT * FROM hewan WHERE item_name ='$item_name'");
                $data           = $query->fetch_assoc();
                $item_id        = $data['item_id'];
                // Hitung Kembalian Jumlah yang diubah
                
                if($amountAwal > $amount){
                    $kembali = $amountAwal - $amount;
                    $query = mysqli_query($mysqli, "UPDATE hewan set amount = amount + $kembali WHERE item_id = $item_id ");
                }
                elseif($amountAwal < $amount){
                    $kurangi = $amount - $amountAwal;
                    $query = mysqli_query($mysqli, "SELECT * FROM hewan WHERE item_id =$item_id");
                    $data = $query->fetch_assoc();
                    if($data['amount'] >= $kurangi){
                        $query = mysqli_query($mysqli, "UPDATE hewan set amount = amount - $kurangi WHERE item_id = $item_id ");

                    }
                    else{
                        header("location: ../../main.php?module=hewankeluar&alert=5");
                    }
                }
                $query = mysqli_query($mysqli, "UPDATE barang_keluar set item_id = $item_id, item_name='$item_name', amount=$amount where item_name='$item_name'")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
                if($query){
                    header("location: ../../main.php?module=hewankeluar&alert=1");
                }
            }
        }
    }
    // Delete Hewan Masuk
    elseif ($_GET['act']=='delete3') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = mysqli_query($mysqli, "SELECT * from barang_masuk WHERE transaction_id ='$id'");
            $data = $query->fetch_assoc();
            $kurangi = $data['amount'];
            $item_id = $data['item_id'];
            $query = mysqli_query($mysqli, "SELECT * from hewan WHERE item_id =$item_id");
            $amount = $data['amount'];
            if($amount >= $kurangi){
                $query = mysqli_query($mysqli, "UPDATE hewan set amount = amount -$kurangi WHERE item_id =$item_id");
                $query = mysqli_query($mysqli, "DELETE FROM barang_masuk WHERE transaction_id='$id'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));
                if ($query) {
                    header("location: ../../main.php?module=hewanmasuk&alert=3");
                }
            }
            else{
                header("location: ../../main.php?module=hewanmasuk&alert=3");
            }
        }
    }    
    // Delete Hewan Keluar
    elseif ($_GET['act']=='delete4') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];    
            // Query hapus Hewan Keluar
            $query = mysqli_query($mysqli, "SELECT * FROM barang_keluar WHERE transaction_id='$id'");
            $data = $query->fetch_assoc();
            $item_id = $data['item_id'];
            $amount = $data['amount'];
            $query = mysqli_query($mysqli, "UPDATE hewan set amount = amount+$amount where item_id = $item_id");
            $query = mysqli_query($mysqli, "DELETE FROM barang_keluar WHERE transaction_id='$id'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));
            // cek hasil query
            if ($query) {
                header("location: ../../main.php?module=hewankeluar&alert=3");
            }
        }
    }  
}       
?>