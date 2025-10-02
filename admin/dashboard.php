<?php
require '../includes/db.php';
session_start();
if(!isset($_SESSION['admin_id'])){ header('Location: login.php'); exit; }
include '../includes/header.php';
?>
<div class="container">
  <h2>Admin Dashboard</h2>
  <ul>
    <li><a href="manage_courses.php">Manage Courses</a></li>
    <li><a href="manage_faculty.php">Manage Faculty (placeholder)</a></li>
    <li><a href="manage_learners.php">Manage Learners (placeholder)</a></li>
    <li><a href="enquiries.php">Enquiries</a></li>
  </ul>
</div>
<?php include '../includes/footer.php'; ?>
