<?php
require 'includes/db.php';
include 'includes/header.php';
$res = $conn->query("SELECT * FROM courses ORDER BY created_at DESC");
?>
<div class="container">
  <h2>Courses</h2>
  <div class="grid">
  <?php while($c = $res->fetch_assoc()): ?>
    <div class="card">
      <h3><?php echo htmlspecialchars($c['title']); ?></h3>
      <p><?php echo htmlspecialchars(substr($c['description'],0,120)); ?>...</p>
      <a class="btn" href="course_detail.php?id=<?php echo $c['course_id']; ?>">View</a>
    </div>
  <?php endwhile; ?>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
