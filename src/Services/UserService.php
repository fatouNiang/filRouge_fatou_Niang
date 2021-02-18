<?php

namespace App\Services;

class UserService
{

public function uploadImage( $request){
    $photo = $request->files->get("photo");
    if($photo)
    {
         $photoBlob = fopen($photo->getRealPath(),"rb");
        return $photoBlob;
   }
   return null;

}

public function validate(){
     
     return true;
}

 

}