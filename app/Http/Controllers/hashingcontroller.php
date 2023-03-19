<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class hashingcontroller extends Controller
{
    //
    public function checkfile(Request $request){

        $mainfile = $request->file('mainfile');
        $origin = $request->input('origin');

        $path="C:/testfiles/";

        echo hash_file('sha256', $path.$mainfile);
    }
}
