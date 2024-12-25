<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Yap</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Ödeme Yap</h1>
        <a href ="giris.php">Geri Dön</a>
        <div class="card">
            <div class="card-body">
                <form action="odeme.php" method="post">
                    <div class="form-group">
                        <label for="rezervasyon_id">Rezervasyon ID:</label>
                        <input type="number" id="rezervasyon_id" name="rezervasyon_id" class="form-control" 
                               value="<?php echo isset($_GET['rezervasyonID']) ? $_GET['rezervasyonID'] : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="tutar">Tutar:</label>
                        <input type="number" id="tutar" name="tutar" class="form-control" 
                               value="<?php echo isset($_GET['fiyat']) ? $_GET['fiyat'] : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="odeme_yontemi">Ödeme Yöntemi:</label>
                        <select id="odeme_yontemi" name="odeme_yontemi" class="form-control" required>
                            <option value="Nakit">Nakit</option>
                            <option value="Havale / EFT">Havale / EFT</option>
                            <option value="Kredi Kartı">Kredi Kartı</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Ödeme Yap</button>
                </form>
            </div>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rezervasyonID = $_POST['rezervasyon_id'];
            $tutar = $_POST['tutar'];
            $odemeYontemi = $_POST['odeme_yontemi'];

            $sql = "INSERT INTO odemeler (RezervasyonID, tutar, odemeYontemi) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $rezervasyonID, PDO::PARAM_INT);
            $stmt->bindParam(2, $tutar, PDO::PARAM_STR);
            $stmt->bindParam(3, $odemeYontemi, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $updateSql = "UPDATE rezervasyonlar SET OdemeDurumu = 1 WHERE RezervasyonID = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bindParam(1, $rezervasyonID, PDO::PARAM_INT);
                if ($updateStmt->execute()) {
                    echo '<div class="alert alert-success mt-4">Ödeme başarıyla alındı ve rezervasyon durumu güncellendi!</div>';
                } else {
                    echo '<div class="alert alert-warning mt-4">Rezervasyon ödeme durumu güncellenemedi.</div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-4">Ödeme başarısız: ' . implode(', ', $stmt->errorInfo()) . '</div>';
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
