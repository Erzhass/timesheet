<?php
session_start();
$data = json_decode(file_get_contents(__DIR__.'/../db/users.json'), true) ?? [];
$u = $_POST['username'] ?? '';
$p = $_POST['password'] ?? '';
$hash = hash('sha256',$p);
foreach($data as $x){
  if($x['username']==$u && $x['password']==$hash){
    $_SESSION['user']=$u; $_SESSION['role']=$x['role'];
    header('Location: ../dashboard.php'); exit;
  }
}
echo 'Login gagal';
?>