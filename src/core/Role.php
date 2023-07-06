<?php
namespace App\Core; 
 class Role{
  
   
   public static function isConnect():bool{
     return Session::isset("userconnect");
   } 

   public static function hasRole(string $role):bool{
      $user = toObject(Session::get("userconnect"));
      return $user->role==$role;
    }
 }