<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kullanici_adi = $_POST['kullanici_adi'];
    $dogum_tarihi = $_POST['dogum_tarihi'];
    $nickname = $_POST['nickname'];

    $stmt = $conn->prepare("INSERT INTO kullanicilar (kullanici_adi, dogum_tarihi, nickname) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $kullanici_adi, $dogum_tarihi, $nickname);

    if ($stmt->execute()) {
        header("Location: index.php?status=success");
    } else {
        header("Location: index.php?status=error");
    }

    $stmt->close();
}
$conn->close();
?>
