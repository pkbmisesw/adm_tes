<?php
include '../../config.php';
include 'components.php';
error_reporting(0);

/* Halaman ini tidak dapat diakses jika belum ada yang login(masuk) */
if(isset($_SESSION['email'])== 0) {
	header('Location: index.php');
}

$template = "user";

$userData = getUserById($_GET['id']);

?>

<h1>Edit User</h1>
<form action="../../controller/<?php echo $template; ?>_controller.php?op=edit" method="post">
    <table>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" value='<?php echo $userData["nama"]; ?>' /></td>
        </tr>
        <tr>
            <td>Level ID</td>
            <td><input type="text" name="level_id" value='<?php echo $userData["level_id"]; ?>' /></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value='<?php echo $userData["email"]; ?>' /></td>
        </tr>
        <tr>
            <td>Status Aktif</td>
            <td><input type="text" name="email" value='<?php echo $userData["status_aktif"]; ?>' /></td>
        </tr>
        <tr>
            <td>HP</td>
            <td><input type="text" name="email" value='<?php echo $userData["hp"]; ?>' /></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Edit" />
            </td>
        </tr>
    </table>
</form>