<?php
namespace App\Helpers;

class Archivo{

	public static function suma($a,$b){
		return $a+$b;
	}

	public static function reta($a,$b){
		return $a-$b;
	}

	public static function guardarDocumento($document){
		$exploded = explode(',',$document);
        $decoded = base64_decode($exploded[1]);

        if(str_contains($exploded[0],'pdf')){
            $extension = 'pdf';
        }else{
            $extension = '';
        }

        $fileName = str_random().'.'.$extension;

        $path = public_path().'/document/'.$fileName;

        file_put_contents($path, $decoded);

        return $fileName;
	}
}