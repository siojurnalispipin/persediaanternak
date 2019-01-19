<?php
require_once "config/database.php";
$data = array();
//foreach ($result as $row) {
//	$data[] = $row;
//}
$bln = 6;
$thn=2018;
$thn2 =(int) date("Y");
$bln2 =(int) date("m");
$n = ($bln2-$bln) + (($thn2-$thn)*12);
$bulan = array("Januari", "Februari", "Maret", "April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

for($i=0, $bln=6;$i<$n;$i++,$bln++){
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
    //SELECT SUM(amount) FROM barang_keluar WHERE misc='Terjual' AND transaction_date BETWEEN '2018-07-01' AND '2018-07-02'
    $query = $mysqli->query("SELECT SUM(amount) as sum FROM barang_keluar WHERE misc='Terjual' AND transaction_date BETWEEN '$thn-$bl-01' AND '$th2-$bl2-01'");
    $tmp = $query->fetch_assoc();
    $sum = $tmp['sum'];
    $t1=$bln;
    $t2 = $t1 % 12;
    $month = $bulan[$t2];
    $arr = array($month,(int)$sum);
    array_push($data, $arr);
    $query = $mysqli->query("UPDATE `penjualan` SET `id`=$i,`month_name`='$month',`amount`=$sum WHERE 'id'= $i");
}
//echo json_encode($data);
?>