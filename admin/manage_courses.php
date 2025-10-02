<?php
require '../includes/db.php';
session_start();
if(!isset($_SESSION['admin_id'])){ header('Location: login.php'); exit; }
$msg=''; $err='';
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['add_course'])){
  $title=$_POST['title']; $desc=$_POST['description']; $video=$_POST['video_url'];
  $stmt=$conn->prepare("INSERT INTO courses (title,description,video_url) VALUES (?,?,?)");
  $stmt->bind_param('sss',$title,$desc,$video);
  if($stmt->execute()) $msg='Course added'; else $err='Failed';
}
include '../includes/header.php';
$res=$conn->query("SELECT * FROM courses ORDER BY created_at DESC");
?>
<div class="container">
  <h2>Manage Courses</h2>
  <?php if($msg) echo '<p class="success">'.htmlspecialchars($msg).'</p>'; ?>
  <?php if($err) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
  <form method="post">
    <label>Title</label><input name="title" required>
    <label>Description</label><textarea name="description" required></textarea>
    <label>Video URL</label><input name="video_url">
    <button class="btn" name="add_course" type="submit">Add Course</button>
  </form>
  <h3>Existing Courses</h3>
  <ul>
  <?php while($c=$res->fetch_assoc()): ?>
    <li><?php echo htmlspecialchars($c['title']); ?> - <a href="../course_detail.php?id=<?php echo $c['course_id']; ?>">View</a></li>
  <?php endwhile; ?>
  </ul>
</div>
<?php include '../includes/footer.php'; ?>
