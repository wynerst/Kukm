<?php
require '../sysconfig.inc.php';

// start the output buffering for main content
ob_start();

session_start();

if (!isset($_SESSION['access']) AND !$_SESSION['access']) {
    echo '<script type="text/javascript">alert(\'Anda tidak berhak mengakses laman!\');';
    echo 'location.href = \'../index.php\';</script>';
    die();
}

if (isset($_GET['nid']) AND $_GET['nid'] <> "") {
    // get record
    $idcoa = $_GET['nid'];
    $sql_text = "SELECT c.*, k.nama FROM coa as c
        LEFT JOIN koperasi as k ON c.idkoperasi = k.idkoperasi
        WHERE c.idcoa =". $idcoa;
    $q_neraca = $dbs->query($sql_text);
    $recNeraca = $q_neraca->fetch_assoc();
} else {
    $message = "ERROR...";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

<HTML>
<HEAD>
	
	<meta http-equiv="content-type" content="text/html; charset=WINDOWS-1252" >
	<TITLE></TITLE>
	<meta name="generator" content="Bluefish 2.2.2" >
	<meta name="author" content="Wardiyono" >
	<META NAME="CREATED" CONTENT="20120519;18190399">
	<META NAME="CHANGED" CONTENT="0;0">
	
	<STYLE>
		<!-- 
		BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Arial"; font-size:small }
		 -->
	</STYLE>
	
</HEAD>

<BODY TEXT="#000000">
<?php
if (isset($message) AND $message <> "") {
    utility::jsAlert($message);
}
?>

<TABLE align="center" CELLSPACING="0" cellpadding="4" BORDER="1">
	<TR>
		<TD colspan="10" ALIGN="CENTER"><B><FONT SIZE=4 COLOR="#000000">NERACA KOMPARATIF</FONT></B></TD>
	</TR>
	<TR>
		<TD colspan="10" ALIGN="CENTER"><B><FONT SIZE=4 COLOR="#000000"><?php echo $recNeraca['nama'];?></FONT></B></TD>
	</TR>
	<TR>
		<TD colspan="10" ALIGN="CENTER"><B><FONT SIZE=4 COLOR="#000000"><?php echo $recNeraca['dateposting'];?></FONT></B></TD>
	</TR>
	<TR>
		<TD colspan="10" ALIGN="LEFT"><BR></FONT></TD>
	</TR>
	<TR>
		<TD colspan="3" ALIGN="CENTER" VALIGN=MIDDLE SDNUM="1033;0;DD MMMM YYYY;@"><B>AKTIVA</B></TD>
		<TD ALIGN="CENTER" VALIGN=MIDDLE SDVAL="40543" SDNUM="1033;0;DD MMMM YYYY;@"><B><?php echo $recNeraca['dateposting'];?></B></TD>
		<TD ALIGN="CENTER" VALIGN=MIDDLE SDVAL="40908" SDNUM="1033;0;DD MMMM YYYY;@"><B>31 December 2011</B></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD colspan="2" ALIGN="CENTER" VALIGN=MIDDLE SDNUM="1033;0;DD MMMM YYYY;@"><B>PASIVA</B></TD>
		<TD ALIGN="CENTER" VALIGN=MIDDLE SDVAL="40543" SDNUM="1033;0;DD MMMM YYYY;@"><B><?php echo $recNeraca['dateposting'];?></B></TD>
		<TD ALIGN="CENTER" VALIGN=MIDDLE SDVAL="40908" SDNUM="1033;0;DD MMMM YYYY;@"><B>31 December 2011</B></TD>
	</TR>
	<TR>
		<TD colspan="3" ALIGN="LEFT"><B>I. AKTIVA LANCAR</B></TD>
		<TD ALIGN="RIGHT">-12345687</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><B>I. KEWAJIBAN LANCAR</B></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="1" SDNUM="1033;">1</TD>
		<TD colspan="2" ALIGN="LEFT">Kas</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c1110'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="1" SDNUM="1033;">1</TD>
		<TD ALIGN="LEFT">Simpanan / Tabungan</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c2110'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="2" SDNUM="1033;">2</TD>
		<TD colspan="2" ALIGN="LEFT">Bank</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="2" SDNUM="1033;">2</TD>
		<TD ALIGN="LEFT">Simpanan Berjangka (kurang 1 tahun)</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c2112'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT">a</TD>
		<TD ALIGN="LEFT">Giro</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c1121'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="3" SDNUM="1033;">3</TD>
		<TD ALIGN="LEFT">Simpanan Khusus</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT">b</TD>
		<TD ALIGN="LEFT">Sertifikat Deposito</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c1122'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="4" SDNUM="1033;">4</TD>
		<TD ALIGN="LEFT">Simpanan Karyawan</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="3" SDNUM="1033;">3</TD>
		<TD colspan="2" ALIGN="LEFT">Piutang Pinjaman Anggota</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="5" SDNUM="1033;">5</TD>
		<TD ALIGN="LEFT">Dana Bagian SHU</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="4" SDNUM="1033;">4</TD>
		<TD colspan="2" ALIGN="LEFT">Piutang Pinjaman Non Anggota / Calon Anggota</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="6" SDNUM="1033;">6</TD>
		<TD ALIGN="LEFT">Beban Yang Masih Harus Dibayar</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="5" SDNUM="1033;">5</TD>
		<TD colspan="2" ALIGN="LEFT">Piutang Pinjaman pada Koperasi Lain</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="7" SDNUM="1033;">7</TD>
		<TD ALIGN="LEFT">Pendapatan Diterima Dimuka</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="6" SDNUM="1033;">6</TD>
		<TD colspan="2" ALIGN="LEFT">Penyisihan Piutang Tak tertagih</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="8" SDNUM="1033;">8</TD>
		<TD ALIGN="LEFT">Hutang Bank (Bagian jatuh tempo kurang 1 tahun)</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="7" SDNUM="1033;">7</TD>
		<TD colspan="2" ALIGN="LEFT">Beban Dibayar Dimuka</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="9" SDNUM="1033;">9</TD>
		<TD ALIGN="LEFT">Kewajiban Lain-lain (Bagian jatuh tempo kurang 1 tahun)</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="8" SDNUM="1033;">8</TD>
		<TD colspan="2" ALIGN="LEFT">Pendapatan Akan Diterima</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="CENTER"><B>Jumlah Aktiva Lancar</B></TD>
		<TD ALIGN="RIGHT"><B><?php echo number_format($recNeraca['c11'],2,',','.'); ?></B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="CENTER"><B>Jumlah Kewajiban Lancar</B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD colspan="3" ALIGN="LEFT"><B>II. INVESTASI JANGKA PANJANG</B></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><B>II. KEWAJIBAN JANGKA PANJANG</B></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="1" SDNUM="1033;">1</TD>
		<TD colspan="2" ALIGN="LEFT">Penyertaan Pada Koperasi Sekundair / Lainnya</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="1" SDNUM="1033;">1</TD>
		<TD ALIGN="LEFT">Simpanan Berjangka (lebih 1 tahun)</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="2" SDNUM="1033;">2</TD>
		<TD colspan="2" ALIGN="LEFT">Investasi Pada Surat Berharga</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="2" SDNUM="1033;">2</TD>
		<TD ALIGN="LEFT">Hutang Bank</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="3" SDNUM="1033;">3</TD>
		<TD colspan="2" ALIGN="LEFT">Investasi Lain</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="3" SDNUM="1033;">3</TD>
		<TD ALIGN="LEFT">Hutang ke LPDB</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="4" SDNUM="1033;">4</TD>
		<TD ALIGN="LEFT">Hutang Jangka Panjang Lain</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="CENTER"><B>Jumlah Investasi Jangka Panjang</B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD colspan="2" ALIGN="CENTER"><B>Jumlah Kewajiban Jangka Panjang</B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
	</TR>
	<TR>
		<TD colspan="3" ALIGN="LEFT"><B>III. AKTIVA TETAP</B></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="1" SDNUM="1033;">1</TD>
		<TD colspan="2" ALIGN="LEFT">Tanah</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c1310'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><B>III. EKUITAS</B></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="2" SDNUM="1033;">2</TD>
		<TD colspan="2" ALIGN="LEFT">Bangunan</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c1320'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="1" SDNUM="1033;">1</TD>
		<TD ALIGN="LEFT">Simpanan Pokok / Modal Disetor *)</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="3" SDNUM="1033;">3</TD>
		<TD colspan="2" ALIGN="LEFT">Kendaraan</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c1330'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="2" SDNUM="1033;">2</TD>
		<TD ALIGN="LEFT">Simpanan Wajib / Tambahan Modal Disetor *)</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="4" SDNUM="1033;">4</TD>
		<TD colspan="2" ALIGN="LEFT">Peralatan Kantor</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c1340'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="3" SDNUM="1033;">3</TD>
		<TD ALIGN="LEFT">Modal Penyetaraan</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="5" SDNUM="1033;">5</TD>
		<TD colspan="2" ALIGN="LEFT">Akumulasi Penyusutan</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="4" SDNUM="1033;">4</TD>
		<TD ALIGN="LEFT">Modal Penyertaan</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="5" SDNUM="1033;">5</TD>
		<TD ALIGN="LEFT">Hibah / Donasi</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="CENTER"><B>Jumlah Aktiva Tetap</B></TD>
		<TD ALIGN="RIGHT"><B><?php echo number_format($recNeraca['c13'],2,',','.'); ?></B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="6" SDNUM="1033;">6</TD>
		<TD ALIGN="LEFT">Cadangan Umum</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="7" SDNUM="1033;">7</TD>
		<TD ALIGN="LEFT">Cadangan Resiko</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD colspan="3" ALIGN="LEFT"><B>IV. AKTIVA LAIN - LAIN</B></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="8" SDNUM="1033;">8</TD>
		<TD ALIGN="LEFT">SHU Tahun Lalu Belum Dibagi</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="1" SDNUM="1033;">1</TD>
		<TD colspan="2" ALIGN="LEFT">Beban Pra Operasional</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c1410'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="RIGHT" SDVAL="9" SDNUM="1033;">9</TD>
		<TD ALIGN="LEFT">SHU Tahun Berjalan</TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="RIGHT" SDVAL="2" SDNUM="1033;">2</TD>
		<TD colspan="2" ALIGN="LEFT">Amortisasi Beban Pra Operasional</TD>
		<TD ALIGN="RIGHT"><?php echo number_format($recNeraca['c1415'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="CENTER"><B><BR></B></TD>
		<TD colspan="2" ALIGN="CENTER"><B>Jumlah Ekuitas</B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="2" ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
		<TD ALIGN="RIGHT"><BR></TD>
	</TR>
	<TR>
		<TD colspan="3" ALIGN="CENTER"><B>JUMLAH AKTIVA</B></TD>
		<TD ALIGN="RIGHT"><B><BR><?php echo number_format($recNeraca['c1'],2,',','.'); ?></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
		<TD ALIGN="LEFT" VALIGN=MIDDLE><BR></TD>
		<TD colspan="2" ALIGN="CENTER"><B>JUMLAH KEWAJIBAN DAN EKUITAS</B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
		<TD ALIGN="RIGHT"><B><BR></B></TD>
	</TR>
	<TR>
		<TD colspan="10" ALIGN="LEFT"><BR></TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD colspan="10" ALIGN="LEFT">* Keterangan</TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT">-</TD>
		<TD colspan="9" ALIGN="LEFT">Modal Disetor untuk Unit Simpan Pinjam Koperasi</TD>
	</TR>
	<TR>
		<TD ALIGN="LEFT"><BR></TD>
		<TD ALIGN="LEFT">-</TD>
		<TD colspan="9" ALIGN="LEFT">Tambahan Modal Disetor untuk Unit Simpan Pinjam Koperasi</TD>
	</TR>
</TABLE>
<!-- ************************************************************************** -->
</BODY>

</HTML>

<?php
// main content grab
$main_content = ob_get_clean();

echo $main_content;
