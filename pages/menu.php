<!-- Lujain Waleed Aljahdali - 2107397 - IAR - 21/3/2025 -->
<!-- Rafa Omar Balkhdhar - 2106048 - IAR - 21/3/2025 -->
<!-- Leen Anas Bafaqeeh - 2106170 - IAR - 21/3/2025 -->

<?php include '../includes/header.php'; ?>
<?php include '../includes/links.php'; ?>

    <!-- Menu Section -->
    <!-- Our restaurant menu and items are clickable, making visitors feel as if they are at the Krusty Krab.  -->
    <div class="MenuContent">
        <h1>Galley Grub</h1>
        <p>Click an item to add to cart</p>
    </div>


    
    <div class="menu-container">
        <div class="menu-box">
            <h3 class="menu-title">Krabby Patty</h3>
            <p class="menu-item" onclick="addToCart('Krabby Patty')">Krabby Patty ........................... $1.25</p>
            <p class="menu-item" onclick="addToCart('W/ sea cheese')">W/ sea cheese .......... $1.50</p>
            <p class="menu-item" onclick="addToCart('Double Krabby Patty')">Double Krabby Patty ....................... $2.00</p>
            <p class="menu-item" onclick="addToCart('W/ sea cheese')">W/ sea cheese ........... $2.25</p>
            <p class="menu-item" onclick="addToCart('Triple Krabby Patty')">Triple Krabby Patty ....................... $3.00</p>
            <p class="menu-item" onclick="addToCart('W/ sea cheese')">W/ sea cheese ........... $3.25</p>
            <h3 class="menu-title">Coral Bits</h3>
            <p class="menu-item" onclick="addToCart('Small Coral Bits')">Small ....................................... $1.00</p>
            <p class="menu-item" onclick="addToCart('Medium Coral Bits')">Medium .................................. $1.25</p>
            <p class="menu-item" onclick="addToCart('Large Coral Bits')">Large ..................................... $1.50</p>
            <h3 class="menu-title">Kelp Rings</h3>
            <p class="menu-item" onclick="addToCart('Kelp Rings')">Kelp Rings ............................ $1.50</p>
            <p class="menu-item" onclick="addToCart('Salty Sauce')">Salty Sauce ........... $0.50</p>
        </div>
        <div class="menu-box">
            <h3 class="menu-title">Krabby Meals</h3>
            <p class="menu-item" onclick="addToCart('Krabby Meal')">Krabby Meal ........................ $3.50</p>
            <p class="menu-item" onclick="addToCart('Double Krabby Meal')">Double Krabby Meal ........... $3.75</p>
            <p class="menu-item" onclick="addToCart('Triple Krabby Meal')">Triple Krabby Meal ............. $4.00</p>
            <p class="menu-item" onclick="addToCart('Golden Loaf')">Golden Loaf ........................ $2.00</p>
            <p class="menu-item" onclick="addToCart('W/ sauce')">W/ sauce ........... $3.25</p>
            <h3 class="menu-title">Kelp Shark</h3>
            <p class="menu-item" onclick="addToCart('Kelp Shark')">Kelp Shark .......................................... $1.25</p>
            <h3 class="menu-title">Seafoam Soda</h3>
            <p class="menu-item" onclick="addToCart('Small Seafoam Soda')">Small ....................................... $1.00</p>
            <p class="menu-item" onclick="addToCart('Medium Seafoam Soda')">Medium .................................. $1.25</p>
            <p class="menu-item" onclick="addToCart('Large Seafoam Soda')">Large ..................................... $1.50</p>
        </div>
    </div>

    <div class="MenuContent">
        <h1>The Secret Menu</h1>
        <p>Only for true Krabby Patty lovers...</p>
    </div>

    <!-- عرض ملف PDF -->
    <iframe class= "pdfile" src="..\docs\secretMenu.pdf">
        عذرًا، لا يدعم متصفحك عرض ملفات PDF بشكل مباشر. يمكنك 
        <a href="..\docs\secretMenu.pdf" download>تنزيل الملف من هنا</a>.
    </iframe>


    <div class="CheckContent">
        <!-- زر التنزيل -->
        <a href="..\docs\secretMenu.pdf" download>
           Download the secret menu
        </a>
    </div>

    <!-- Images -->
    <img src="../images/flower1.png" alt="flower1" class="flower1">
    <img src="../images/Untitled_design-removebg-preview.png" alt="flower2" class="flower2">
    <img src="../images/Untitled_design__1_-removebg-preview.png" alt="flower3" class="flower3">

   

    <!-- Custom js link -->
    <script src="..\scripts\menu.js"></script>
    <script src="..\scripts\cart.js"></script>

<?php include '../includes/footer.php'; ?>