<?php 

include("session.php");
session_start(); 

if (!isset($_SESSION['kullanici_adi'])) {
    header("Location: index.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otel Rezervasyon Sistemi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            text-align: center;
            padding-top: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #005580;
            margin-bottom: 30px;
        }
        a {
            display: block;
            margin: 10px auto;
            padding: 15px 20px;
            width: 200px;
            background-color: #005580;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }
        a:hover {
            background-color: #003d4d;
        }
        .btn-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .welcome-message {
            font-size: 24px;
            font-weight: bold;
            color: #005580;
            margin-bottom: 30px;
        }
        .user-name {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Otel Rezervasyon Sistemi</h1>
    <div class="btn-container">
        <div class="welcome-message">
            Hoşgeldiniz, <span class="user-name"><?php echo htmlspecialchars($_SESSION['kullanici_adi']); ?></span>
        </div>
        <a href="rezervasyon.php" class="btn btn-primary">Rezervasyon Yap</a>
        <a href="mevcut_rezervasyonlar.php" class="btn btn-primary">Rezervasyon Listesi</a>
        <a href="feedback.php" class="btn btn-primary">Geri Bildirim</a>
        <a href="feedback_list.php" class="btn btn-primary">Geri Bildirim Listesi</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
