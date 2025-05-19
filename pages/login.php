<?php
session_start();
ob_start();
include '../includes/db.php';

$msg = "";
$msg1 = ""; // Success message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $msg = "Email does not exist.";
    } elseif (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $msg1 = "successful";
        header("Location: home.php");
        exit;
    } else {
        $msg = "Incorrect password.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Krusty Krab</title>
    <link rel="stylesheet" type="text/css" href="../global/main.css">
</head>

<!-- Login section -->
<body>
<div class="wrapper">
    <h1>Login</h1>
    <p id="error-message"><?php echo htmlspecialchars($msg); ?></p>
    <?php if (!empty($msg1)): ?>
        <p id="submessage"><?php echo $msg1; ?></p>
    <?php endif; ?>
    <form class="signup" id="signinform" method="POST" action="login.php">
        <!-- Email -->
        <div>
            <label for="email-input">
                <span>@</span>
            </label>
            <input type="email" name="email" id="email-input" placeholder="Email">
        </div>

        <!-- Password -->
        <div>
            <label for="password-input">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                    <path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/>
                </svg>
            </label>
            <input type="password" name="password" id="password-input" placeholder="Password">
        </div>

        <button type="submit">Login</button>
    </form>

    <p class="logintext">New here? <a href="signup.php">Create an Account</a></p>
</div>

<div class="images">
        <!-- Images used in website -->
        <img src="../images/pinkk.png" alt="pink flower" class="flower-right">
        <img src="../images/9frrrr.png" alt="yellow flower" class="flower-yellow">
        <img src="../images/bluhh.png" alt="blue flower" class="flower-blue">
</div>

<!-- Custom JS -->
<script src="../scripts/validation.js" defer></script>

<?php include '../includes/footer.php'; ?>

<?php ob_end_flush(); ?>
</body>
</html>
