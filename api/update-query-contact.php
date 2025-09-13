<?php
if(!$_POST){
  header("Location: ../");
  die();
}

$data["success"]=true;
$data["data"]=$_POST;

header("Content-Type: application/json");
echo json_encode($data);