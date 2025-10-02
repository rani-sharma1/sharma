<?php
include 'includes/header.php';
$video = isset($_GET['video'])?$_GET['video']:'';
?>
<div class="container">
  <h2>Video Player</h2>
  <?php if($video): ?>
    <video width="720" controls>
      <source src="<?php echo htmlspecialchars($video); ?>">
      Your browser does not support video tag.
    </video>
  <?php else: ?>
    <p>No video provided.</p>
  <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
