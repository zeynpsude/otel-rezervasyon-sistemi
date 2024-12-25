-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 25 Ara 2024, 09:06:59
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `otell`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `MusteriID` int(11) NOT NULL,
  `yorum` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `puan` int(11) DEFAULT NULL CHECK (`puan` between 1 and 5),
  `gonderi_tarihi` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hizmetler`
--

CREATE TABLE `hizmetler` (
  `hizmetID` int(11) NOT NULL,
  `HizmetAdi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `HizmetFiyati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(255) NOT NULL,
  `sifre` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullanici_adi`, `sifre`) VALUES
(1, 'test', 1234);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteriler`
--

CREATE TABLE `musteriler` (
  `musteri_id` int(11) NOT NULL,
  `isim` varchar(50) NOT NULL,
  `soyisim` varchar(50) NOT NULL,
  `Tc_kimlik` bigint(20) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `telefon_no` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ulke` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `il` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ilce` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mahalle` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kayıt_tarihi` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `musteriler`
--

INSERT INTO `musteriler` (`musteri_id`, `isim`, `soyisim`, `Tc_kimlik`, `email`, `telefon_no`, `ulke`, `il`, `ilce`, `mahalle`, `kayıt_tarihi`) VALUES
(1, 'Ahmet', 'Mehmet', 11111111111, 'test@gmail.com', '5532586325', 'Türkiye', 'İstanbul', 'Beyoğlu', 'Test Mahallesi', '0000-00-00'),
(2, 'Veli', 'Sayın', 11111111112, 'rqrwt@gmail.com', '5532586325', 'Türkiye', 'İstanbul2', 'Beyoğlu2', 'Test Mahallesi2', '0000-00-00'),
(25, 'testter', 'tester', 2414, 'bekiraksu68@gmail.com', '421412', 'qweqwe', 'qwe', 'qwewq', 'qew', '2024-12-24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odalar`
--

CREATE TABLE `odalar` (
  `oda_id` int(11) NOT NULL,
  `Oda_numarasi` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `odaTipiID` int(11) NOT NULL,
  `odaKapasitesi` int(11) NOT NULL,
  `odaDurum` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `odalar`
--

INSERT INTO `odalar` (`oda_id`, `Oda_numarasi`, `odaTipiID`, `odaKapasitesi`, `odaDurum`) VALUES
(1, '20', 1, 3, b'1'),
(2, '32', 2, 5, b'1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odatipi`
--

CREATE TABLE `odatipi` (
  `OdaTipiID` int(11) NOT NULL,
  `OdatipiAdi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OdatipiFiyat` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `odatipi`
--

INSERT INTO `odatipi` (`OdaTipiID`, `OdatipiAdi`, `OdatipiFiyat`) VALUES
(1, '2 + 1 ', 1400),
(2, 'Kraliyet Odası', 2000);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odemeler`
--

CREATE TABLE `odemeler` (
  `OdemeID` int(11) NOT NULL,
  `RezervasyonID` int(11) NOT NULL,
  `tutar` int(11) NOT NULL,
  `odemeTarihi` date DEFAULT curdate(),
  `odemeYontemi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `odemeler`
--

INSERT INTO `odemeler` (`OdemeID`, `RezervasyonID`, `tutar`, `odemeTarihi`, `odemeYontemi`) VALUES
(1, 9, 2000, '2024-12-23', NULL),
(2, 9, 2000, '2024-12-23', NULL),
(3, 9, 2000, '2024-12-24', NULL),
(4, 9, 2000, '2024-12-24', 'Havale / EFT'),
(5, 9, 2000, '2024-12-25', 'Nakit'),
(6, 10, 1400, '2024-12-25', 'Nakit');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `otel`
--

CREATE TABLE `otel` (
  `OtelID` int(11) NOT NULL,
  `personelID` int(11) NOT NULL,
  `OdaID` int(11) NOT NULL,
  `MusteriID` int(11) NOT NULL,
  `HizmetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personel`
--

CREATE TABLE `personel` (
  `personelID` int(11) NOT NULL,
  `kullanici_adi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kullanici_soyadi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kullanici_rolu` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `personel_sifre` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rezervasyonlar`
--

CREATE TABLE `rezervasyonlar` (
  `RezervasyonID` int(11) NOT NULL,
  `MusteriID` int(11) NOT NULL,
  `OdaID` int(11) NOT NULL,
  `GirisTarihi` date NOT NULL,
  `CikisTarihi` date NOT NULL,
  `RezervasyonDurum` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `OdemeDurumu` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `rezervasyonlar`
--

INSERT INTO `rezervasyonlar` (`RezervasyonID`, `MusteriID`, `OdaID`, `GirisTarihi`, `CikisTarihi`, `RezervasyonDurum`, `OdemeDurumu`) VALUES
(9, 2, 2, '2024-12-23', '2024-12-24', '2', 1),
(10, 1, 1, '2024-12-16', '2024-12-13', '1', 1),
(11, 1, 1, '2024-12-24', '2024-12-25', '1', 0),
(12, 2, 1, '2024-12-24', '2024-12-18', '1', 0),
(13, 2, 1, '2024-12-24', '2024-12-19', '1', 0),
(14, 1, 1, '2024-12-25', '2024-12-26', '1', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rezervasyon_hizmetleri`
--

CREATE TABLE `rezervasyon_hizmetleri` (
  `Rezervasyon_HizmetID` int(11) NOT NULL,
  `RezervasyonID` int(11) NOT NULL,
  `HizmetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `MusteriID` (`MusteriID`);

--
-- Tablo için indeksler `hizmetler`
--
ALTER TABLE `hizmetler`
  ADD PRIMARY KEY (`hizmetID`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `musteriler`
--
ALTER TABLE `musteriler`
  ADD PRIMARY KEY (`musteri_id`),
  ADD UNIQUE KEY `Tc_kimlik` (`Tc_kimlik`);

--
-- Tablo için indeksler `odalar`
--
ALTER TABLE `odalar`
  ADD PRIMARY KEY (`oda_id`),
  ADD KEY `odaTipiID` (`odaTipiID`);

--
-- Tablo için indeksler `odatipi`
--
ALTER TABLE `odatipi`
  ADD PRIMARY KEY (`OdaTipiID`);

--
-- Tablo için indeksler `odemeler`
--
ALTER TABLE `odemeler`
  ADD PRIMARY KEY (`OdemeID`),
  ADD KEY `RezervasyonID` (`RezervasyonID`);

--
-- Tablo için indeksler `otel`
--
ALTER TABLE `otel`
  ADD PRIMARY KEY (`OtelID`),
  ADD KEY `personelID` (`personelID`),
  ADD KEY `OdaID` (`OdaID`),
  ADD KEY `MusteriID` (`MusteriID`),
  ADD KEY `HizmetID` (`HizmetID`);

--
-- Tablo için indeksler `personel`
--
ALTER TABLE `personel`
  ADD PRIMARY KEY (`personelID`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`);

--
-- Tablo için indeksler `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  ADD PRIMARY KEY (`RezervasyonID`),
  ADD KEY `MusteriID` (`MusteriID`),
  ADD KEY `OdaID` (`OdaID`);

--
-- Tablo için indeksler `rezervasyon_hizmetleri`
--
ALTER TABLE `rezervasyon_hizmetleri`
  ADD PRIMARY KEY (`Rezervasyon_HizmetID`),
  ADD KEY `RezervasyonID` (`RezervasyonID`),
  ADD KEY `HizmetID` (`HizmetID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `hizmetler`
--
ALTER TABLE `hizmetler`
  MODIFY `hizmetID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `musteriler`
--
ALTER TABLE `musteriler`
  MODIFY `musteri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `odalar`
--
ALTER TABLE `odalar`
  MODIFY `oda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `odatipi`
--
ALTER TABLE `odatipi`
  MODIFY `OdaTipiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `odemeler`
--
ALTER TABLE `odemeler`
  MODIFY `OdemeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `otel`
--
ALTER TABLE `otel`
  MODIFY `OtelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `personel`
--
ALTER TABLE `personel`
  MODIFY `personelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  MODIFY `RezervasyonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `rezervasyon_hizmetleri`
--
ALTER TABLE `rezervasyon_hizmetleri`
  MODIFY `Rezervasyon_HizmetID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`MusteriID`) REFERENCES `musteriler` (`musteri_id`);

--
-- Tablo kısıtlamaları `odalar`
--
ALTER TABLE `odalar`
  ADD CONSTRAINT `odalar_ibfk_1` FOREIGN KEY (`odaTipiID`) REFERENCES `odatipi` (`OdaTipiID`);

--
-- Tablo kısıtlamaları `odemeler`
--
ALTER TABLE `odemeler`
  ADD CONSTRAINT `odemeler_ibfk_1` FOREIGN KEY (`RezervasyonID`) REFERENCES `rezervasyonlar` (`RezervasyonID`);

--
-- Tablo kısıtlamaları `otel`
--
ALTER TABLE `otel`
  ADD CONSTRAINT `otel_ibfk_1` FOREIGN KEY (`personelID`) REFERENCES `personel` (`personelID`),
  ADD CONSTRAINT `otel_ibfk_2` FOREIGN KEY (`OdaID`) REFERENCES `odalar` (`oda_id`),
  ADD CONSTRAINT `otel_ibfk_3` FOREIGN KEY (`MusteriID`) REFERENCES `musteriler` (`musteri_id`),
  ADD CONSTRAINT `otel_ibfk_4` FOREIGN KEY (`HizmetID`) REFERENCES `hizmetler` (`hizmetID`);

--
-- Tablo kısıtlamaları `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  ADD CONSTRAINT `rezervasyonlar_ibfk_1` FOREIGN KEY (`MusteriID`) REFERENCES `musteriler` (`musteri_id`),
  ADD CONSTRAINT `rezervasyonlar_ibfk_2` FOREIGN KEY (`OdaID`) REFERENCES `odalar` (`oda_id`);

--
-- Tablo kısıtlamaları `rezervasyon_hizmetleri`
--
ALTER TABLE `rezervasyon_hizmetleri`
  ADD CONSTRAINT `rezervasyon_hizmetleri_ibfk_1` FOREIGN KEY (`RezervasyonID`) REFERENCES `rezervasyonlar` (`RezervasyonID`),
  ADD CONSTRAINT `rezervasyon_hizmetleri_ibfk_2` FOREIGN KEY (`HizmetID`) REFERENCES `hizmetler` (`hizmetID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
