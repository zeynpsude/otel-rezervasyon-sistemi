<?php
include("db.php"); 

if (isset($_POST['rezervasyonID'])) {
    $rezervasyonID = $_POST['rezervasyonID'];

    $stmt = $conn->prepare("UPDATE rezervasyonlar SET RezervasyonDurum = 2 WHERE RezervasyonID = :rezervasyonID");
    $stmt->bindParam(':rezervasyonID', $rezervasyonID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Rezervasyon başarıyla iptal edildi."]);
    } else {
        echo json_encode(["message" => "Bir hata oluştu. Rezervasyon iptal edilemedi."]);
    }
} else {
    echo json_encode(["message" => "Geçersiz rezervasyon ID."]);
}
?>
