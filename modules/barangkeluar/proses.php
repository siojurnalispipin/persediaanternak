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
            $transaction_id   = trim($_POST['transaction_id']);
            $item_id          = trim($_POST['item_id']);
            $amount           = trim($_POST['amount']);
            $tracked_by       = trim($_POST['tracked_by']);
            $misc             = trim($_POST['misc']);
            $enough = false;
            //$transaction_date = trim($_POST['transaction_date']);
            //ambil nama item
            $kode = (int)substr($item_id,0,1);
            if($kode<=5){                
                $query = $mysqli->query("SELECT * FROM pakan where item_id = '$item_id'");
                $data = $query->fetch_assoc();
                //cek apakah stok lebih besar dari jumlah item yang akan dikeluarkan
                if((int)$data['amount'] >= $amount){
                    $enough=true;
                    $amount2 = (int)$data['amount'] - $amount; 
                    $item_id = $data['item_id'];
                    $item_name = $data['item_name'];
                    $type = $data['type'];
                    $price = $data['price'];
                    $item_image = $data['item_image'];
                    $query = mysqli_query($mysqli, "UPDATE pakan SET  item_id      = '$item_id',
                                                                        item_name  = '$item_name',
                                                                        amount     = '$amount2',
                                                                        type       = '$type',
                                                                        price      = '$price',
                                                                        item_image = '$item_image'
                                                            WHERE item_name      = '$item_name'")
                            or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                }
                else{
                    header("location: ../../main.php?module=barangkeluar&alert=4");
                }
            }
            else{
                $query = $mysqli->query("SELECT * FROM hewan where item_id = '$item_id'");
                $data = $query->fetch_assoc();
                //cek apakah stok lebih besar dari jumlah item yang akan dikeluarkan
                if((int)$data['amount'] >= $amount){
                    $enough=true;
                    $amount2 = (int)$data['amount'] - $amount; 
                    $item_id = $data['item_id'];
                    $item_name = $data['item_name'];
                    $type = $data['type'];
                    $price = $data['price'];
                    $item_image = $data['item_image'];
                    $query = mysqli_query($mysqli, "UPDATE hewan SET  item_id      = '$item_id',
                                                                        item_name  = '$item_name',
                                                                        amount     = '$amount2',
                                                                        type       = '$type',
                                                                        price      = '$price',
                                                                        item_image = '$item_image'
                                                                WHERE item_name    = '$item_name'")
                            or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                }
                else{
                    header("location: ../../main.php?module=barangkeluar&alert=4");
                }
            }
            if($enough){
                $created_user = $_SESSION['user_id'];

                // perintah query untuk menyimpan data ke tabel obat
                $query = mysqli_query($mysqli, "INSERT INTO barang_keluar(transaction_id,item_id,description,amount,tracked_by,misc)
                                                VALUES('$transaction_id','$item_id','$item_name','$amount','$tracked_by','$misc')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=barangkeluar&alert=1");
                }   
            }
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['transaction_id'])) {
                // ambil data hasil submit dari form
                $transaction_id   = trim($_POST['transaction_id']);
                $description      = trim($_POST['description']);
                $amount           = trim($_POST['amount']);
                $tracked_by       = trim($_POST['tracked_by']);
                $misc             = trim($_POST['misc']);

                // perintah query untuk mengubah data pada tabel obat
                
                $query = mysqli_query($mysqli, "UPDATE barang_keluar SET  transaction_id = '$transaction_id',
                                                                        description = '$description',
                                                                        amount= '$amount',
                                                                        tracked_by = '$tracked_by',
                                                                        misc = '$misc'
                                                              WHERE transaction_id      = '$transaction_id'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=barangmasuk&alert=2");
                }         
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $amount = $_GET['amount'];
            $item_id = $_GET['item_id'];
            $kode = (int)substr($item_id,0,1);
            //jika kde aal <5 berarti data yg diolah adalah pakan
            if($kode<=5){
                $query = $mysqli->query("SELECT * from pakan where item_id='$item_id'");
                $data = $query->fetch_assoc();
                if((int)$data['amount'] >= $amount){
                    // perintah query untuk menyimpan data ke tabel obat                 
                    $amount2 = (int)$data['amount'] + $amount; 
                    $item_name = $data['item_name'];
                    //$item_id = $data['item_id'];
                    $type = $data['type'];
                    $price = $data['price'];
                    $item_image = $data['item_image'];
                    $query = mysqli_query($mysqli, "UPDATE pakan SET  item_id       = '$item_id',
                                                                        item_name      = '$item_name',
                                                                        amount      = '$amount2',
                                                                        type          = '$type',
                                                                        price = '$price'
                                                                WHERE item_id      = '$item_id'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                }
                else{
                    header("location: ../../main.php?module=form_barangkeluar&alert=4");
                }
            }
            else{
// Auto syncron stok hewan            
                $query = $mysqli->query("SELECT * from hewan where item_id='$item_id'");
                $data = $query->fetch_assoc();
                if((int)$data['amount'] >= $amount){
                    // perintah query untuk menyimpan data ke tabel obat
                    
                    $query = mysqli_query($mysqli, "DELETE FROM barang_keluar WHERE transaction_id='$id'")
                                                or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));
                    $amount2 = (int)$data['amount'] + $amount; 
                    //$item_id = $data['item_id'];
                    $item_name = $data['item_name'];
                    $type = $data['type'];
                    $price = $data['price'];
                    $item_image = $data['item_image'];
                    $query = mysqli_query($mysqli, "UPDATE hewan SET  item_id       = '$item_id',
                                                                        item_name      = '$item_name',
                                                                        amount      = '$amount2',
                                                                        type          = '$type',
                                                                        price = '$price',
                                                                        item_image = '$item_image'
                                                                WHERE item_id      = '$item_id'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                      
                }
                else{
                    header("location: ../../main.php?module=form_barangkeluar&alert=4");
                }
            }
            $query = mysqli_query($mysqli, "DELETE FROM barang_keluar WHERE transaction_id='$id'")
                                                or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));
            
            // cek query
            if ($query) {
            // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=barangkeluar&alert=1");
            }   
            //===================================================))        
            

        }
    }     
  
}       
?>