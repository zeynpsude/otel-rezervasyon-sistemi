<?php
include("db.php");

$query = "SELECT musteri_id , isim, soyisim FROM musteriler";
$customers = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $musteriID = $_POST['musteri_id'];
    $yorum = $_POST['yorum'];
    $puan = $_POST['puan'];

    $sql = "INSERT INTO feedback (MusteriID, yorum, puan) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $musteriID, PDO::PARAM_INT);
    $stmt->bindParam(2, $yorum, PDO::PARAM_STR);
    $stmt->bindParam(3, $puan, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success mt-4">Yorum başarıyla kaydedildi!</div>';
    } else {
        echo '<div class="alert alert-danger mt-4">Yorum kaydedilemedi: ' . implode(', ', $stmt->errorInfo()) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Sayfası</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Müşteri Feedback</h1>
        <a href="giris.php">Geri Dön</a>
        <div class="card">
            <div class="card-body">
                <form action="feedback.php" method="post">
                    <div class="form-group">
                        <label for="tarih">Tarih:</label>
                        <input type="date" id="tarih" name="tarih" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="musteri_id">Müşteri Seç:</label>
                        <select id="musteri_id" name="musteri_id" class="form-control" required>
                            <option value="">Müşteri Seçin</option>
                            <?php foreach ($customers as $customer) { ?>
                                <option value="<?php echo $customer['musteri_id']; ?>"><?php echo $customer['isim'] . ' ' . $customer['soyisim']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="yorum">Yorum:</label>
                        <textarea id="yorum" name="yorum" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="puan">Puan (1-5):</label>
                        <input type="number" id="puan" name="puan" class="form-control" min="1" max="5" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Yorum Ekle</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
