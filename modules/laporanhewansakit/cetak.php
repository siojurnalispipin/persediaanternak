<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// panggil fungsi untuk format tanggal
include "../../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

// ambil data hasil submit dari form
$tgl1     = $_GET['tgl_awal'];
$explode  = explode('-',$tgl1);
$tgl_awal = $explode[2]."-".$explode[1]."-".$explode[0];

$tgl2      = $_GET['tgl_akhir'];
$explode   = explode('-',$tgl2);
$tgl_akhir = $explode[2]."-".$explode[1]."-".$explode[0];
$tgl = (int)substr($tgl_akhir, 8,2);
$tgl++;

$rest = substr($tgl_akhir, 0, 8);
$rest = $rest.$tgl;
$tgl_akhir = $rest;

if($tgl1 > $hari_ini || $tgl2 > $hari_ini){
    echo "<script type='text/javascript'>alert('Pastikan Tanggal tidak lebih besar dari hari ini !');</script>";
    header("location: ../../main.php?module=laporanhewankeluar&alert=1");
}
elseif(isset($_GET['tgl_awal'])){
    $no    = 1;
    $query = mysqli_query($mysqli, "SELECT transaction_id,item_id,description,amount,tracked_by,misc,transaction_date
                                    FROM barang_keluar WHERE item_id > 70000 and misc = 'Sakit' and transaction_date >= '$tgl_awal' AND transaction_date <= '$tgl_akhir' ORDER BY item_id ASC") // fungsi query untuk menampilkan data dari tabel obat masuk
                                    or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
    $count  = mysqli_num_rows($query);
}
else
{
    return $result;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>LAPORAN HEWAN SAKIT</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
</head>

<body>
    <div id="title">
        LAPORAN HEWAN SAKIT
    </div>
    <?php  
    if ($tgl_awal==$tgl_akhir) { ?>
    <div id="title-tanggal">
        Tanggal
        <?php echo tgl_eng_to_ind($tgl1); ?>
    </div>
    <?php
    } else { ?>
    <div id="title-tanggal">
        Tanggal
        <?php echo tgl_eng_to_ind($tgl1); ?> s.d.
        <?php echo tgl_eng_to_ind($tgl2); ?>
    </div>
    <?php
    }
    ?>

    <hr><br>
    <div id="isi">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">KODE TRANSAKSI</th>
                    <th height="20" align="center" valign="middle">KODE HEWAN</th>
                    <th height="20" align="center" valign="middle">TANGGAL</th>
                    <th height="20" align="center" valign="middle">NAMA HEWAN</th>
                    <th height="20" align="center" valign="middle">STATUS</th>
                    <th height="20" align="center" valign="middle">JUMLAH MASUK</th>
                </tr>
            </thead>
            <tbody>
                <?php
    // jika data ada
    if($count == 0) {
        echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='155' height='13' valign='middle'></td>
                    <td style='padding-left:5px;' width='110' height='13' valign='middle'></td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'></td>
                </tr>";
    }
    // jika data tidak ada
    else {
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query)) {
            $tanggal       = $data['transaction_date'];
            $exp           = explode('-',$tanggal);
            $tanggal_masuk = $exp[2]."-".$exp[1]."-".$exp[0];

            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td width='120' height='13' align='center' valign='middle'>$data[transaction_id]</td>
                        <td width='80' height='13' align='center' valign='middle'>$data[item_id]</td>
                        <td width='165' height='13' align='center' valign='middle'>$data[transaction_date]</td>
                        <td width='180' height='13' style='padding-left:10px; valign='middle'>$data[description]</td>
                        <td width='180' height='13' style='padding-left:5px; valign='middle'>$data[misc]</td>
                        <td style='padding-left:5px;' align='center' width='100' height='13' valign='middle'>$data[amount]</td>
                    </tr>";
            $no++;
        }
    }
?>
            </tbody>
        </table>

        <div id="footer-tanggal">
            Medan,
            <?php echo tgl_eng_to_ind("$hari_ini"); ?>
        </div>
        <div id="footer-jabatan">
            Pimpinan
        </div>

        <div id="footer-nama">
            Alber Laia, S.Kom.
        </div>
    </div>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="LAPORAN DATA HEWAN SAKIT.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
// panggil library html2pdf
require_once('../../assets/plugins/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','F4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>