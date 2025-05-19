<!-- Lujain Waleed Aljahdali - 2107397 - IAR - 21/3/2025 -->
<!-- Rafa Omar Balkhdhar - 2106048 - IAR - 21/3/2025 -->
<!-- Leen Anas Bafaqeeh - 2106170 - IAR - 21/3/2025 -->


<?php include '../includes/header.php'; ?>
<?php include '../includes/links.php'; ?>

     <div class="CartContent">
        <h1>Your Cart</h1>
        <div class="Cart">
            <ul id="cartItems"></ul>
            <p>Total: $<span id="totalPrice">0.00</span></p>
        </div>
        <a href="checkout.php" id="checkoutBtn">Checkout</a>
    </div>


    

    <!-- Custom js link -->
    <script src="..\scripts\menu.js"></script>
    <script src="..\scripts\cart.js"></script>

<?php include '../includes/footer.php'; ?>

