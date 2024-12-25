<?php 
include("db.php"); 
session_start(); 

$stmt = $conn->prepare("SELECT R.RezervasyonID, R.MusteriID, R.OdaID, R.GirisTarihi, R.CikisTarihi, R.RezervasyonDurum, 
                        R.OdemeDurumu, M.isim, M.soyisim, O.Oda_numarasi, T.odaTipiAdi, T.OdatipiFiyat
                        FROM rezervasyonlar R
                        JOIN musteriler M ON R.MusteriID = M.musteri_id
                        JOIN odalar O ON R.OdaID = O.oda_id
                        JOIN odaTipi T ON O.OdaTipiID = T.OdaTipiID");  

$stmt->execute();
$rezervasyonlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervasyonlar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1000px;
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
        .btn-primary {
            padding: 10px 20px;
            background-color: #005580;
            border: none;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #003d4d;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Mevcut Rezervasyonlar</h1>
    <a href="giris.php">Geri Dön</a>
    <table id="rezervasyonlarTable" class="display">
        <thead>
            <tr>
                <th>Rezervasyon ID</th>
                <th>Müşteri Adı</th>
                <th>Oda Numarası</th>
                <th>Oda Tipi</th> 
                <th>Giriş Tarihi</th>
                <th>Çıkış Tarihi</th>
                <th>Durum</th>
                <th>Ödeme Durumu</th>
                <th>Oda Fiyatı</th> 
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rezervasyonlar as $rezervasyon): ?>
                <tr>
                    <td><?php echo $rezervasyon['RezervasyonID']; ?></td>
                    <td><?php echo $rezervasyon['isim'] . ' ' . $rezervasyon['soyisim']; ?></td>
                    <td><?php echo $rezervasyon['Oda_numarasi']; ?></td>
                    <td><?php echo $rezervasyon['odaTipiAdi']; ?></td> 
                    <td><?php echo $rezervasyon['GirisTarihi']; ?></td>
                    <td><?php echo $rezervasyon['CikisTarihi']; ?></td>
                    <td>
                        <?php 
                        if ($rezervasyon['RezervasyonDurum'] == 1) {
                            echo "Aktif";
                        } elseif ($rezervasyon['RezervasyonDurum'] == 2) {
                            echo "İptal";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($rezervasyon['OdemeDurumu'] == 1) {
                            echo "Ödeme Alındı";
                        } else {
                            echo "Ödeme Alınmadı";
                        }
                        ?>
                    </td>
                    <td><?php echo number_format($rezervasyon['OdatipiFiyat'], 2, ',', '.') . ' TL'; ?></td> 
                    <td>
                        <button class="btn btn-primary mb-2" 
                                onclick="odemeYap(<?php echo $rezervasyon['RezervasyonID']; ?>, <?php echo $rezervasyon['OdatipiFiyat']; ?>)">Ödeme Yap</button>
                        <button class="btn btn-danger" 
                            onclick="iptalEt(<?php echo $rezervasyon['RezervasyonID']; ?>)">İptal Et</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#rezervasyonlarTable').DataTable();
    });

    function odemeYap(rezervasyonID, fiyat) {
        window.location.href = 'odeme.php?rezervasyonID=' + rezervasyonID + '&fiyat=' + fiyat;
    }

    function iptalEt(rezervasyonID) {
        if (confirm("Bu rezervasyonu iptal etmek istediğinizden emin misiniz?")) {
            $.post('iptal_rezervasyon.php', { rezervasyonID: rezervasyonID }, function(response) {
                alert(response.message);
                location.reload(); 
            }, 'json');
        }
    }
</script>

</body>
</html>
