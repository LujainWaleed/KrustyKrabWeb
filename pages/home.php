
<?php include '../includes/header.php'; ?>
<?php include '../includes/links.php'; ?>



<!-- Home section -->
<section class="krusty">
    <div class="krusty-text">
        <h1>Welcome to the <div class="diff">Krusty Krab</div></h1>
        <p>A fun and interactive digital experience inspired by the legendary restaurant from SpongeBob SquarePants!
            This website brings the underwater magic of Bikini Bottom to life, allowing visitors to explore the menu,
            meet the crew, and even place mock orders as if they were dining at the Krusty Krab.</p>
        <a href="video.php"><i class="ri-play-fill"></i>Watch the Video</a>
        <a href="team.php">Our Team</a>
    </div>

    <div class="krusty-img">
        <img src="../images/image-removebg-preview.png" alt="Krusty Krab">
    </div>
</section>

<div class="scroll-down">
    <a href="#"><i class="ri-arrow-down-s-fill"></i></a>
</div>

<!-- Section to display recent feedback -->

<div class="MapContent">
        <h1>Recent Feedback from Visitors</h1>
</div>

<div id="feedback-container"></div>



<!-- Bikini Bottom Map : Google Maps JavaScript API -->
<div class="MapContent">
        <h1>Find us in Bikini Bottom!</h1>
</div>

<script
    src="https://maps.googleapis.com/maps/api/js?key=..........&libraries=maps,marker"
    defer
></script>

<gmp-map
  center="0,-160"
  zoom="4"
  map-id="DEMO_MAP_ID"
  id="map"
>
  <gmp-advanced-marker
    position="5,-155"
    title="Bikini Bottom"
  ></gmp-advanced-marker>
</gmp-map>


<!-- Images -->
<img src="../images/flower1.png" alt="flower1" class="flower1">
<img src="../images/Untitled_design-removebg-preview.png" alt="flower2" class="flower2">
<img src="../images/Untitled_design__1_-removebg-preview.png" alt="flower3" class="flower3">

<!-- Custom JS link -->
<script src="../scripts/feedback.js"></script>
<script src="../scripts/menu.js"></script>
<script src="../scripts/map.js"></script>

<?php include '../includes/footer.php'; ?>
