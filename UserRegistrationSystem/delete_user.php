<?php
include 'config/database.php';

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Kullanıcıyı veri tabanından sil
    $stmt = $conn->prepare("DELETE FROM kullanicilar WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Başarılı olursa ana sayfaya yönlendir
        header("Location: index.php");
        exit;
    } else {
        echo "Kullanıcı silinemedi: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Geçersiz işlem.";
}

$conn->close();
?>
