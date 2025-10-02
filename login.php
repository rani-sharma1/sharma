<?php
require 'includes/db.php';
session_start();
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email=$_POST['email']; $password=$_POST['password'];
  $stmt=$conn->prepare("SELECT user_id,name,password FROM users WHERE email=?");
  $stmt->bind_param('s',$email); $stmt->execute(); $res=$stmt->get_result();
  if($row=$res->fetch_assoc()){
    if(password_verify($password,$row['password'])){
      $_SESSION['user_id']=$row['user_id'];
      $_SESSION['user_name']=$row['name'];
      header('Location: index.php'); exit;
    } else $err='Invalid credentials';
  } else $err='No user found';
}
include 'includes/header.php';
?>
<div class="main-container">
  <div class="container">
    <h2>Login</h2>
    <?php if($err) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
    <form method="post">
      <label>Email
          <input type="email" name="email" placeholder="Enter your email" required>
        </label>
        <label>Password
          <input type="password" name="password" placeholder="Enter your password" required>
        </label>
      <button class="btn" type="submit">Login</button>
    </form>
    <p>Don’t have an account? <a href="register.php">Register</a></p>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
