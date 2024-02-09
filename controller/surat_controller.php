<?php
ini_set('display_errors', 0);
include "../config.php";
session_start();

$op = $_GET['op'];
if($op == "edit"){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $tgl = $_POST['tgl'];
        $gambar = $_FILES['gambar'];
        $status = $_POST['status'];

        try {
            $sql = "UPDATE m_surat SET 
            nama = :nama, 
            tgl = :tgl, 
            url = :url, 
            stat = :stat
			WHERE id = $id";

            $baseDir = $_SERVER['DOCUMENT_ROOT'];
            $imageDir = $baseDir."/images/";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':tgl', $tgl);
            $stmt->bindParam(':url', $gambar["name"]);
            $stmt->bindParam(':stat', $status);
            $stmt->execute();

            $result = move_uploaded_file($gambar['tmp_name'], $imageDir.$gambar['name']);
            if(!$result){
                echo "<script>alert('Data Gagal dirubah'); document.location.href=('../view/m_surat/')</script>";
            }

            echo "<script>alert('Data telah dirubah'); document.location.href=('../view/m_surat/')</script>";
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }

    }else if ($op == "hapus"){
        $id = $_GET['id'];

        $sql = "DELETE FROM m_surat WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if(!$stmt){
            echo "<script>alert('Gagal Menghapus'); document.location.href=('../view/m_surat/')</script>";
        }

        echo "<script>alert('Berhasil Menghapus'); document.location.href=('../view/m_surat/')</script>";

    } else if ($op == "tambah"){
        $nama = $_POST['nama'];
        $tgl = $_POST['tgl'];
        $status = $_POST['status'];

        try{
            $sql = "INSERT INTO m_surat (nama, tgl, stat) VALUES (:nama, :tgl, :status)";
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(":nama", $nama);
            $stmt->bindValue(":tgl", $tgl);
            $stmt->bindValue(":status", $status);

            $result = $stmt->execute();

            if(!$result){
                echo "<script>alert('Gagal Menambahkan Surat'); document.location.href=('../view/m_surat/')</script>";
            }

            echo "<script>alert('Berhasil Menambahkan Surat'); document.location.href=('../view/m_surat/')</script>";
        }catch(PDOException $e){
            echo $e->getMessage();
        }

       
        echo "<script>document.location.href=('../view/m_surat/')</script>";
}

?>