<?php
session_start();
$path=__DIR__.'/../db/timesheet.json';
$taskpath=__DIR__.'/../db/tasks.json';
$ts=json_decode(file_get_contents($path), true) ?? [];
$tasks=json_decode(file_get_contents($taskpath), true) ?? [];
if($_SERVER['REQUEST_METHOD']==='GET'){ echo json_encode($ts); exit; }
$body=json_decode(file_get_contents('php://input'), true);
$ts[]=$body;
for($i=0;$i<count($tasks);$i++){
  if($tasks[$i]['kode']==$body['kode']){ $tasks[$i]['terpakai']=($tasks[$i]['terpakai']??0)+($body['jam']??0); break; }
}
file_put_contents($path,json_encode($ts,JSON_PRETTY_PRINT));
file_put_contents($taskpath,json_encode($tasks,JSON_PRETTY_PRINT));
echo json_encode(['ok'=>1]);
?>