<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!=='admin'){ echo json_encode(['error'=>'noauth']); exit; }
$path=__DIR__.'/../db/users.json';
$data=json_decode(file_get_contents($path), true) ?? [];
$body=json_decode(file_get_contents('php://input'), true) ?? [];
$action=$body['action'] ?? '';
if($action==='add'){
  $body['password']=hash('sha256',$body['password']);
  $data[]=['username'=>$body['username'],'password'=>$body['password'],'role'=>$body['role']];
}
if($action==='delete'){
  $data=array_values(array_filter($data, function($u) use($body){ return $u['username']!==$body['username']; }));
}
if($action==='reset'){
  for($i=0;$i<count($data);$i++){
    if($data[$i]['username']==$body['username']) $data[$i]['password']=hash('sha256',$body['newpass']);
  }
}
file_put_contents($path,json_encode($data,JSON_PRETTY_PRINT));
echo json_encode(['ok'=>1]);
?>