<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanilhaController extends Controller
{
    public function download($filename){
        //$file = Storage::disk('public')->get($filename);
        $path = storage_path($filename);
        $headers = array(
           'Content-Type: application/octet-stream',
        );
        return Storage::download($filename);
    }
}
