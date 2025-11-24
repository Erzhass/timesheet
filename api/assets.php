<?php
session_start();
$path=__DIR__.'/../db/assets.json';
$data=json_decode(file_get_contents($path), true) ?? [];
if($_SERVER['REQUEST_METHOD']==='GET'){ echo json_encode($data); exit; }
$body=json_decode(file_get_contents('php://input'), true);
$data[]=$body;
file_put_contents($path,json_encode($data,JSON_PRETTY_PRINT));
echo json_encode(['ok'=>1]);
?>