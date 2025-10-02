<?php
require 'includes/db.php';
$success=''; $err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=$_POST['name']; $email=$_POST['email']; $message=$_POST['message'];
  if(!$name||!$email||!$message) $err='All fields required';
  else{
    $stmt=$conn->prepare("INSERT INTO enquiries (name,email,message) VALUES (?,?,?)");
    $stmt->bind_param('sss',$name,$email,$message);
    if($stmt->execute()) $success='Message sent';
    else $err='Failed to send';
  }
}
include 'includes/header.php';
?>
<div class="main-container">
  <div class="container">
    <h2>Contact Us</h2>
    <?php if($success) echo '<p class="success">'.htmlspecialchars($success).'</p>'; ?>
    <?php if($err) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
    <form method="post">
      <label>Name</label><input name="name" required>
      <label>Email</label><input name="email" type="email" required>
      <label>Message</label><textarea name="message" required></textarea>
      <button class="btn" type="submit">Send</button>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
