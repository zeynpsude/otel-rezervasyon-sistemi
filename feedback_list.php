<?php
include("db.php");

try {
    $query = $conn->prepare("
        SELECT 
            f.FeedbackID AS FeedbackID,
            f.MusteriID AS MusteriID,
            m.isim AS isim,
            m.soyisim AS soyisim,
            f.yorum AS yorum,
            f.puan AS puan
        FROM feedback f
        INNER JOIN musteriler m ON f.MusteriID = m.musteri_id
    ");
    $query->execute(); 
    $feedbacks = $query->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Tablosu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">
    <a href="giris.php">Geri Dön</a>
    <h2 class="mb-4">Feedback Listesi</h2>
    <table id="feedbackTable" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Müşteri Adı</th>
                <th>Yorum</th>
                <th>Puan</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedbacks as $index => $feedback): ?>
                <tr data-feedback-id="<?= $feedback['FeedbackID'] ?>">
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($feedback['isim'] . " " . $feedback['soyisim']) ?></td>
                    <td><?= htmlspecialchars($feedback['yorum']) ?></td>
                    <td><?= htmlspecialchars($feedback['puan']) ?></td>
                    <td>
                        <button class="btn btn-danger btn-sm delete-feedback" data-feedback-id="<?= $feedback['FeedbackID'] ?>">Sil</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#feedbackTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json"
            }
        });

        $(document).on('click', '.delete-feedback', function () {
            var feedbackId = $(this).data('feedback-id'); 
            var row = $(this).closest('tr'); 

            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu işlemi geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'Vazgeç'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delete_feedback.php',
                        type: 'POST',
                        data: { feedback_id: feedbackId },
                        success: function (response) {
                            var result = JSON.parse(response);
                            if (result.success) {
                                table.row(row).remove().draw();

                                Swal.fire(
                                    'Silindi!',
                                    'Feedback başarıyla silindi.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Hata!',
                                    'Feedback silinirken bir hata oluştu.',
                                    'error'
                                );
                            }
                        },
                        error: function () {
                            Swal.fire(
                                'Hata!',
                                'Sunucu ile bağlantı kurulamadı.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
</body>
</html>
