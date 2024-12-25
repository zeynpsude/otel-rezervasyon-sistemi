$(document).ready(function () {
    $("#musteriEkleForm").on("submit", function (event) {
        event.preventDefault(); 
        const formData = $(this).serialize();
        
        $.ajax({
            url: "musteri_ekle.php", 
            type: "POST",
            data: formData,
            success: function (response) {
                alert("Müşteri başarıyla eklendi!");
                setTimeout(function() {
                    window.location.href = 'rezervasyon.php'; 
                }, 500);
            },
        });
    });
});
