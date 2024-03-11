<?php

namespace App\Services;

use Carbon\Carbon;

class ImageHandleService {

    public static function upload($file, $path) {
        $extension = $file->getClientOriginalExtension();
        $fileName = $file->getClientOriginalName().'_'.time().'.'.$extension;
        $file->move($path.'original/', $fileName);

        return $fileName;
    }

    public static function remove($path, $fileName) {
        if (file_exists($path.'original/'.$fileName)) {
            unlink($path.'original/'.$fileName);
        }
    }

    public static function uploadProductImage($file, $path) {
        $extension = $file->getClientOriginalExtension();
        $fileName = $file->getClientOriginalName().'_'.time().'.'.$extension;
        $file->move($path, $fileName);

        return $fileName;
    }

}
