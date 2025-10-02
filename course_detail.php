<?php
require 'includes/db.php';
include 'includes/header.php';
$id = isset($_GET['id'])?intval($_GET['id']):0;
$stmt = $conn->prepare("SELECT * FROM courses WHERE course_id=?");
$stmt->bind_param('i',$id); $stmt->execute(); $res = $stmt->get_result();
$course = $res->fetch_assoc();
?>
<div class="container">
<?php if($course): ?>
  <h2><?php echo htmlspecialchars($course['title']); ?></h2>
  <p><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
  <?php if($course['video_url']): ?>
    <a class="btn" href="video.php?video=<?php echo urlencode($course['video_url']); ?>">Watch Video</a>
  <?php endif; ?>
<?php else: ?>
  <p>Course not found.</p>
<?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
