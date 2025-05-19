<!-- Lujain Waleed Aljahdali - 2107397 - IAR - 21/3/2025 -->
<!-- Rafa Omar Balkhdhar - 2106048 - IAR - 21/3/2025 -->
<!-- Leen Anas Bafaqeeh - 2106170 - IAR - 21/3/2025 -->
<?php include '../includes/header.php'; ?>
<?php include '../includes/links.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header("Content-Type: application/json");
    include '../includes/db.php';
    $input = json_decode(file_get_contents('php://input'), true);

    // Just pass data directly to API, no validation here anymore
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/api/feedback.php';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
    exit;
}
?>

<div class="FormContent">
    <h2>Ahoy there, matey! 🏴‍☠️</h2>
    <h3>Tell us what you think? did we make your day extra bubbly?</h3>
</div>
<p id="errormessage"></p>
<p id="submessage" style="display: none;"></p>
<div id="rightcolumn">
    <div>
        <form name="FeedbackForm" id="FeedbackForm" action="#" method="POST">
            <!-- Contact Information Section -->
            <fieldset id="theContact">
                <legend>Contact Information</legend>
                <label class="blockLable">
                    <b class="Quotation">Full name <span>*</span>:</b>
                    <input class="name-email" type="text" id="FullName" name="FullName" placeholder="Larry the Lobster" />
                </label>
                <label class="blockLable">
                    <b class="Quotation">Email <span>*</span>: </b>
                    <input class="name-email" type="email" id="email" name="email" placeholder="xxxx@email.com" />
                </label>
                <label class="blockLable">
                    <b class="Quotation">What type of entertainment do you enjoy?</b>
                </label>
                <div class="dropdown">
                    <input type="text" name="entertainment" id="entertainment-value" value="" class="text-box" placeholder="Chose from the list" readonly>
                    <div class="option">
                        <div onclick="show('Live Character Appearances')"><i class='bx bxs-face'></i>Live Character Appearances</div>
                        <div onclick="show('Interactive Games & Challenges')"><i class='bx bxs-game' ></i>Interactive Games & Challenges</div>
                        <div onclick="show('Music & Live Performances')"><i class='bx bxs-music' ></i>Music & Live Performances</div>
                        <div onclick="show('No Entertainment, Just Good Food')"><i class='bx bxs-bowl-hot'></i>No Entertainment, Just Good Food</div>
                    </div>
                </div>
                <script>
                    function show(value){
                        document.querySelector('.text-box').value = value;
                        document.getElementById('entertainment-value').value = value;
                    }
                    let dropdown=document.querySelector('.dropdown');
                    dropdown.onclick=function(){
                        dropdown.classList.toggle('active');
                    }
                </script>
            </fieldset>
            <fieldset id="rating">
                <legend>Rating The Experience</legend>
                <!-- Overall Experience -->
                <label class="blockLable">
                    <b class="Quotation" style="margin-right: 30px;">Overall experience:</b>
                    <input type="radio" class="radio" name="experience" id="exp1" value="1" hidden />
                    <label class="radio" for="exp1">Worst</label>
                    <input type="radio" name="experience" id="exp2" value="2" hidden />
                    <label class="radio" for="exp2">Bad</label>
                    <input type="radio" name="experience" id="exp3" value="3" hidden />
                    <label class="radio" for="exp3">Okey</label>
                    <input type="radio" name="experience" id="exp4" value="4" hidden />
                    <label class="radio" for="exp4">Good</label>
                    <input type="radio" name="experience" id="exp5" value="5" hidden />
                    <label class="radio" for="exp5">Great</label>
                </label>
                <!-- Food Quality -->
                <label class="blockLable">
                    <b class="Quotation" style="margin-right: 30px;">Food Quality:</b>
                    <input type="radio" class="radio" name="food" id="food1" value="1" hidden />
                    <label class="radio" for="food1">Worst</label>
                    <input type="radio" name="food" id="food2" value="2" hidden />
                    <label class="radio" for="food2">Bad</label>
                    <input type="radio" name="food" id="food3" value="3" hidden />
                    <label class="radio" for="food3">Okey</label>
                    <input type="radio" name="food" id="food4" value="4" hidden />
                    <label class="radio" for="food4">Good</label>
                    <input type="radio" name="food" id="food5" value="5" hidden />
                    <label class="radio" for="food5">Great</label>
                </label>
                <!-- Most Enjoy -->
                <div class="question-block">
                    <label class="blockLable"><b class="Quotation">Most enjoy:</b></label>
                    <div class="container">
                        <div class="divcheck">
                            <label><input type="checkbox" name="enjoy[]" value="food"><span>Delicious food</span></label>
                        </div>
                        <div class="divcheck">
                            <label><input type="checkbox" name="enjoy[]" value="service"><span>Fast service</span></label>
                        </div>
                        <div class="divcheck">
                            <label><input type="checkbox" name="enjoy[]" value="atmosphere"><span>Fun atmosphere</span></label>
                        </div>
                        <div class="divcheck">
                            <label><input type="checkbox" name="enjoy[]" value="prices"><span>Good prices</span></label>
                        </div>
                    </div>
                </div>
                <!-- Best Food Section -->
                <div class="question-block">
                    <label class="blockLable"><b class="Quotation">Best Food Section:</b></label>
                    <div class="container">
                        <div class="divcheck">
                            <label><input type="checkbox" name="food_section[]" value="appetizers"><span>Appetizers</span></label>
                        </div>
                        <div class="divcheck">
                            <label><input type="checkbox" name="food_section[]" value="main_courses"><span>Main Courses</span></label>
                        </div>
                        <div class="divcheck">
                            <label><input type="checkbox" name="food_section[]" value="desserts"><span>Desserts</span></label>
                        </div>
                        <div class="divcheck">
                            <label><input type="checkbox" name="food_section[]" value="beverages"><span>Beverages</span></label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset id="opinion">
                <legend>Share Your Thoughts</legend>
                <b class="Quotation" style="margin-bottom: 70px;">Which area you believe requires improvement:</b>
                <textarea class="comments" id="comments" name="comments" rows="5" cols="40" placeholder="Tell us about your experience with us..."></textarea>
            </fieldset>
            <div class="form-actions">
                <button type="submit" name="submit" class="submit-button">Send</button>
            </div>
        </form>
    </div>
</div>

<!-- AJAX Script -->
<script>
document.getElementById('FeedbackForm').addEventListener('submit', function(e) {
    e.preventDefault(); // منع الإرسال الافتراضي

    // إعادة تعيين الرسائل
    document.getElementById('errormessage').textContent = '';
    document.getElementById('submessage').style.display = 'none';

    // فحص الفَحوصات من JS
    const errors = getFeedbackFormErrors();
    
    if (errors.length > 0) {
        document.getElementById('errormessage').textContent = errors.join(". ");
        return; // منع الإرسال
    }

    // جمع البيانات بعد التأكد من صحتها
    const formData = {
        full_name: document.getElementById('FullName').value.trim(),
        email: document.getElementById('email').value.trim(),
        entertainment_type: document.getElementById('entertainment-value').value.trim(),
        experience_rating: document.querySelector('input[name="experience"]:checked')?.value,
        food_rating: document.querySelector('input[name="food"]:checked')?.value,
        most_enjoy: Array.from(document.querySelectorAll('input[name="enjoy[]"]:checked')).map(cb => cb.value),
        best_food_section: Array.from(document.querySelectorAll('input[name="food_section[]"]:checked')).map(cb => cb.value),
        comments: document.querySelector('.comments').value.trim()
    };

    // إرسال البيانات عبر AJAX
    fetch('../api/feedback.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        const errorDiv = document.getElementById('errormessage');
        const successDiv = document.getElementById('submessage');
        errorDiv.textContent = '';
        successDiv.style.display = 'none';
        if (!data.success) {
            errorDiv.textContent = data.error || data.errors?.join(", ") || "An unknown error occurred.";
        } else {
            successDiv.textContent = "Thank you for your feedback!";
            successDiv.style.display = 'block';
            document.getElementById('FeedbackForm').reset();
        }
    })
    .catch(error => {
        console.error('AJAX Error:', error);
        document.getElementById('errormessage').textContent = "An unexpected error occurred.";
    });
});
</script>

<!-- Custom JS -->
<script src="../scripts/menu.js"></script>
<script src="../scripts/validation.js"></script>

<?php include '../includes/footer.php'; ?>