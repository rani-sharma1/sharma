<?php
require 'includes/db.php';
session_start();
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }
$err=''; $success='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=$_POST['name']; $phone=$_POST['phone'];
  $stmt=$conn->prepare("UPDATE users SET name=?, phone=? WHERE user_id=?");
  $stmt->bind_param('ssi',$name,$phone,$_SESSION['user_id']);
  if($stmt->execute()){ $_SESSION['user_name']=$name; $success='Profile updated'; } else $err='Update failed';
}
include 'includes/header.php';
$stmt=$conn->prepare("SELECT * FROM users WHERE user_id=?"); $stmt->bind_param('i',$_SESSION['user_id']); $stmt->execute(); $user=$stmt->get_result()->fetch_assoc();
?>
<div class="container">
  <h2>Update Profile</h2>
  <?php if($success) echo '<p class="success">'.htmlspecialchars($success).'</p>'; ?>
  <?php if($err) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
  <form method="post">
    <label>Name</label><input name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
    <label>Phone</label><input name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
    <button class="btn" type="submit">Save</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
