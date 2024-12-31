<?php
include 'config/database.php';
include 'includes/header.php';

// Sayfalama
$kullanici_basi = 10;
$sayfa = isset($_GET['sayfa']) ? intval($_GET['sayfa']) : 1;
$offset = ($sayfa - 1) * $kullanici_basi;

$total_users_result = $conn->query("SELECT COUNT(*) AS total FROM kullanicilar");
$total_users = $total_users_result->fetch_assoc()['total'];
$total_pages = ceil($total_users / $kullanici_basi);

// Kullanıcıları listeleme
$stmt = $conn->prepare("SELECT * FROM kullanicilar LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $kullanici_basi);
$stmt->execute();
$result = $stmt->get_result();
?>

<main>
    <h2>Kullanıcı Ekle</h2>
    <form method="POST" action="add_user.php">
        <label for="kullanici_adi">Kullanıcı Adı:</label>
        <input type="text" id="kullanici_adi" name="kullanici_adi" required><br><br>

        <label for="dogum_tarihi">Doğum Tarihi:</label>
        <input type="date" id="dogum_tarihi" name="dogum_tarihi" required><br><br>

        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" name="nickname" required><br><br>

        <button type="submit">Ekle</button>
    </form>

    <h2>Kullanıcı Listesi</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kullanıcı Adı</th>
            <th>Doğum Tarihi</th>
            <th>Nickname</th>
            <th>İşlem</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['kullanici_adi']; ?></td>
            <td><?php echo $row['dogum_tarihi']; ?></td>
            <td><?php echo $row['nickname']; ?></td>
            <td>
                <a href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?')">Sil</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Sayfalama -->
    <div>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="index.php?sayfa=<?php echo $i; ?>" <?php if ($i == $sayfa) echo 'style="font-weight:bold;"'; ?>>
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>
</main>

<?php
include 'includes/footer.php';
$stmt->close();
$conn->close();
?>
