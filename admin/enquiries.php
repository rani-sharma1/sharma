<?php
require '../includes/db.php';
session_start();
if(!isset($_SESSION['admin_id'])){ header('Location: login.php'); exit; }
include '../includes/header.php';
$res = $conn->query("SELECT * FROM enquiries ORDER BY created_at DESC");
?>
<div class="container">
  <h2>Enquiries</h2>
  <ul>
  <?php while($e=$res->fetch_assoc()): ?>
    <li><strong><?php echo htmlspecialchars($e['name']); ?></strong> (<?php echo htmlspecialchars($e['email']); ?>): <?php echo htmlspecialchars($e['message']); ?> - <?php echo $e['created_at']; ?></li>
  <?php endwhile; ?>
  </ul>
</div>
<?php include '../includes/footer.php'; ?>
