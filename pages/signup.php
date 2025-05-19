<!-- Lujain Waleed Aljahdali - 2107397 - IAR - 21/3/2025 -->
<!-- Rafa Omar Balkhdhar - 2106048 - IAR - 21/3/2025 -->
<!-- Leen Anas Bafaqeeh - 2106170 - IAR - 21/3/2025 -->
<?php
include '../includes/db.php'; // الاتصال بقاعدة البيانات

$msg = ""; // رسالة الخطأ أو النجاح

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat-password'];

    // التحقق مما إذا كان البريد الإلكتروني موجود في قاعدة البيانات
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $msg = "Email is already taken.";
    } else {
        // التحقق من تطابق كلمات المرور
        if ($password === $repeatPassword) {
            // إدخال البيانات في قاعدة البيانات
            $passwordHash = password_hash($password, PASSWORD_DEFAULT); // تشفير كلمة المرور

            $insertQuery = "INSERT INTO users (firstname, email, password) VALUES (:firstname, :email, :password)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bindParam(':firstname', $firstname);
            $insertStmt->bindParam(':email', $email);
            $insertStmt->bindParam(':password', $passwordHash);

            if ($insertStmt->execute()) {
                header("Location: login.php"); // إعادة التوجيه إلى صفحة تسجيل الدخول
                exit();
            } else {
                $msg = "Error occurred while registering.";
            }
        } else {
            $msg = "Passwords do not match.";
        }
    }
}
?>


<head>
    <meta charset="UTF-8">
    <title>The Krusty Krab</title>
    <link rel="stylesheet" type="text/css" href="../global/main.css">
</head>

<!-- SignUp section -->
<div class="wrapper">
    <h1>Signup</h1>
    <p id="error-message"><?php echo $msg; ?></p>
    <form class="signup" id="signinform" method="POST" action="signup.php">
        <!-- Firstname -->
        <div>
            <label for="firstname-input">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                    <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/>
                </svg>
            </label>
            <input required type="text" name="firstname" id="firstname-input" placeholder="Firstname">
        </div>

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

        <!-- Repeat Password -->
        <div>
            <label for="repeat-password-input">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                    <path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/>
                </svg>
            </label>
            <input type="password" name="repeat-password" id="repeat-password-input" placeholder="Repeat Password">
        </div>

        <button type="submit" name="submit">Signup</button>
    </form>

    <p class="logintext">Already have an Account? <a href="login.php" class="logintextA">Login</a></p>
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


