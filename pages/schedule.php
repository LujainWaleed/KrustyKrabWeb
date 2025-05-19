<?php
session_start();

// Include database connection using PDO
require_once '../includes/db.php'; // يجب أن يحتوي على متغير $conn

$success_message = $error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        // جلب البريد الإلكتروني من جدول users بناءً على user_id
        $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $row['email'];
        } else {
            $error_message = "User not found.";
        }

        $message = trim($_POST['message'] ?? '');

        if (!empty($message) && isset($email)) {
            try {
                // إدخال الرسالة إلى جدول messages
                $stmt = $conn->prepare("INSERT INTO messages (email, message) VALUES (?, ?)");
                $stmt->execute([$email, $message]);
                $success_message = "We’ll get back to you!";
            } catch (PDOException $e) {
                $error_message = "Database error: " . $e->getMessage();
            }
        } elseif (empty($message)) {
            $error_message = "Message cannot be empty.";
        }

    } else {
        $error_message = "You must be logged in to send a message.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/links.php'; ?>


<head>
    <link rel="stylesheet" type="text/css" href="../global/print.css">
</head>


<!-- schedule Section -->
<div class="scheduleContent">
    <h1>Our Weekly Schedule</h1>
</div>

<div class="images">
    <img src="../images/pinkk.png" alt="pink flower" class="flower-right">
    <img src="../images/9frrrr.png" alt="yellow flower" class="flower-yellow">
    <img src="../images/bluhh.png" alt="blue flower" class="flower-blue">
</div>

<div class="Content">
    <div class="schedule-container">
        <table class="schedule">
            <tr>
                <th colspan="2">Work Hours</th>
            </tr>
            <tr>
                <th>Day</th>
                <th>Time</th>
            </tr>
            <tr>
                <td>Saturday</td>
                <td rowspan="6" class="time">10 AM - 9 PM</td>
            </tr>
            <tr><td>Sunday</td></tr>
            <tr><td>Monday</td></tr>
            <tr><td>Tuesday</td></tr>
            <tr><td>Wednesday</td></tr>
            <tr><td>Thursday</td></tr>
            <tr>
                <td>Friday</td>
                <td class="closed">Closed</td>
            </tr>
        </table>
    </div>
</div>


<div class="scroll-down">
    <a href="#"><i class="ri-arrow-down-s-fill"></i></a>
</div>


<!-- Contact Us -->
<div id="contactSection" class="scheduleContent">
    <h1>Contact Us!</h1>
    <p class="menucontent">
        Contact Krusty Krew! Got a question, a funny story, or a jellyfishing tip? Don’t be a Squidward — drop us a message!
    </p>

    <!-- Contact Form -->
    <form method="POST" action="schedule.php" id="contactForm">
        <fieldset class="contact-form-fieldset">

            <!-- Message Section -->
            <label class="contact-label">
                <b class="contact-label-title">What Can We Help You With, Matey? <span>*</span>:</b><br>
                <textarea 
                    class="contact-textarea" 
                    id="message" 
                    name="message" 
                    rows="5" 
                    cols="40" 
                    placeholder="Tell us your Krabby Patty dreams, jellyfish adventures, or Bikini Bottom secrets!" 
                    required
                ><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
            </label>

        </fieldset>

        <button type="submit" class="contact-submit-button">Send</button>
    </form>

    <!-- Success Message Box -->
    <?php if (!empty($success_message)) { ?>
        <div id="successMessage" class="success-message">
            <p><?php echo htmlspecialchars($success_message); ?></p>
            <button onclick="closeMessage()">OK</button>
        </div>
    <?php } ?>

    <!-- Error Message Box -->
    <?php if (!empty($error_message)) { ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($error_message); ?></p>
        </div>
    <?php } ?>
</div>

<!-- Optional: Custom JS link -->
<script src="..\scripts\menu.js"></script>

<?php include '../includes/footer.php'; ?>

<!-- JavaScript to close the message box -->
<script>
    function closeMessage() {
        // إخفاء رسالة النجاح
        document.getElementById("successMessage").style.display = "none";

        // مسح محتوى textarea فقط
        document.querySelector("textarea[name='message']").value = "";

        // أو يمكنك استخدام هذا إن كان عندك ID محدد
        // document.getElementById("message").value = "";
    }
</script>

