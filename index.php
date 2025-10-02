<?php
require 'includes/db.php';
include 'includes/header.php';
?>
<section class="hero">
    <div class="background">
      <img src="img/online-school-better.jpg" alt="online-school-better">
    </div>
    <div class="hero-content">
      <h1>We Rank the Best <br> Courses on the Web</h1>
      <p>
        In the history of modern astronomy, there is probably no one greater 
        leap forward than the building and launch of the space telescope known as the Hubble.
      </p>
      <form method="post" class="search-box">
        <input type="text" name="search" placeholder="Search Courses">
        <button type="submit">Search</button>
      </form>
    </div>
     <div class="cards">
      <div class="card pink">
        <h3>📘 New Classes</h3>
        <p>In the history of modern astronomy, there is probably no one greater leap forward building and launch.</p>
      </div>
      <div class="card purple">
        <h3>🏆 Top Courses</h3>
        <p>In the history of modern astronomy, there is probably no one greater leap forward building and launch.</p>
      </div>
    </div>

  </section>

<?php include 'includes/footer.php'; ?>
