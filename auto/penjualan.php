<?php require_once "config/database.php";
$query = $mysqli->query("SELECT id FROM penjualan ORDER BY id DESC LIMIT 1");

if($query->num_rows == 0){
    $max = 0;
}
else{
    $data = $query->fetch_assoc();
    $max = $data['id'];
}
$bln = 7;
$thn=2018;
$thn2 =(int) date("Y");
$bln2 =(int) date("m");
$n = ($bln2 + 1 + (($thn2-$thn)*12)) - $bln  ;
$bulan = array("Januari", "Februari", "Maret", "April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

for($i=1;$i<=$n;$i++,$bln++){
    if($bln==13){
        $thn++;$bln=1;
    }
    if($bln<10){
        $bl="0$bln";
    }
    else $bl=$bln;
    if($bln+1<10){
        $tm=$bln+1;
        $bl2="0$tm";
    }
    else $bl2 = $bln+1;
    if($bln+1 >12){
        $bl2="01";
        $th2=$thn+1;
    }
    else $th2 = $thn;
    $query = $mysqli->query("SELECT SUM(amount) as sum FROM barang_keluar WHERE misc='Terjual' AND transaction_date BETWEEN '$thn-$bl-01' AND '$th2-$bl2-01'");
    $tmp = $query->fetch_assoc();
    $sum = $tmp['sum'];
    $t1=$bln-1;
    $t2 = ($t1 % 12);
    $month = $bulan[$t2];
    $query2 = $mysqli->query("SELECT amount FROM penjualan WHERE id= $i");
    $data = $query2->fetch_assoc();
    $jlhawal= $data['amount'];
    if($i > $max){
        $query = $mysqli->query("INSERT INTO penjualan (`id`,`month_name`,`amount`) VALUES($i,'$month',$sum)");
    }
    else{
        $query = $mysqli->query("UPDATE penjualan SET amount=$sum WHERE id= $i");
    }
}
//echo json_encode($data);
?>