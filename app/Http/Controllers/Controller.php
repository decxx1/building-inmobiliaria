<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //elimina todos los archivos y subcarpetas de una carpeta
    public function delTree($dir) {

        if (!is_dir($dir)) return;

        $files = array_diff(scandir($dir), array('.','..'));

        foreach ($files as $file) {

            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");

        }

        return rmdir($dir);

    }
}
