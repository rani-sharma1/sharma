<?php
require 'includes/db.php';
session_start();
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }
$err=''; $success='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $old=$_POST['old']; $new=$_POST['new'];
  $stmt=$conn->prepare("SELECT password FROM users WHERE user_id=?");
  $stmt->bind_param('i',$_SESSION['user_id']); $stmt->execute(); $row=$stmt->get_result()->fetch_assoc();
  if(!$row || !password_verify($old,$row['password'])) $err='Old password incorrect';
  else {
    $hash=password_hash($new,PASSWORD_DEFAULT);
    $stmt=$conn->prepare("UPDATE users SET password=? WHERE user_id=?");
    $stmt->bind_param('si',$hash,$_SESSION['user_id']);
    if($stmt->execute()) $success='Password updated'; else $err='Failed';
  }
}
include 'includes/header.php';
?>
<div class="container">
  <h2>Change Password</h2>
  <?php if($success) echo '<p class="success">'.htmlspecialchars($success).'</p>'; ?>
  <?php if($err) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
  <form method="post">
    <label>Old Password</label><input name="old" type="password" required>
    <label>New Password</label><input name="new" type="password" required>
    <button class="btn" type="submit">Change</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
