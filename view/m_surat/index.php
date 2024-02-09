<?php
include '../../config.php';
include 'components.php';
error_reporting(0);

/* Halaman ini tidak dapat diakses jika belum ada yang login(masuk) */
if(isset($_SESSION['email'])== 0) {
	header('Location: ../../index.php');
}

$template = "surat"
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
foreach(getAllSurat() as $surat){
?>

	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $surat['nama'];?></td>
		<td><?php echo $surat['tgl'];?></td>
		<td><a href='../../images/<?php echo $surat['url'] ?>'>Lihat</a></td>
		<td><?php echo $surat['stat'];?></td>
		<td>
		<a href="edit.php?id=<?php echo $surat['id']?>">Edit</a>
		<a onclick="return confirm('are you want deleting data')" href="../../controller/<?php echo $template; ?>_controller.php?op=hapus&id=<?php echo $surat['id']; ?>">❌</a>
		</td>
	</tr>

<?php
$count=$count+1;
} 
?>

</table>
