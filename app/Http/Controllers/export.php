<?php

namespace App\Http\Controllers;
use App\Exports\reportschecked;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class export extends Controller
{
    //
    public function exportreports(Request $request) 
    {
        //to clear prev session
        session()->forget('datefrom');
        session()->forget('dateto');

        //create new field session
        if($request->input('datefrom') && $request->input('dateto'))
        {
            $datefrom = $request->input('datefrom');
            $dateto = $request->input('dateto');
            
            Session::put('datefrom', $datefrom);
            Session::put('dateto', $dateto);
        }
        else
        {

        }

        $name = "Report-".NOW().'.xlsx';
        
        return Excel::download(new reportschecked, $name);
    }
}
