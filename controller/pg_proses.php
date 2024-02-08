<?php
ini_set('display_errors', 0);
	include "../config.php";
	session_start();

$op = $_GET['op'];
if($op == "edit"){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
        $email = $_POST['email'];
	  	
        try {
          $sql = "UPDATE m_user SET 
            nama = :nama, 
            email = :email 
			WHERE id = $id" 
             
          ;

          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':nama', $nama);
          $stmt->bindParam(':email', $email);
          $stmt->execute();
        }
        catch(PDOException $e) {
          echo $e->getMessage();
        }
        
        if($stmt){		
			echo "<script>alert('Data telah dirubah'); document.location.href=('../view/m_user/')</script>";
		}else{
			echo "<script>alert('Gagal Data telah dirubah'); document.location.href=('../view/m_user/')</script>";
		}
} else if($op == "hapus"){
		$id = $_GET['id'];
		
		$sql = "DELETE FROM m_user WHERE id = :id";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		
		if($stmt){		
			echo "<script>alert('Berhasil Menghapus'); document.location.href=('../view/m_user/')</script>";
		}else{
			echo "<script>alert('Gagal Menghapus'); document.location.href=('../view/m_user/')</script>";
		}

}