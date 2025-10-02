<?php
require '../includes/db.php';
session_start();
if(!isset($_SESSION['admin_id'])){ header('Location: login.php'); exit; }
include '../includes/header.php';
?>
<div class="container">
  <h2>Manage Faculty (Placeholder)</h2>
  <p>This page is a placeholder. You can extend it to CRUD faculty similar to manage_courses.php</p>
</div>
<?php include '../includes/footer.php'; ?>
