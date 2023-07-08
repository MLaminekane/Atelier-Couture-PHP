<?php 
function dateToString(DateTime $date=new DateTime):string{
  return $date->format("Y-m-d");
}
function dateToEn(string $date){
  return \DateTime::createFromFormat("Y-m-d", $date)->format("Y-m-d");
}
function dateToFr(string $date){
  $date= new DateTime($date);
  return $date->format("d-m-Y");
}
function toObject(array $data){
  return  json_decode(json_encode($data), FALSE);
}
function toArray(object $data){
  return json_decode(json_encode($data), true);
}
function redirect(string $path){
  header("location:".BASE_URL.$path);
  exit;
}