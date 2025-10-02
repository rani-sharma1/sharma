<?php
// Run this file once after uploading to your PHP host to create sample data.
// Make sure includes/db.php has correct DB credentials and that the database server is running.
require 'includes/db.php';

// Create tables from db.sql if needed: we'll run simple checks and create sample admin/user/course.
$conn->query("CREATE DATABASE IF NOT EXISTS learnhub");
$conn->select_db('learnhub');

// Create tables (simple approach)
$schema = file_get_contents('db.sql');
if($schema){
  // try to run statements; split by ';' is simple but works for this SQL file
  $parts = array_filter(array_map('trim', explode(';', $schema)));
  foreach($parts as $p){
    if(strlen($p)>5) $conn->query($p);
  }
}

// Insert sample admin if not exists
$check = $conn->query("SELECT * FROM admins WHERE username='admin'");
if($check->num_rows==0){
  $hash = password_hash('admin123', PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO admins (username,password) VALUES (?,?)");
  $stmt->bind_param('ss','admin',$hash); $stmt->execute();
}

// Insert sample user if not exists
$check = $conn->query("SELECT * FROM users WHERE email='user@example.com'");
if($check->num_rows==0){
  $uhash = password_hash('password123', PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
  $name='Demo User'; $email='user@example.com';
  $stmt->bind_param('sss',$name,$email,$uhash); $stmt->execute();
}

// Insert sample course
$check = $conn->query("SELECT * FROM courses WHERE title='Sample Course'");
if($check->num_rows==0){
  $stmt = $conn->prepare("INSERT INTO courses (title,description,video_url) VALUES (?,?,?)");
  $t='Sample Course'; $d='This is a sample course created by installer.'; $v='';
  $stmt->bind_param('sss',$t,$d,$v); $stmt->execute();
}

echo "Installation complete. Default admin: admin / admin123 ; sample user: user@example.com / password123\n";
echo "Delete install.php after running for security.\n";
