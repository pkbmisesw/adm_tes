<?php
include '../../config.php'; // Pastikan path ke file konfigurasi benar
error_reporting(0);

if (isset($_SESSION['email']) == 0) {
    header('Location: ../../index.php');
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan.'); window.location.href='index.php';</script>";
    exit;
}

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM m_subpages WHERE id = ?");
$sql->execute([$id]);
$data = $sql->fetch();

if (!$data) {
    echo "<script>alert('Data tidak ditemukan.'); window.location.href='index.php';</script>";
    exit;
}

$template = "subpages";
?>

<h2>Edit Subpage</h2>
<form action="update_subpage.php" method="post">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <table>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name="des"><?php echo htmlspecialchars($data['des']); ?></textarea></td>
        </tr>
        <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
        <tr>
            <td></td>
            <td><input type="submit" value="Update"></td>
        </tr>
    </table>
</form>