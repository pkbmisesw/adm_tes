<?php
include '../../config.php';
include 'components.php';
error_reporting(0);


if (!isset($_SESSION['email'])) {
    header('Location: ../../login.php');
    exit;
}

$template = "pages";

$pageId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// $pageData = getPagesById($pageId);


if (!$pageData) {
    echo "Halaman tidak ditemukan!";
    exit;
}
?>

<h1>Edit Pages</h1>
<form action="../../controller/<?php echo $template; ?>_controller.php?op=edit_basic" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($pageData["id"]); ?>" />
    <table>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" value="<?php echo htmlspecialchars($pageData["nama"]); ?>" /></td>
        </tr>
        <tr>
            <td>Urut</td>
            <td><input type="number" name="urut" value="<?php echo htmlspecialchars($pageData["urut"]); ?>" /></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="status">
                    <option value="1" <?php echo $pageData["status"] == 1 ? 'selected' : ''; ?>>Aktif</option>
                    <option value="0" <?php echo $pageData["status"] == 0 ? 'selected' : ''; ?>>Non-Aktif</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>URL</td>
            <td><input type="text" name="url" value="<?php echo htmlspecialchars($pageData["url"]); ?>"
                    placeholder="pages?p=" /></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Edit" /></td>
        </tr>
    </table>
</form>