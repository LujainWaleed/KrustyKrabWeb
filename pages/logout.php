<?php
session_start(); // يجب أن يكون أول سطر قبل أي مخرجات

include '../includes/header.php';
include '../includes/links.php';
include '../includes/db.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    // جلب اسم المستخدم من قاعدة البيانات باستخدام PDO
    $stmt = $conn->prepare("SELECT firstname FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && isset($user['firstname'])) {
        $firstname = $user['firstname'];
    } else {
        $firstname = "Guest";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!-- logout section -->
<div class="CheckContent">
    <h1>Okay <?php echo htmlspecialchars($firstname); ?>, are you sure?</h1>
    <a href="../index.php">Logout</a>
</div>

<?php include '../includes/footer.php'; ?>
