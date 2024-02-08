<?php 
include '../../config.php'; // panggil perintah koneksi database
error_reporting(0); 


if(isset($_POST['register'])) { // mengecek apakah form variabelnya ada isinya
	$nama = $_POST['nama']; // isi varibel dengan mengambil data email pada form
    $email = $_POST['email']; // isi varibel dengan mengambil data email pada form
    $password = $_POST['password']; // isi variabel dengan mengambil data password pada form

    $password = password_hash($password, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO m_user (nama, email, password) VALUES (:nama, :email, :password)";
        $stmt = $conn->prepare($sql);
        
        //Bind our variables.
		$stmt->bindValue(':nama', $nama);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
    
        //Execute the statement and insert the new account.
        $result = $stmt->execute();
        
        //If the signup process is successful.
        if($result){
            //What you do here is up to you!
            echo 'Thank you for registering with our website.';
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<!-- DAFTAR -->
<h2>Tambah Data</h2>

<form action="" method="post">
    <table>
		<tr>
            <td>Nama</td>
            <td><input type="text" name="nama"></td>
        </tr>
        <tr>
            <td>email</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="register" value="Register">
            </td>
        </tr>
    </table>
</form>
<a href="./"><button>Home</button></a>