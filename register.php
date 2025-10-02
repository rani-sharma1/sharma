<?php
require 'includes/db.php';
session_start();
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  // basic validation
  if(!$name || !$email || !$password) $err='All fields required';
  else {
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email=?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows>0) $err='Email already registered';
    else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
      $stmt->bind_param('sss',$name,$email,$hash);
      if($stmt->execute()){
        $_SESSION['user_id']=$stmt->insert_id;
        $_SESSION['user_name']=$name;
        header('Location: index.php'); exit;
      } else $err='Registration failed';
    }
  }
}
include 'includes/header.php';
?>
<div class="main-container">
  <div class="container">
    <h2>CREATE AN ACCOUNT PROSIONAL INFORMATION</h2>
    <?php if($err) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
    <form method="post">
      <label>Name</label><input name="name" type="name" required>
      <label>Email</label><input name="email" type="email" required>
      <label>Phone</label><input name="phone" type="phone" required>
      <label>Password</label><input name="password" type="password" required>
      <label>Confirm Password</label><input name="confirm password" type="confirm password" required>
      <button class="btn" type="submit">Register</button>
    </form>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
