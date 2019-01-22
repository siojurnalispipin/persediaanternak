<?php
session_start();
function BuatKodeKeluar(){
    require_once "../../config/database.php";
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
    return $transaction_id;
}
function BuatKodeMasuk(){
    require_once "../../config/database.php";
    $query = $mysqli->query("SELECT transaction_id from barang_masuk order by transaction_id desc limit 1");
    $data = $query->fetch_assoc();
    $lastid = $data['transaction_id'];
    $lastid = (int)substr($lastid,1,5);
    $count = $query->num_rows;
    if ($count > 0) {
        $num = $lastid+1;
    } else {
        $num = 10101;
    }
    $transaction_id = "M$num";
    return $transaction_id;
}
function BuatKodePakan(){
    require_once "../../config/database.php";
    $query = $mysqli->query("SELECT item_id from pakan order by item_id desc limit 1");
    $data = $query->fetch_assoc();
    $lastid = $data['item_id'];
    $lastid = (int)substr($lastid,1,5);
    $count = $query->num_rows;
    if ($count > 0) {
        $num = $lastid+1;
    } else {
        $num = 40101;
    }
    return $num;
}
function BuatKodeKadaluarsa(){
    require_once "../../config/database.php";
    $query = $mysqli->query("SELECT expired_id from kedaluarsa order by expired_id desc limit 1");
    $data = $query->fetch_assoc();
    $lastid = $data['item_id'];
    $lastid = (int)substr($lastid,1,5);
    $count = $query->num_rows;
    if ($count > 0) {
        $num = $lastid+1;
    } else {
        $num = 70101;
    }
    return $num;
}
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
            $use_for    = trim($_POST['use_for']);
            $item_image = trim($_POST['item_image']);
            $created_user = $_SESSION['user_id'];
            // Query Cek jumlah pakan
            $query = mysqli_query($mysqli, "SELECT * FROM pakan WHERE item_name ='$item_name' AND type='$type' AND item_id != $item_id")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
            if($query->num_rows > 0){
                header("location: ../../main.php?module=form_pakan&form=add&alert=4");
            }
            else{
                // Query Tambah Pakan
                $query = mysqli_query($mysqli, "INSERT INTO pakan(item_id,item_name,amount,type,use_for,item_image) 
                                                VALUES($item_id,'$item_name',$amount,'$type','$use_for','$item_image')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
                if ($query) {
                    header("location: ../../main.php?module=daftarpakan&alert=1");
                }   
            }
        }   
    }
     
    // Insert Pakan Kadaluarsa
    elseif ($_GET['act']=='insert2') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $expired_id    = trim($_POST['expired_id']);
            $item_name  = trim($_POST['item_name']);
            $amount     = trim($_POST['amount']);
            $created_user = $_SESSION['user_id'];
            $enough = false;
            // Query Update Jumlah pakan --
            $query = $mysqli->query("SELECT * FROM pakan where item_name = '$item_name'");
            $data = $query->fetch_assoc();
            if((int)$data['amount'] >= $amount){
                $amount2 = (int)$data['amount'] - $amount; 
                $item_id = $data['item_id'];
                $item_name = $data['item_name'];
                $query = mysqli_query($mysqli, "UPDATE pakan SET amount = $amount2 WHERE item_name = '$item_name'")
                        or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                $created_user = $_SESSION['user_id'];
                // Query Pakan Expired
                $query = $mysqli->query("SELECT expired_id from kedaluarsa order by expired_id desc limit 1");
                $data = $query->fetch_assoc();
                $lastid = $data['expired_id'];
                $lastid = (int)substr($lastid,1,5);
                $count = $query->num_rows;
                if ($count > 0) {
                    $num = $lastid+1;
                } else {
                    $num = 10101;
                }           
                $expired_id = "E$num";
                $query = mysqli_query($mysqli, "INSERT INTO kedaluarsa(expired_id,item_name,amount) 
                VALUES('$expired_id','$item_name',$amount)")
                        or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
                // Query Pakan Keluar
                $query = $mysqli->query("SELECT * from barang_keluar order by transaction_id desc limit 1");
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
                $tracked_by = $_SESSION['acces'];
                $misc = "Kadaluarsa";
                $query = mysqli_query($mysqli, "INSERT INTO barang_keluar(transaction_id,item_id,description,amount,tracked_by,misc)
                        VALUES('$transaction_id',$item_id,'$item_name',$amount,'$tracked_by','Kadaluarsa')");
                }
                if($query){
                    header("location: ../../main.php?module=pakanrusak&alert=1");
                }
            else{
                header("location: ../../main.php?module=form_pakan&form=add2&alert=2");
            }   
        }
    }   
    // Insert Pakan Masuk
    elseif ($_GET['act']=='insert3') {
        if (isset($_POST['simpan'])) {
            $transaction_id = trim($_POST['transaction_id']);
            $item_id        = trim($_POST['item_id']);
            $amount         = trim($_POST['amount']);
            $tracked_by     = trim($_POST['tracked_by']);
            $misc           = trim($_POST['misc']);
            // Query Ambil Nama
            $query      = mysqli_query($mysqli, "SELECT * FROM pakan WHERE item_id = $item_id");
            $data       = $query->fetch_assoc();
            $item_name  = $data['item_name']; 
            // Query Update Jumlah Pakan ++
            $query = mysqli_query($mysqli, "UPDATE pakan SET amount = amount + $amount WHERE item_id = $item_id")
                         or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
            // Query Tambah Pakan Masuk
            $query = mysqli_query($mysqli, "INSERT INTO barang_masuk(transaction_id,item_id,description,amount,tracked_by,misc)
                                            VALUES('$transaction_id',$item_id,'$item_name',$amount,'$tracked_by','$misc')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
            if ($query) {
                header("location: ../../main.php?module=pakanmasuk&alert=1");
            }    
        }
    }
    // Insert Pakan Keluar
    elseif ($_GET['act']=='insert4') {
        if (isset($_POST['simpan'])) {
            $transaction_id   = trim($_POST['transaction_id']);
            $item_id          = trim($_POST['item_id']);
            $amount           = trim($_POST['amount']);
            $tracked_by       = trim($_POST['tracked_by']);
            $misc             = trim($_POST['misc']);
            $enough = false;
            // Query Cek Jumlah Pakan 
            $query = $mysqli->query("SELECT * FROM pakan where item_id = $item_id");
            $data = $query->fetch_assoc();
            $item_name  = $data['item_name']; 
            // Cek Jumlah Stok Sebelum Keluarkan Barang
            if((int)$data['amount'] >= $amount){
                $enough=true;
                $amount2 = (int)$data['amount'] - $amount; 
                $query = mysqli_query($mysqli, "UPDATE pakan SET amount = $amount2 WHERE item_id = $item_id")
                            or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                            $created_user = $_SESSION['user_id'];
                // perintah query untuk menyimpan data ke tabel obat
                $query = mysqli_query($mysqli, "INSERT INTO barang_keluar(transaction_id,item_id,description,amount,tracked_by,misc)
                        VALUES('$transaction_id',$item_id,'$item_name',$amount,'$tracked_by','$misc')")
                        or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
                // cek query
                if ($query) {
                    header("location: ../../main.php?module=pakankeluar&alert=1");
                }   
            }
            else{
                header("location: ../../main.php?module=form_pakan&form=add4&alert=1");
            }
        }
    }
    // Update Pakan
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['item_id'])) {
                // ambil data hasil submit dari form
                $item_id    = trim($_POST['item_id']);
                $item_name  = trim($_POST['item_name']);
                $amount     = trim($_POST['amount']);
                $type       = trim($_POST['type']);
                $use_for    = trim($_POST['use_for']);
                //ambil gambar backup
                $uji = $_POST['item_image'];
                if($uji=="" || $uji == null ){
                    $item_image = trim($_POST['gambar']);
                }
                else{
                    $item_image = trim($_POST['item_image']);
                }

                $query = mysqli_query($mysqli, "SELECT * FROM pakan WHERE (item_name ='$item_name' AND type='$type') AND item_id != $item_id")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
                if($query->num_rows > 0){
                    header("location: ../../main.php?module=daftarpakan&alert=5");
                }
                else{
                    $updated_user = $_SESSION['user_id'];

                    // perintah query untuk mengubah data pada tabel obat
                    $query = mysqli_query($mysqli, "UPDATE pakan SET  item_id       = $item_id,
                                                                        item_name   = '$item_name',
                                                                        amount      = $amount,
                                                                        type        = '$type',
                                                                        use_for     = '$use_for',
                                                                        item_image  = '$item_image'
                                                                WHERE item_id       = $item_id")
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
    // Update Pakan
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
                $query          = mysqli_query($mysqli, "SELECT * FROM pakan WHERE item_name ='$item_name'");
                $data           = $query->fetch_assoc();
                $item_id        = $data['item_id'];
                // Hitung Kembalian Jumlah yang diubah
                
                if($amountAwal < $amount){
                    $tambah = $amount-$amountAwal;
                    $query = mysqli_query($mysqli, "UPDATE pakan set amount = amount + $tambah WHERE item_id = $item_id ");
                }
                elseif($amountAwal > $amount){
                    $kurangi = $amountAwal-$amount;
                    $query = mysqli_query($mysqli, "SELECT * FROM pakan WHERE item_id =$item_id");
                    $data = $query->fetch_assoc();
                    $jlhpakan = $data['amount'];
                    if($jlhpakan >= $kurangi){
                        $jlhpakanakhir = $jlhpakan - $kurangi;
                        $query = mysqli_query($mysqli, "UPDATE pakan set amount = $jlhpakanakhir WHERE item_id = $item_id ");
                    }
                    else{
                        header("location: ../../main.php?module=pakanmasuk&alert=5");
                    }
                }
                $query = mysqli_query($mysqli, "UPDATE barang_masuk set item_id = $item_id, description='$item_name', amount=$amount where transaction_id='$transaction_id'")
                                            or die('Ada kesalahan pada query Update pakan masuk : '.mysqli_error($mysqli));    
                if($query){
                    header("location: ../../main.php?module=pakanmasuk&alert=2");
                }
            }
        }
    }
    // Update Pakan
    elseif ($_GET['act']=='update4') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['transaction_id'])) {
                // ambil data hasil submit dari form
                $transaction_id = $_POST['transaction_id'];
                $description    = $_POST['description'];
                $amount         = $_POST['amount'];
                $query          = mysqli_query($mysqli, "SELECT * FROM barang_keluar WHERE transaction_id ='$transaction_id'");
                $data           = $query->fetch_assoc();
                $amountAwal = $data['amount'];
                $item_name = $data['description'];
                // ambil item_id dari query
                $query          = mysqli_query($mysqli, "SELECT * FROM pakan WHERE item_name ='$item_name'");
                $data           = $query->fetch_assoc();
                $item_id        = $data['item_id'];
                // Hitung Kembalian Jumlah yang diubah
                
                if($amountAwal > $amount){
                    $kembali = $amountAwal - $amount;
                    $query = mysqli_query($mysqli, "UPDATE pakan set amount = amount + $kembali WHERE item_id = $item_id ");
                }
                elseif($amountAwal < $amount){
                    $kurangi = $amount - $amountAwal;
                    $query = mysqli_query($mysqli, "SELECT * FROM pakan WHERE item_id =$item_id");
                    $data = $query->fetch_assoc();
                    if($data['amount'] >= $kurangi){
                        $query = mysqli_query($mysqli, "UPDATE pakan set amount = amount - $kurangi WHERE item_id = $item_id ");

                    }
                    else{
                        header("location: ../../main.php?module=pakankeluar&alert=5");
                    }
                }
                $query = mysqli_query($mysqli, "UPDATE barang_keluar set item_id = $item_id, description='$item_name', amount=$amount where description='$item_name'")
                                            or die('Ada kesalahan pada query update barang keluar : '.mysqli_error($mysqli));    
                if($query){
                    header("location: ../../main.php?module=pakankeluar&alert=2");
                }
            }
        }
    }
    // Delete Pakan
    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $item_id = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel obat
            $query = mysqli_query($mysqli, "DELETE FROM pakan WHERE item_id=$item_id")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=daftarpakan&alert=3");
            }
        }
    }     
    // Delete Pakan Kadaluarsa
    elseif ($_GET['act']=='delete2') {
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
    // Delete Pakan Masuk
    elseif ($_GET['act']=='delete3') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = mysqli_query($mysqli, "SELECT * from barang_masuk WHERE transaction_id ='$id'");
            $data = $query->fetch_assoc();
            $kurangi = $data['amount'];
            $item_id = $data['item_id'];
            $query = mysqli_query($mysqli, "SELECT * from pakan WHERE item_id =$item_id");
            $amount = $data['amount'];
            if($amount >= $kurangi){
                $query = mysqli_query($mysqli, "UPDATE pakan set amount = amount -$kurangi WHERE item_id =$item_id");
                $query = mysqli_query($mysqli, "DELETE FROM barang_masuk WHERE transaction_id='$id'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));
                if ($query) {
                    header("location: ../../main.php?module=pakanmasuk&alert=3");
                }
            }
            else{
                header("location: ../../main.php?module=pakanmasuk&alert=3");
            }
        }
    }    
    // Delete Pakan Keluar
    elseif ($_GET['act']=='delete4') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];    
            // Query hapus Pakan Keluar
            $query = mysqli_query($mysqli, "SELECT * FROM barang_keluar WHERE transaction_id='$id'");
            $data = $query->fetch_assoc();
            $item_id = $data['item_id'];
            $amount = $data['amount'];
            $query = mysqli_query($mysqli, "UPDATE pakan set amount = amount+$amount where item_id = $item_id");
            $query = mysqli_query($mysqli, "DELETE FROM barang_keluar WHERE transaction_id='$id'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));
            // cek hasil query
            if ($query) {
                header("location: ../../main.php?module=pakankeluar&alert=3");
            }
        }
    }    

}       
?>