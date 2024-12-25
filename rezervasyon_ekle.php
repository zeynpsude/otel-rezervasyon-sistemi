<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isim = $_POST['isim'];
    $soyisim = $_POST['soyisim'];
    $tc_kimlik = $_POST['tc_kimlik'];
    $email = $_POST['email'];
    $telefon_no = $_POST['telefon_no'];
    $ulke = $_POST['ulke'];
    $il = $_POST['il'];
    $ilce = $_POST['ilce'];
    $mahalle = $_POST['mahalle'];

    $query = $conn->prepare("INSERT INTO musteriler (isim, soyisim, tc_kimlik, email, telefon_no, ulke, il, ilce, mahalle) 
                           VALUES (:isim, :soyisim, :tc_kimlik, :email, :telefon_no, :ulke, :il, :ilce, :mahalle)");

    if ($query->execute([
        'isim' => $isim,
        'soyisim' => $soyisim,
        'tc_kimlik' => $tc_kimlik,
        'email' => $email,
        'telefon_no' => $telefon_no,
        'ulke' => $ulke,
        'il' => $il,
        'ilce' => $ilce,
        'mahalle' => $mahalle
    ])) {
        echo json_encode(['success' => true, 'id' => $conn->lastInsertId(), 'isim' => $isim, 'soyisim' => $soyisim]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Veritabanına ekleme sırasında bir hata oluştu.']);
    }
}
?>
