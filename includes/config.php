<?php 

$host = 'localhost';
$user = 'root';
$pass = '';

$db = new PDO("mysql:host=localhost;dbname=brc", $user, $pass);
if (!$db) {
  die('Tidak dapat membuka koneksi: '. mysqli_error());
}

?>
