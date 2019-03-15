<?php
/**
 * @param int[] $requiredPerms Required permission levels for the page.
 * @return bool Return if the user is valid or not.
 */
 function CheckPermLevel($requiredPerms){
     if (isset($_SESSION['perm_level'])){
         $isValid = false;
         $userPerm = $_SESSION['perm_level'];
         foreach ($requiredPerms as $perm){
             if ($userPerm == $perm){
                 $isValid = true;
             }
         }
         return $isValid;

     } else{
         return false;
     }
 }