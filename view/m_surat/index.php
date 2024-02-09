<?php
include '../../config.php';

error_reporting(0);

/* Halaman ini tidak dapat diakses jika belum ada yang login(masuk) */
if(isset($_SESSION['email'])== 0) {
	header('Location: ../../index.php');
}

$master = "Surat";
$dba = "surat";
$ket = "";
$ketnama = "Silahkan mengisi nama";

?>
hi : <?php echo $_SESSION['email']; ?> - 
<a href="logout.php">Logout</a>
<?php
include ("../sidebar.php");
?>


<style>
table, td, th {
	border:1px solid black;
	border-collapse: collapse;
}
</style>

<br>
<table>
<a href="tambah.php">Tambah</a>
<caption>List Surat</caption>
<tr>
<th>No</th>
<th>Nama</th>
<th>Tanggal</th>
<th>Dokumen</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php
$count = 1;			   
$sql = $conn->prepare("SELECT * FROM m_surat ORDER BY id DESC");
$sql->execute();
while($data=$sql->fetch()) {
?>

	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $data['nama'];?></td>
		<td><?php echo $data['tgl'];?></td>
		<td><a href='../../images/<?php echo $data['url'];?>'>Lihat</a></td>
		<td><?php echo $data['stat'];?></td>
		<td>
		<a href="edit.php?id=<?php echo $data['id'];?>">Edit</a>
		<a onclick="return confirm('are you want deleting data')" href="../../controller/<?php echo $dba; ?>_controller.php?op=hapus&id=<?php echo $data['id'];?>">❌</a>
		</td>
	</tr>

<?php
$count=$count+1;
} 
?>

</table>
