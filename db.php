<?php
$host = "localhost";   
$username = "root";    
$password = "";        
$database = "otell";   

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantısı kurulamadı: " . $e->getMessage());
}
?>
