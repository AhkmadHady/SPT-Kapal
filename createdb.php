<?php
# Variables
$servername = "localhost";
$username = "root";
$password = "";

# Check Database
$db = new mysqli($servername, $username, $password);

if($db->connect_error){
    die('Koneksi Gagal: ' . $db->connect_error);
}

# Query SQL to create a new database
$sql = "CREATE DATABASE db_bawal";

if ($db->query($sql) === TRUE) {
    echo "Database Berhasil Dibuat";
} else {
    echo "Database Gagal Dibuat: " . $db->error;
}
?>