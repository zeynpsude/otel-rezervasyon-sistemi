<?php 
include("db.php"); 
session_start(); 
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Girişi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h2 class="login-header">Kullanıcı Girişi</h2>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="kullanici_adi">Kullanıcı Adı:</label>
                <input type="text" name="kullanici_adi" id="kullanici_adi" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sifre">Şifre:</label>
                <input type="password" name="sifre" id="sifre" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Giriş Yap</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kullaniciAdi = $_POST['kullanici_adi'];
            $sifre = $_POST['sifre'];

            $sql = "SELECT * FROM kullanicilar WHERE kullanici_adi = :kullanici_adi";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':kullanici_adi', $kullaniciAdi, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ($user['sifre'] == $sifre) {
                    $_SESSION['kullanici_adi'] = $user['kullanici_adi'];
                    $_SESSION['user_id'] = $user['id']; 
                    
                    echo "<div class='alert alert-success mt-3'>Giriş başarılı! Hoş geldiniz, " . htmlspecialchars($kullaniciAdi) . ".</div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = 'giris.php'; // Giriş sonrası yönlendirme
                            }, 2000);
                          </script>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Giriş başarısız! Şifre yanlış.</div>";
                }
            } else {
                echo "<div class='alert alert-danger mt-3'>Giriş başarısız! Kullanıcı adı bulunamadı.</div>";
            }
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
