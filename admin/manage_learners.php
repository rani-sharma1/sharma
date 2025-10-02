<?php
require '../includes/db.php';
session_start();
if(!isset($_SESSION['admin_id'])){ header('Location: login.php'); exit; }
include '../includes/header.php';
$res = $conn->query("SELECT user_id,name,email,created_at FROM users ORDER BY created_at DESC");
?>
<div class="container">
  <h2>Manage Learners</h2>
  <table>
  <tr><th>ID</th><th>Name</th><th>Email</th><th>Joined</th></tr>
  <?php while($u=$res->fetch_assoc()): ?>
    <tr>
      <td><?php echo $u['user_id']; ?></td>
      <td><?php echo htmlspecialchars($u['name']); ?></td>
      <td><?php echo htmlspecialchars($u['email']); ?></td>
      <td><?php echo $u['created_at']; ?></td>
    </tr>
  <?php endwhile; ?>
  </table>
</div>
<?php include '../includes/footer.php'; ?>
