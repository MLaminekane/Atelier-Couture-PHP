<?php 
/*
function dump($data){
    echo "<pre>";
      var_dump($data);
    echo "</pre>"; 
}

function dd($data){
    dump($data); 
    die;
}*/

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

//Transformer Array To Objet
function toObject(array $data){
  //Array==> Objet     ==> Conversion est impossible
  //Array   ==> Json ==> Objet
  //Array   ==> Json    json_encode(array)==>json 
  // Json   ==> Objet    json_decode(Json,false)==>Objet
 return  json_decode(json_encode($data), FALSE);
}

//Transformer Objet en Array
function toArray(object $data){
  //Objet ==> Array    ==> Conversion est impossible
  //Objet  ==> Json ==> Array
     //Objet  ==> Json   json_encode(objet)==>json
    // Json ==> array    json_decode(Json,true)==>array
  return json_decode(json_encode($data), true);
}



function redirect(string $path){
  header("location:".BASE_URL.$path);//GET
  exit;
}