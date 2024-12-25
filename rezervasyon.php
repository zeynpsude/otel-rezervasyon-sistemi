<?php 
include("db.php"); 
session_start(); 

$stmt = $conn->prepare("SELECT OdaTipiID, OdatipiAdi, OdatipiFiyat FROM odatipi");
$stmt->execute();
$odaTipleri = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("SELECT musteri_id, isim, soyisim FROM musteriler");
$stmt2->execute();
$musteriler = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervasyon Yap</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #f4f7f6;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #005580;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            background-color: #005580;
            border: none;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #003d4d;
        }
        .alert {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Rezervasyon Yap</h1>
    <a href ="giris.php">Geri Dön</a>
    <form action="rezervasyon.php" method="post">
    <div class="form-group">
        <label for="musteri">Ad Soyad</label>
        <div style="display: flex; align-items: center;">
            <select name="musteri" id="musteri" class="form-control" required>
                <option value="">Müşteri Seçin</option>
                <?php foreach ($musteriler as $musteri): ?>
                    <option value="<?php echo $musteri['musteri_id']; ?>">
                        <?php echo $musteri['isim'] . ' ' . $musteri['soyisim']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#musteriEkleModal">+</button>
        </div>
    </div>

    <div class="form-group">
        <label for="oda_tipi">Oda Tipi</label>
        <select name="oda_tipi" id="oda_tipi" class="form-control" required>
            <option value="">Oda Tipi Seçin</option>
            <?php foreach ($odaTipleri as $odaTipi): ?>
                <option value="<?php echo $odaTipi['OdaTipiID']; ?>">
                    <?php echo $odaTipi['OdatipiAdi'] . ' - ' . $odaTipi['OdatipiFiyat'] . ' TL'; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="giris_tarihi">Giriş Tarihi</label>
        <input type="date" name="giris_tarihi" id="giris_tarihi" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="cikis_tarihi">Çıkış Tarihi</label>
        <input type="date" name="cikis_tarihi" id="cikis_tarihi" class="form-control" required>
    </div>
    <button type="submit" name="rezervasyonEkle" class="btn btn-primary">Rezervasyon Yap</button>
</form>
<?php
    if (isset($_POST['rezervasyonEkle'])) {
        if (isset($_POST['musteri']) && isset($_POST['oda_tipi']) && isset($_POST['giris_tarihi']) && isset($_POST['cikis_tarihi'])) {
            $MusteriID = $_POST['musteri'];
            $OdaID = $_POST['oda_tipi'];
            $GirisTarihi = $_POST['giris_tarihi'];
            $CikisTarihi = $_POST['cikis_tarihi'];

            $sql = "INSERT INTO rezervasyonlar (MusteriID, OdaID, GirisTarihi, CikisTarihi, RezervasyonDurum) 
                    VALUES (:MusteriID, :OdaID, :GirisTarihi, :CikisTarihi, :RezervasyonDurum)"; 

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':MusteriID', $MusteriID, PDO::PARAM_INT);
            $stmt->bindParam(':OdaID', $OdaID, PDO::PARAM_INT); 
            $stmt->bindParam(':GirisTarihi', $GirisTarihi, PDO::PARAM_STR); 
            $stmt->bindParam(':CikisTarihi', $CikisTarihi, PDO::PARAM_STR); 
            $stmt->bindValue(':RezervasyonDurum', 1, PDO::PARAM_INT); 

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Rezervasyon başarıyla oluşturuldu!</div>";
            } else {
                echo "<div class='alert alert-danger'>Rezervasyon oluşturulamadı: " . implode(", ", $stmt->errorInfo()) . "</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>Lütfen tüm alanları doldurduğunuzdan emin olun.</div>";
        }
    }
    ?>

<div class="modal fade" id="musteriEkleModal" tabindex="-1" role="dialog" aria-labelledby="musteriEkleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="musteriEkleModalLabel">Yeni Müşteri Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="musteriEkleForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="isim">İsim</label>
                                <input type="text" id="isim" name="isim" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="soyisim">Soyisim</label>
                                <input type="text" id="soyisim" name="soyisim" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="tc_kimlik">TC Kimlik</label>
                                <input type="text" id="tc_kimlik" name="tc_kimlik" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="telefon_no">Telefon No</label>
                                <input type="text" id="telefon_no" name="telefon_no" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="ulke">Ülke</label>
                                <input type="text" id="ulke" name="ulke" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="il">İl</label>
                                <input type="text" id="il" name="il" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="ilce">İlçe</label>
                                <input type="text" id="ilce" name="ilce" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="mahalle">Mahalle</label>
                            <input type="text" id="mahalle" name="mahalle" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/rezervasyon.js"></script>


</body>
</html>
