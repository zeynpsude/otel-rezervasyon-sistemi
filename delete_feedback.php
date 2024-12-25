<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedbackId = $_POST['feedback_id'];

    try {
        $query = $conn->prepare("DELETE FROM feedback WHERE FeedbackID = :feedback_id");
        $query->bindParam(':feedback_id', $feedbackId, PDO::PARAM_INT);

        if ($query->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Geçersiz istek']);
}
?>
