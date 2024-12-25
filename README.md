# otel-rezervasyon-sistemi

Bu projemizde amaç; otel personellerinin müşteri listesini takip edebileceği, rezervasyon kaydı ve iptali yapabileceği, rezervasyonlara ait ödeme alabileceği, ödeme takiplerini yapabileceği ve Feedback kayıtlarını girip yönetebileceği bir otel rezervasyon sistemi kurmaktır. Bu sistem sayesinde personeller, kullanıcı girişi yaptığında tüm bu hizmetlere erişebilmektedir.

Php ve MySql kullanılarak yapılmıştır.

Arayüzümüz ilk olarak bir kullanıcı giriş ekranı ile başlamaktadır. Burada kullanıcı adı ve şifre bilgileri veri tabanından çekilmektedir. Eğer girilen veriler, veri tabanı ile uyuşursa giriş başarılı olmaktadır.
![image](https://github.com/user-attachments/assets/5a0664e3-373e-4f99-9a65-1e10a0082108)

Başarılı giriş yapılması durumunda, giriş yapan kullanıcının adı ile güncellenen bir “Hoşgeldiniz” yazısı karşılamaktadır. Bunun altında ise kullanıcının hangi işlemi yapmak istiyorsa ona yönlendirileceği seçenekler mevcuttur.
![image](https://github.com/user-attachments/assets/686041e1-0073-475a-8dad-4beb2fa4dac7)

 “Rezervasyon Yap” seçeneği ile kullanıcı, gerekli bilgileri girerek bir rezervasyon kaydı oluşturabilmektedir. 
 ![image](https://github.com/user-attachments/assets/645ace26-79ec-489a-a2fb-526b04674e5d)

Yeni müşteri eklemek için “Rezervasyon Yap” ekranından bir buton ile geçiş mevcuttur. Bu sayede kullanıcı, yeni müşteri kaydını buradan yapıp daha sonra o müşterinin rezervasyon kaydını hızlıca yapabilmektedir. 
![image](https://github.com/user-attachments/assets/84d189f0-4bc8-45b6-966d-5eba4c8628e4)

Arayüzümüzde yapılmış ve yapılması planlanan rezervasyonların listelendiği bir sayfa da bulunmaktadır. Buradan o rezervasyona ait bilgileri ve ödemenin alınıp alınmadığı, ne kadar ödeme alınacağı bilgileri görülebilmektedir. Aynı zamanda rezervasyon iptalleri de yapılabilmektedir. 
![image](https://github.com/user-attachments/assets/1b877ac7-5148-4238-b4be-e2840ec114f5)

Ödemesi yapılmamış rezervasyonlar için “ödeme yap” butonu ile yeni bir sayfa gelmektedir. Bu sayfadan direkt olarak tıklanılan rezervasyonun bilgileri otomatik gelmektedir ve ödeme seçenekleri sunulmaktadır. Havale/EFT, Nakit, Kredi Kartı seçenekleri mevcuttur.
![image](https://github.com/user-attachments/assets/1a44a5d5-0f7a-4fc3-9c0b-a47b1b1fac95)

Otelde konaklayan müşterilerin deneyimleri sonucu yapacakları yorumlar için de bir sayfa bulunmaktadır. Rezervasyon yaptırmış kayıtlı müşterilerin yorum yapmaları için kullanılmaktadır.
![image](https://github.com/user-attachments/assets/afc3de23-8fe1-457c-8353-a871b6474222)

Yapılan tüm yorumlar ayrı bir ekranda listelenmektedir. Ayrıca kullanıcı, dilediği yorumu silme hakkına sahiptir.
![image](https://github.com/user-attachments/assets/b803ba7d-ad48-46eb-9cea-91703b05d5eb)
