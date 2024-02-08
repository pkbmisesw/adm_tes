<?php
ini_set('display_errors', 0);
include "../config.php";
session_start();

$operation = $_GET['op'];

switch ($operation) {
    case "edit":


        // Ambil data dari POST
        $id = $_POST['id'];
        $pages_id = $_POST['pages_id']; // Baru
        $nama = $_POST['nama'];
        $des = $_POST['des'];

        // Query untuk update data
        $sql = "UPDATE m_subpages SET pages_id = :pages_id, nama = :nama, des = :des WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':pages_id' => $pages_id, ':nama' => $nama, ':des' => $des, ':id' => $id]);


        break;
    case "hapus":
        $id = $_GET['id'];

        $sql = "DELETE FROM m_subpages WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if (!$stmt) {
            echo "<script>alert('Gagal Menghapus'); document.location.href=('../view/m_subpages/')</script>";
        }

        echo "<script>alert('Berhasil Menghapus'); document.location.href=('../view/m_subpages/')</script>";
        break;
    case "tambah":
        $nama = $_POST['nama'];
        $des = $_POST['des'];
        $pages_id = $_POST['pages_id'];

        try {
            $sql = "INSERT INTO m_subpages (nama, des, pages_id) VALUES (:nama, :des, :pages_id)";
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":nama", $nama);
            $stmt->bindValue(":des", $des);
            $stmt->bindValue(":pages_id", $pages_id);

            $result = $stmt->execute();

            if (!$result) {
                echo "<script>alert('Gagal Menambahkan Subpage'); document.location.href=('../view/m_subpages/')</script>";
            }

            echo "<script>alert('Berhasil Menambahkan Subpage'); document.location.href=('../view/m_subpages/')</script>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        break;
    default:
        echo "<script>document.location.href=('../view/m_subpages/')</script>";
}
